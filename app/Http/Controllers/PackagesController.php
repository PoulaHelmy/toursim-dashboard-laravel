<?php

namespace App\Http\Controllers;

use App\Models\Categoriable;
use App\Models\Category;
use App\Models\Day;
use App\Models\Destination;
use App\Models\Gallary;
use App\Models\Hotel;
use App\Models\Including;
use App\Models\Package;
use App\Models\PackageHotel;
use App\Models\Photo;
use App\Models\Plan;
use App\Models\Pricelist;
use App\Models\Season;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PackagesController extends Controller

{
    public function index(Request $request)
    {
        $finalResults = Package::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(5);
        return view('dashboard.packages.index', compact('finalResults'));

    }//END OF index

    public function create()
    {
        $categories = Category::all();
        $destinations = Destination::all();
        $allPackages = Package::all();
        $plans = Plan::all();
        $allHotels = Hotel::all();
        return view('dashboard.packages.create', compact('categories', 'destinations', 'plans', 'allPackages', 'allHotels'));
    }//end of create

    public function edit(Package $package)
    {
        $allCategories = Category::all();
        $allDestinations = Destination::all();
        $allSelectedCAtegories = [];
        $plans = Plan::all();
        $allHotels = Hotel::all();
        foreach ($package->includes as $inc) {
            if ($inc->type === 0) {
                $excludes = $inc;
            }
            if ($inc->type === 1) {
                $includes = $inc;
            }
        }
        foreach ($package->categories as $cat) {
            array_push($allSelectedCAtegories, $cat->id);
        }
        return view('dashboard.packages.edit', compact(
            'package',
            'allCategories',
            'allSelectedCAtegories',
            'allDestinations',
            'excludes',
            'includes',
            'plans',
            'allHotels'
        ));
    }//end of edit

    public function store(Request $request)
    {
//        dd($request->all());
        $request_array = $request->all();

        /*--------------------Package CREATING-----------------*/
        //Update Package Model With Destination_id
        $package = Package::create($request->all());
        /*--------------------END Package CREATING-------------*/

        /*--------------------SEO CREATING-----------------*/
        $request_array['seoable_id'] = $package->id;
        $request_array['seoable_type'] = 'App\Models\Package';

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
            'photoable_id' => $package->id,
            'photoable_type' => 'App\Models\Package',
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
            'includable_id' => $package->id,
            'includable_type' => 'App\Models\Package',
        ]);
        Including::create([
            'ar' => [
                'name' => $request->all()['ar']['excludes']
            ],
            'en' => [
                'name' => $request->all()['en']['excludes']
            ], 'type' => '0',
            'includable_id' => $package->id,
            'includable_type' => 'App\Models\Package',
        ]);
        /*--------------------END Including & Excluding CREATING-------------*/

        /*--------------------Categories CREATING-----------------*/
        foreach ($request->get('categories') as $category) {
            Categoriable::create([
                'category_id' => $category,
                'categoriable_id' => $package->id,
                'categoriable_type' => 'App\Models\Package'
            ]);
        }
        /*--------------------END Categories CREATING-------------*/

        /*--------------------GALLARY CREATING-----------------*/
        foreach ($request->slider as $image) {
            $photo = $this->storeImage($image, 300, null);
            Gallary::create([
                'url' => $photo->filename . '.' . $photo->extension,
                'alt' => 'abcddsdasda',
                'gallarable_id' => $package->id,
                'gallarable_type' => 'App\Models\Package'
            ]);
        }
        /*-------------------- END GALLARY CREATING -------------*/

        /*--------------------Seasons CREATING-----------------*/
        foreach ($request->seasons as $season) {
            $seasonData = Season::create([
                'start' => $season['start'],
                'end' => $season['end'],
                'package_id' => $package->id
            ]);
            foreach ($season['price_list'] as $priceList) {
                Pricelist::create([
                    'price' => $priceList['price'],
                    'plan_id' => $priceList['plan_id'],
                    'season_id' => $seasonData->id
                ]);
            }

        }

        /*-------------------- END Seasons CREATING -------------*/

        /*--------------------DAYS CREATING-----------------*/
        foreach ($request->days as $day) {
            Day::create([
                'package_id' => $package->id,
                'ar' => [
                    'title' => $day['ar']['title'],
                    'summery' => $day['ar']['summery']
                ],
                'en' => [
                    'title' => $day['en']['title'],
                    'summery' => $day['en']['summery']
                ]
            ]);
        }
        /*-------------------- END DAYS CREATING -------------*/

        /*--------------------HOTELS CREATING-----------------*/
        foreach ($request->hotels as $hotel) {
            foreach ($hotel['hotels'] as $hotelID) {
                PackageHotel::create([
                    'package_id' => $package->id,
                    'plan_id' => $hotel['plan_id'],
                    'hotel_id' => $hotelID
                ]);
            }
        }
        /*-------------------- END HOTELS CREATING -------------*/

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('packages.index');
    }//end of store

    public
    function update(Request $request, Package $package)
    {
        $request_array = $request->all();

        /*--------------------Package UPDATING-----------------*/
        //Update Package Model With Destination_id
        $package->update($request->all());
        /*--------------------END Package UPDATING-------------*/

        /*--------------------SEO UPDATING-----------------------*/
        //        Update SEO
        $seo = Seo::where('id', $package->seoAttributes['id'])->first();

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
        $photos = Photo::where('id', $package->photos['id'])->first();

        $this->delete_Image_From_Disk($photos->banner_url);
        $this->delete_Image_From_Disk($photos->thumb_url);

        $bannerImage = $this->storeImage($request->banner_url, 300, null);
        $thumbImage = $this->storeImage($request->thumb_url, 150, 150);

        $request_array['banner_url'] = $bannerImage->filename . '.' . $bannerImage->extension;
        $request_array['thumb_url'] = $thumbImage->filename . '.' . $thumbImage->extension;

        $photos->update($request_array);
        /*--------------------END PHOTOS UPDATING-----------------------*/

        /*--------------------Gallary UPDATING-----------------------*/
        foreach ($package->gallary as $img) {
            // DELETE IMAGE FROM DISK
            $this->delete_Image_From_Disk($img->url);
            //DELETE IMAGE FROM DATA BASE
            $img->delete();
        }
        foreach ($request->slider as $image) {
            $photo = $this->storeImage($image, 300, null);
            Gallary::create([
                'url' => $photo->filename . '.' . $photo->extension,
                'alt' => 'NEW SLIDER PACAKGE IMAGE',
                'gallarable_id' => $package->id,
                'gallarable_type' => 'App\Models\Package'
            ]);
        }
        /*--------------------END Gallary UPDATING-------------------*/

        /*--------------------Categories UPDATING--------------------*/
        $package->categories()->sync($request_array['categories']);
        /*--------------------END Categories UPDATING----------------*/

        /*--------------------Including & Excluding UPDATING--------------------*/
        foreach ($package->includes as $inc) {
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

//        /*--------------------Seasons UPDATING-----------------*/
//
//        foreach ($request->seasons as $season) {
//            $seasonData = Season::create([
//                'start' => $season['start'],
//                'end' => $season['end'],
//                'package_id' => $package->id
//            ]);
//            foreach ($season['price_list'] as $priceList) {
//                Pricelist::create([
//                    'price' => $priceList['price'],
//                    'plan_id' => $priceList['plan_id'],
//                    'season_id' => $seasonData->id
//                ]);
//            }
//        }
//        /*-------------------- END Seasons UPDATING -------------*/
//
//        /*--------------------DAYS CREATING-----------------*/
//        foreach ($request->days as $day) {
//            Day::create([
//                'package_id' => $package->id,
//                'ar' => [
//                    'title' => $day['ar']['title'],
//                    'summery' => $day['ar']['summery']
//                ],
//                'en' => [
//                    'title' => $day['en']['title'],
//                    'summery' => $day['en']['summery']
//                ]
//            ]);
//        }
//        /*-------------------- END DAYS CREATING -------------*/
//
//        /*--------------------HOTELS CREATING-----------------*/
//        foreach ($request->hotels as $hotel) {
//            foreach ($hotel['hotels'] as $hotelID) {
//                PackageHotel::create([
//                    'package_id' => $package->id,
//                    'plan_id' => $hotel['plan_id'],
//                    'hotel_id' => $hotelID
//                ]);
//            }
//        }
//        /*-------------------- END HOTELS CREATING -------------*/


        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('packages.index');
    }//end of update

    public
    function destroy(Package $package)
    {

        /*--------------------DELETE SEO----------------*/
        $seo = Seo::where('id', $package->seoAttributes['id'])->first();
        $this->delete_Image_From_Disk($seo->translate('ar')['og_image']);
        $this->delete_Image_From_Disk($seo->translate('en')['og_image']);
        $seo->delete();
        /*--------------------DELETE SEO----------------*/

        /*--------------------DELETE PHOTOS----------------*/
        $photos = Photo::where('id', $package->photos['id'])->first();
        $this->delete_Image_From_Disk($photos->banner_url);
        $this->delete_Image_From_Disk($photos->thumb_url);
        $photos->delete();
        /*--------------------DELETE PHOTOS----------------*/

        /*--------------------DELETE GALLARY----------------*/
        foreach ($package->gallary as $img) {
            // DELETE IMAGE FROM DISK
            $this->delete_Image_From_Disk($img->url);
            //DELETE IMAGE FROM DATA BASE
            $img->delete();
        }
        /*--------------------DELETE GALLARY----------------*/

        /*--------------------DELETE CATEGORIES----------------*/
        $cats = Categoriable::where('categoriable_id', $package->id)->get();
        foreach ($cats as $cat) {
            $cat->delete();
        }
        /*--------------------DELETE CATEGORIES----------------*/

        /*--------------------DELETE INCLUDING & EXCLUDING----------------*/
        foreach ($package->includes as $inc) {
            $inc->delete();
        }
        /*--------------------DELETE INCLUDING & EXCLUDING----------------*/

        /*--------------------DELETE $package----------------*/
        $package->delete();
        /*--------------------DELETE $package----------------*/

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('packages.index');
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
