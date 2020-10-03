<?php

namespace App\Http\Repository\Eloquent;

use App\Http\Controllers\Dashboard\Traits\CategoriesTrait;
use App\Http\Controllers\Dashboard\Traits\GallaryTrait;
use App\Http\Controllers\Dashboard\Traits\IncludingTrait;
use App\Http\Controllers\Dashboard\Traits\PhotosTrait;
use App\Http\Controllers\Dashboard\Traits\SeoTrait;
use App\Http\Repository\Interfaces\PackagesRepositoryInterface;
use App\Models\Day;
use App\Models\Package;
use App\Models\PackageHotel;
use App\Models\Pricelist;
use App\Models\Season;

class PackagesRepository implements PackagesRepositoryInterface
{
    use SeoTrait, PhotosTrait, IncludingTrait, GallaryTrait, CategoriesTrait;

    protected $package;

    public function __construct(Package $package)
    {
        $this->package = $package;
    }//END OF __construct

    public function GetAllPackages($request, $paginateSize)
    {
        return $finalResults = $this->package->where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate($paginateSize);
    }//END OF GetAllPackages

    public function StorePackage($request)
    {
        /*--------------------Package CREATING-----------------*/
        $package = Package::create($request->all());
        /*--------------------END Package CREATING-------------*/

        /*--------------------SEO CREATING-----------------*/
        $this->store_seo($request->all(), $package->id, 'App\Models\Package');
        /*--------------------END SEO CREATING-------------*/

        /*--------------------PHOTOS CREATING-----------------*/
        $this->store_photos($request->all(), $package->id, 'App\Models\Package');
        /*--------------------END PHOTOS CREATING-------------*/

        /*--------------------Including & Excluding CREATING-----------------*/
        $this->store_including($request->all()['ar']['includes'], $request->all()['en']['includes'], $package->id, 'App\Models\Package', '1');
        $this->store_including($request->all()['ar']['excludes'], $request->all()['en']['excludes'], $package->id, 'App\Models\Package', '0');
        /*--------------------END Including & Excluding CREATING-------------*/

        /*--------------------Categories CREATING-----------------*/
        $this->store_categoriable($request->get('categories'), $package->id, 'App\Models\Package');
        /*--------------------END Categories CREATING-------------*/

        /*--------------------GALLARY CREATING-----------------*/
        $this->store_gallary($request->slider, $package->id, 'App\Models\Package');
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
    }//END OF StorePackage

    public function UpdatePackage($request, $package)
    {
        $request_array = $request->all();

        /*--------------------Package UPDATING-----------------*/
        //Update Package Model With Destination_id
        $package->update($request->all());
        /*--------------------END Package UPDATING-------------*/

        /*--------------------SEO UPDATING-----------------------*/
        $this->update_seo($request->all(), $package);
        /*--------------------END SEO UPDATING-----------------------*/

        /*--------------------PHOTOS UPDATING-----------------------*/
        $this->update_photos($request->all(), $package);
        /*--------------------END PHOTOS UPDATING-----------------------*/

        /*--------------------Gallary UPDATING-----------------------*/
        $this->update_gallary($package->gallary, $request->slider, $package->id, 'App\Models\Package');
        /*--------------------END Gallary UPDATING-------------------*/

        /*--------------------Categories UPDATING--------------------*/
        $package->categories()->sync($request_array['categories']);
        /*--------------------END Categories UPDATING----------------*/

        /*--------------------Including & Excluding UPDATING--------------------*/
        $this->update_including($package, $request->all()['ar']['includes'], $request->all()['en']['includes'], $request->all()['ar']['excludes'], $request->all()['en']['excludes']);
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


    }//END OF UpdatePackage


    public function DeletePackage($package)
    {
        /*--------------------DELETE SEO----------------*/
        $this->delete_seo($package);
        /*--------------------DELETE SEO----------------*/

        /*--------------------DELETE PHOTOS----------------*/
        $this->delete_photos($package);
        /*--------------------DELETE PHOTOS----------------*/

        /*--------------------DELETE GALLARY----------------*/
        $this->delete_gallary($package->gallary);
        /*--------------------DELETE GALLARY----------------*/

        /*--------------------DELETE CATEGORIES----------------*/
        $this->delete_categoriable($package->id, 'App\Models\Package');
        /*--------------------DELETE CATEGORIES----------------*/

        /*--------------------DELETE INCLUDING & EXCLUDING----------------*/
        $this->delete_including($package->includes);
        /*--------------------DELETE INCLUDING & EXCLUDING----------------*/

        /*--------------------DELETE $package----------------*/
        $package->delete();
        /*--------------------DELETE $package----------------*/

    }//END OF DeletePackage


}//END OF CLASS
