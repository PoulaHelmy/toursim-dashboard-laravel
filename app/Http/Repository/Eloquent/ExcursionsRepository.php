<?php

namespace App\Http\Repository\Eloquent;

use App\Http\Controllers\Dashboard\Traits\CategoriesTrait;
use App\Http\Controllers\Dashboard\Traits\GallaryTrait;
use App\Http\Controllers\Dashboard\Traits\IncludingTrait;
use App\Http\Controllers\Dashboard\Traits\PhotosTrait;
use App\Http\Controllers\Dashboard\Traits\SeoTrait;
use App\Http\Repository\Interfaces\ExcursionsRepositoryInterface;
use App\Models\Excursion;

class ExcursionsRepository implements ExcursionsRepositoryInterface
{
    use SeoTrait, PhotosTrait, IncludingTrait, GallaryTrait, CategoriesTrait;

    protected $excursion;

    public function __construct(Excursion $excursion)
    {
        $this->excursion = $excursion;
    }//END OF __construct

    public function GetAllExcursions($request, $paginateSize)
    {
        return $finalResults = $this->excursion->where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate($paginateSize);
    }//END OF GetAllExcursions


    public function StoreExcursion($request)
    {
        /*--------------------Excursion CREATING-----------------*/
        //CREATING Excursion Model With Destination_id
        $excursion = Excursion::create($request->all());
        /*--------------------END Excursion CREATING-------------*/

        /*--------------------SEO CREATING-----------------*/
        $this->store_seo($request->all(), $excursion->id, 'App\Models\Excursion');
        /*--------------------END SEO CREATING-------------*/

        /*--------------------PHOTOS CREATING-----------------*/
        $this->store_photos($request->all(), $excursion->id, 'App\Models\Excursion');
        /*--------------------END PHOTOS CREATING-------------*/

        /*--------------------Including & Excluding CREATING-----------------*/
        $this->store_including($request->all()['ar']['includes'], $request->all()['en']['includes'], $excursion->id, 'App\Models\Excursion', '1');
        $this->store_including($request->all()['ar']['excludes'], $request->all()['en']['excludes'], $excursion->id, 'App\Models\Excursion', '0');
        /*--------------------END Including & Excluding CREATING-------------*/

        /*--------------------Categories CREATING-----------------*/
        $this->store_categoriable($request->get('categories'), $excursion->id, 'App\Models\Excursion');
        /*--------------------END Categories CREATING-------------*/

        /*--------------------GALLARY CREATING-----------------*/
        $this->store_gallary($request->slider, $excursion->id, 'App\Models\Excursion');
        /*-------------------- END GALLARY CREATING -------------*/
    }//END OF StoreExcursion

    public function UpdateExcursion($request, $excursion)
    {
        /*--------------------Package UPDATING-----------------*/
        //Update EXCURSION Model With Destination_id
        $excursion->update($request->all());
        /*--------------------END EXCURSION UPDATING-------------*/

        /*--------------------SEO UPDATING-----------------------*/
        $this->update_seo($request->all(), $excursion);
        /*--------------------END SEO UPDATING-----------------------*/

        /*--------------------PHOTOS UPDATING-----------------------*/
        $this->update_photos($request->all(), $excursion);
        /*--------------------END PHOTOS UPDATING-----------------------*/

        /*--------------------Gallary UPDATING-----------------------*/
        $this->update_gallary($excursion->gallary, $request->slider, $excursion->id, 'App\Models\Excursion');
        /*--------------------END Gallary UPDATING-------------------*/

        /*--------------------Categories UPDATING--------------------*/
        $excursion->categories()->sync($request->all()['categories']);
        /*--------------------END Categories UPDATING----------------*/

        /*--------------------Including & Excluding UPDATING--------------------*/
        $this->update_including($excursion, $request->all()['ar']['includes'], $request->all()['en']['includes'], $request->all()['ar']['excludes'], $request->all()['en']['excludes']);
        /*--------------------END Including & Excluding UPDATING----------------*/


    }//END OF UpdateExcursion

    public function DeleteExcursion($excursion)
    {
        /*--------------------DELETE SEO----------------*/
        $this->delete_seo($excursion);
        /*--------------------DELETE SEO----------------*/

        /*--------------------DELETE PHOTOS----------------*/
        $this->delete_photos($excursion);
        /*--------------------DELETE PHOTOS----------------*/

        /*--------------------DELETE GALLARY----------------*/
        $this->delete_gallary($excursion->gallary);
        /*--------------------DELETE GALLARY----------------*/

        /*--------------------DELETE CATEGORIES----------------*/
        $this->delete_categoriable($excursion->id, 'App\Models\Excursion');
        /*--------------------DELETE CATEGORIES----------------*/

        /*--------------------DELETE INCLUDING & EXCLUDING----------------*/
        $this->delete_including($excursion->includes);
        /*--------------------DELETE INCLUDING & EXCLUDING----------------*/

        /*--------------------DELETE $excursion----------------*/
        $excursion->delete();
        /*--------------------DELETE $excursion----------------*/

    }//END OF DeleteExcursion


}//END OF CLASS

