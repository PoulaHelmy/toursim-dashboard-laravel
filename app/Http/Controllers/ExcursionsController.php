<?php

namespace App\Http\Controllers;

use App\Models\Categoriable;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Excursion;
use App\Models\Gallary;
use App\Models\Includes;
use App\Models\Including;
use App\Models\Photo;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ExcursionsController extends Controller
{
    public function index(Request $request)
    {
        $finalResults = Excursion::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(5);
        return view('dashboard.excursions.index', compact('finalResults'));

    }//END OF index

    public function create()
    {
        $categories = Category::all();
        $destinations = Destination::all();
        return view('dashboard.excursions.create', compact('categories', 'destinations'));
    }//end of create

    public function edit(Destination $destination)
    {
        $seoAttrbutes = $destination->seoAttributes;
        $photos = $destination->photos;
        return view('dashboard.excursions.edit', compact('destination', 'seoAttrbutes', 'photos'));
    }//end of edit

    public function store(Request $request)
    {
//        dd($request->all());
        $request_array = $request->all();
        $excursion = Excursion::create($request->all());

        $request_array['seoable_id'] = $excursion->id;
        $request_array['seoable_type'] = 'App\Models\Excursion';

        $bannerImage = $this->storeImage($request->banner_url, 300, null);
        $thumbImage = $this->storeImage($request->thumb_url, 150, 150);
        $og_ar_image = $this->storeImage($request->all()['ar']['og_image'], 300, null);
        $og_en_image = $this->storeImage($request->all()['en']['og_image'], 300, null);

        $request_array['ar']['og_image'] = $og_ar_image->filename . '.' . $og_ar_image->extension;
        $request_array['en']['og_image'] = $og_en_image->filename . '.' . $og_en_image->extension;
        Including::create([
            'ar' => [
                'name' => $request->all()['ar']['includes']
            ],
            'en' => [
                'name' => $request->all()['en']['includes']
            ]
            ,
            'type' => '0',
            'includable_id' => $excursion->id,
            'includable_type' => 'App\Models\Excursion',
        ]);
        Including::create([
            'ar' => [
                'name' => $request->all()['ar']['excludes']
            ],
            'en' => [
                'name' => $request->all()['en']['excludes']
            ], 'type' => '1',
            'includable_id' => $excursion->id,
            'includable_type' => 'App\Models\Excursion',
        ]);
        Seo::create($request_array);
        Photo::create([
            'banner_url' => $bannerImage->filename . '.' . $bannerImage->extension,
            'thumb_url' => $thumbImage->filename . '.' . $thumbImage->extension,
            'banner_alt' => $request->banner_alt,
            'thumb_alt' => $request->thumb_alt,
            'photoable_id' => $excursion->id,
            'photoable_type' => 'App\Models\Excursion',
        ]);
        foreach ($request->get('categories') as $category) {
            Categoriable::create([
                'category_id' => $category,
                'categoriable_id' => $excursion->id,
                'categoriable_type' => 'App\Models\Excursion'
            ]);
        }
        foreach ($request->slider as $image) {
            $photo = $this->storeImage($image, 300, null);
            Gallary::create([
                'url' => $photo->filename . '.' . $photo->extension,
                'alt' => 'abcddsdasda',
                'gallarable_id' => $excursion->id,
                'gallarable_type' => 'App\Models\Excursion'
            ]);
        }
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('excursions.index');
    }//end of store

    public
    function update(Request $request, Destination $destination)
    {
        $request_array = $request->all();
        $destination->update($request->all());

        $seo = Seo::where('id', $destination->seoAttributes['id'])->first();
        $photos = Photo::where('id', $destination->photos['id'])->first();

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
        return redirect()->route('excursions.index');
    }//end of update

    public
    function destroy(Destination $destination)
    {
        $seo = Seo::where('id', $destination->seoAttributes['id'])->first();
        $photos = Photo::where('id', $destination->photos['id'])->first();

        Storage::disk('public_uploads')->delete('/' . $photos->banner_url);
        Storage::disk('public_uploads')->delete('/' . $photos->thumb_url);
        Storage::disk('public_uploads')->delete('/' . $seo->translate('ar')['og_image']);
        Storage::disk('public_uploads')->delete('/' . $seo->translate('en')['og_image']);

        $destination->delete();
        $seo->delete();
        $photos->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('excursions.index');
    }//END OF Destroy

    public
    function storeImage($image, $width, $height)
    {
        return Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/' . $image->hashName()));
    }//End Of Store
}//END OF CLASS
