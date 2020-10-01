<?php

namespace App\Http\Controllers;


use App\Http\Requests\BackEnd\Categories\Store;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Seo;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $finalResults = Category::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(5);
        return view('dashboard.categories.index', compact('finalResults'));

    }//END OF index

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.create', compact('categories'));
    }//end of create


    public function edit(Category $category)
    {
        $seoAttrbutes = $category->seoAttributes;
        $photos = $category->photos;
        return view('dashboard.categories.edit', compact('category', 'seoAttrbutes', 'photos'));
    }//end of edit

    public function store(Store $request)
    {
        $request_array = $request->all();
        $category = Category::create($request->all());
        $request_array['seoable_id'] = $category->id;
        $request_array['seoable_type'] = 'App\Models\Category';
        $bannerImage = $this->storeImage($request->banner_url, 300, null);
        $thumbImage = $this->storeImage($request->thumb_url, 150, 150);
        $og_ar_image = $this->storeImage($request->all()['ar']['og_image'], 300, null);
        $og_en_image = $this->storeImage($request->all()['en']['og_image'], 300, null);
        $request_array['ar']['og_image'] = $og_ar_image->filename . '.' . $og_ar_image->extension;
        $request_array['en']['og_image'] = $og_en_image->filename . '.' . $og_en_image->extension;
        Seo::create($request_array);
        Photo::create([
            'banner_url' => $bannerImage->filename . '.' . $bannerImage->extension,
            'thumb_url' => $thumbImage->filename . '.' . $thumbImage->extension,
            'banner_alt' => $request->banner_alt,
            'thumb_alt' => $request->thumb_alt,
            'photoable_id' => $category->id,
            'photoable_type' => 'App\Models\Category',
        ]);
        Seo::create($request_array);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('categories.index');
    }//end of store

    public function update(Request $request, Category $category)
    {
        $request_array = $request->all();
        $category->update($request->all());

        $seo = Seo::where('id', $category->seoAttributes['id'])->first();
        $photos = Photo::where('id', $category->photos['id'])->first();

        Storage::disk('public_uploads')->delete('/' . $photos->banner_url);
        Storage::disk('public_uploads')->delete('/' . $photos->thumb_url);
        Storage::disk('public_uploads')->delete('/' . $seo->translate('ar')['og_image']);
        Storage::disk('public_uploads')->delete('/' . $seo->translate('en')['og_image']);

        $bannerImage = $this->storeImage($request->banner_url, 300, null);
        $thumbImage = $this->storeImage($request->thumb_url, 150, 150);
        $og_ar_image = $this->storeImage($request->all()['ar']['og_image'], 300, null);
        $og_en_image = $this->storeImage($request->all()['en']['og_image'], 300, null);


        $request_array['ar']['og_image'] = $og_ar_image->filename . '.' . $og_ar_image->extension;
        $request_array['en']['og_image'] = $og_en_image->filename . '.' . $og_en_image->extension;
        $request_array['banner_url'] = $bannerImage->filename . '.' . $bannerImage->extension;
        $request_array['thumb_url'] = $thumbImage->filename . '.' . $thumbImage->extension;


        $photos->update($request_array);
        $seo->update($request_array);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('categories.index');
    }//end of update

    public function destroy(Category $category)
    {
        $seo = Seo::where('id', $category->seoAttributes['id'])->first();
        $photos = Photo::where('id', $category->photos['id'])->first();

        Storage::disk('public_uploads')->delete('/' . $photos->banner_url);
        Storage::disk('public_uploads')->delete('/' . $photos->thumb_url);
        Storage::disk('public_uploads')->delete('/' . $seo->translate('ar')['og_image']);
        Storage::disk('public_uploads')->delete('/' . $seo->translate('en')['og_image']);

        $category->delete();
        $seo->delete();
        $photos->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('categories.index');
    }//END OF Destroy

    public function storeImage($image, $width, $height)
    {
        return Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/' . $image->hashName()));
    }//End Of Store
}//END OF CLASS
