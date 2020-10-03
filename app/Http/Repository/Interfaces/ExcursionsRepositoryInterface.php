<?php

namespace App\Http\Repository\Interfaces;
interface ExcursionsRepositoryInterface
{
    public function GetAllExcursions($request, $paginateSize);

    public function StoreExcursion($request);

    public function UpdateExcursion($request, $excursion);

    public function DeleteExcursion($excursion);

}//END OF INTERFACE
