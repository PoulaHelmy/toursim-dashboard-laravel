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

    public function edit(Excursion $excursion)
    {
        $allCategories = Category::all();
        $allDestinations = Destination::all();
        $allSelectedCAtegories = [];
        foreach ($excursion->includes as $inc) {
            if ($inc->type === 0) {
                $excludes = $inc;
            }
            if ($inc->type === 1) {
                $includes = $inc;
            }
        }
        foreach ($excursion->categories as $cat) {
            array_push($allSelectedCAtegories, $cat->id);
        }
        return view('dashboard.excursions.edit', compact('excursion', 'allCategories', 'allSelectedCAtegories', 'allDestinations', 'excludes', 'includes'));
    }//end of edit

    public function store(Request $request)
    {
        dd($request->all());
        $request_array = $request->all();

        /*--------------------Excursion CREATING-----------------*/
        //Update Excursion Model With Destination_id
        $excursion = Excursion::create($request->all());
        /*--------------------END Excursion CREATING-------------*/

        /*--------------------SEO CREATING-----------------*/
        $request_array['seoable_id'] = $excursion->id;
        $request_array['seoable_type'] = 'App\Models\Excursion';

        $og_ar_image = $this->storeImage($request->all()['ar']['og_image'], 300, null);
        $og_en_image = $this->storeImage($request->all()['en']['og_image'], 300, null);

        $request_array['ar']['og_image'] = $og_ar_image->filename . '.' . $og_ar_image->extension;
        $request_array['en']['og_image'] = $og_en_image->filename . '.' . $og_en_image->extension;

        Seo::create($request_array);
        /*--------------------END SEO CREATING-------------*/

        /*--------------------PHOTOS CREATING-----------------*/
        $bannerImage = $this->storeImage($request->banner_url, 300, null);
        $thumbImage = $this->storeImage($request->thumb_url, 150, 150);
        Photo::create([
            'banner_url' => $bannerImage->filename . '.' . $bannerImage->extension,
            'thumb_url' => $thumbImage->filename . '.' . $thumbImage->extension,
            'banner_alt' => $request->banner_alt,
            'thumb_alt' => $request->thumb_alt,
            'photoable_id' => $excursion->id,
            'photoable_type' => 'App\Models\Excursion',
        ]);
        /*--------------------END PHOTOS CREATING-------------*/

        /*--------------------Including & Excluding CREATING-----------------*/
        Including::create([
            'ar' => [
                'name' => $request->all()['ar']['includes']
            ],
            'en' => [
                'name' => $request->all()['en']['includes']
            ]
            ,
            'type' => '1',
            'includable_id' => $excursion->id,
            'includable_type' => 'App\Models\Excursion',
        ]);
        Including::create([
            'ar' => [
                'name' => $request->all()['ar']['excludes']
            ],
            'en' => [
                'name' => $request->all()['en']['excludes']
            ], 'type' => '0',
            'includable_id' => $excursion->id,
            'includable_type' => 'App\Models\Excursion',
        ]);
        /*--------------------END Including & Excluding CREATING-------------*/

        /*--------------------Categories CREATING-----------------*/
        foreach ($request->get('categories') as $category) {
            Categoriable::create([
                'category_id' => $category,
                'categoriable_id' => $excursion->id,
                'categoriable_type' => 'App\Models\Excursion'
            ]);
        }
        /*--------------------END Categories CREATING-------------*/

        /*--------------------GALLARY CREATING-----------------*/
        foreach ($request->slider as $image) {
            $photo = $this->storeImage($image, 300, null);
            Gallary::create([
                'url' => $photo->filename . '.' . $photo->extension,
                'alt' => 'abcddsdasda',
                'gallarable_id' => $excursion->id,
                'gallarable_type' => 'App\Models\Excursion'
            ]);
        }
        /*--------------------END GALLARY CREATING-------------*/

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('excursions.index');
    }//end of store

    public
    function update(Request $request, Excursion $excursion)
    {
        $request_array = $request->all();

        /*--------------------Excursion UPDATING-----------------*/
        //Update Excursion Model With Destination_id
        $excursion->update($request->all());
        /*--------------------END Excursion UPDATING-------------*/

        /*--------------------SEO UPDATING-----------------------*/
        //        Update SEO
        $seo = Seo::where('id', $excursion->seoAttributes['id'])->first();

        //        Delete Images FROM DISK
        $this->delete_Image_From_Disk($seo->translate('ar')['og_image']);
        $this->delete_Image_From_Disk($seo->translate('en')['og_image']);

        //        Store New Images
        $og_ar_image = $this->storeImage($request->all()['ar']['og_image'], 300, null);
        $og_en_image = $this->storeImage($request->all()['en']['og_image'], 300, null);

        $request_array['ar']['og_image'] = $og_ar_image->filename . '.' . $og_ar_image->extension;
        $request_array['en']['og_image'] = $og_en_image->filename . '.' . $og_en_image->extension;

        //        UPDATE SEO
        $seo->update($request_array);
        /*--------------------END SEO UPDATING-----------------------*/

        /*--------------------PHOTOS UPDATING-----------------------*/
        $photos = Photo::where('id', $excursion->photos['id'])->first();

        $this->delete_Image_From_Disk($photos->banner_url);
        $this->delete_Image_From_Disk($photos->thumb_url);

        $bannerImage = $this->storeImage($request->banner_url, 300, null);
        $thumbImage = $this->storeImage($request->thumb_url, 150, 150);

        $request_array['banner_url'] = $bannerImage->filename . '.' . $bannerImage->extension;
        $request_array['thumb_url'] = $thumbImage->filename . '.' . $thumbImage->extension;

        $photos->update($request_array);
        /*--------------------END PHOTOS UPDATING-----------------------*/

        /*--------------------Gallary UPDATING-----------------------*/
        foreach ($excursion->gallary as $img) {
            // DELETE IMAGE FROM DISK
            $this->delete_Image_From_Disk($img->url);
            //DELETE IMAGE FROM DATA BASE
            $img->delete();
        }
        foreach ($request->slider as $image) {
            $photo = $this->storeImage($image, 300, null);
            Gallary::create([
                'url' => $photo->filename . '.' . $photo->extension,
                'alt' => 'NEW SLIDER EXCURSION IMAGE',
                'gallarable_id' => $excursion->id,
                'gallarable_type' => 'App\Models\Excursion'
            ]);
        }
        /*--------------------END Gallary UPDATING-------------------*/

        /*--------------------Categories UPDATING--------------------*/
        $excursion->categories()->sync($request_array['categories']);
        /*--------------------END Categories UPDATING----------------*/

        /*--------------------Including & Excluding UPDATING--------------------*/
        foreach ($excursion->includes as $inc) {
            if ($inc->type === 0) {
                $inc->update(
                    [
                        'ar' => [
                            'name' => $request->all()['ar']['excludes']
                        ],
                        'en' => [
                            'name' => $request->all()['en']['excludes']
                        ]
                    ]
                );
            }
            if ($inc->type === 1) {
                $inc->update(
                    [
                        'ar' => [
                            'name' => $request->all()['ar']['includes']
                        ],
                        'en' => [
                            'name' => $request->all()['en']['includes']
                        ]
                    ]
                );
            }
        }
        /*--------------------END Including & Excluding UPDATING----------------*/

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('excursions.index');
    }//end of update

    public
    function destroy(Excursion $excursion)
    {

        /*--------------------DELETE SEO----------------*/
        $seo = Seo::where('id', $excursion->seoAttributes['id'])->first();
        $this->delete_Image_From_Disk($seo->translate('ar')['og_image']);
        $this->delete_Image_From_Disk($seo->translate('en')['og_image']);
        $seo->delete();
        /*--------------------DELETE SEO----------------*/

        /*--------------------DELETE PHOTOS----------------*/
        $photos = Photo::where('id', $excursion->photos['id'])->first();
        $this->delete_Image_From_Disk($photos->banner_url);
        $this->delete_Image_From_Disk($photos->thumb_url);
        $photos->delete();
        /*--------------------DELETE PHOTOS----------------*/

        /*--------------------DELETE GALLARY----------------*/
        foreach ($excursion->gallary as $img) {
            // DELETE IMAGE FROM DISK
            $this->delete_Image_From_Disk($img->url);
            //DELETE IMAGE FROM DATA BASE
            $img->delete();
        }
        /*--------------------DELETE GALLARY----------------*/

        /*--------------------DELETE CATEGORIES----------------*/
        $cats = Categoriable::where('categoriable_id', $excursion->id)->get();
        foreach ($cats as $cat) {
            $cat->delete();
        }
        /*--------------------DELETE CATEGORIES----------------*/

        /*--------------------DELETE INCLUDING & EXCLUDING----------------*/
        foreach ($excursion->includes as $inc) {
            $inc->delete();
        }
        /*--------------------DELETE INCLUDING & EXCLUDING----------------*/

        /*--------------------DELETE EXCURSION----------------*/
        $excursion->delete();
        /*--------------------DELETE EXCURSION----------------*/

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('excursions.index');
    }//END OF Destroy

    public
    function storeImage($image, $width, $height)
    {
        return Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/' . $image->hashName()));
    }//End Of storeImage

    public function delete_Image_From_Disk($image)
    {
        Storage::disk('public_uploads')->delete('/' . $image);
    }//End Of delete_Image_From_Disk
}//END OF CLASS
