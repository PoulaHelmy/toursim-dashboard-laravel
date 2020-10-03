<?php

namespace App\Http\Repository\Interfaces;

interface CategoriesRepositoryInterface
{
    public function GetAllCategories($request, $paginateSize);
}//END OF INTERFACE
