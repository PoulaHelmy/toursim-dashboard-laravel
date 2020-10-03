<?php

namespace App\Http\Repository\Eloquent;

use App\Http\Repository\Interfaces\CategoriesRepositoryInterface;
use App\Models\Category;

class CategoriesRepository implements CategoriesRepositoryInterface
{

    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }//END OF __construct

    public function GetAllCategories($request, $paginateSize)
    {
        return $finalResults = $this->category->where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate($paginateSize);
    }//END OF GetAllDestinations

}//END OF CLASS
