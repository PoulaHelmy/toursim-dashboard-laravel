<?php

namespace App\Http\Controllers\Dashboard\Traits;

use App\Models\Categoriable;

trait CategoriesTrait
{

    public function store_categoriable($categories, $id, $namespace)
    {
        foreach ($categories as $category) {
            Categoriable::create([
                'category_id' => $category,
                'categoriable_id' => $id,
                'categoriable_type' => $namespace
            ]);
        }
    }//END OF store_categoriable

    public function delete_categoriable($id, $namespace)
    {
        $cats = Categoriable::where('categoriable_id', $id)->where('categoriable_type', 'like', '%' . $namespace . '%')->get();
        foreach ($cats as $cat) {
            $cat->delete();
        }
    }//END OF store_categoriable


}//END OF TRAIT
