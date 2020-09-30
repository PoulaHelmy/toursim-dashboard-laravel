<?php

namespace App\Http\Controllers;


use App\Http\Requests\BackEnd\Categories\Store;
use App\Models\Category;
use App\Models\Seo;
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
        return view('dashboard.categories.edit', compact('category', 'seoAttrbutes'));
    }//end of edit

    public function store(Store $request)
    {
        $request_array = $request->all();
        $category = Category::create($request->all());
        $request_array['seoable_id'] = $category->id;
        $request_array['seoable_type'] = 'App\Models\Category';
        Seo::create($request_array);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('categories.index');
    }//end of store

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        $seo = Seo::where('id', $category->id)->first();
        $seo->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('categories.index');
    }//end of update

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('categories.index');
    }//END OF Destroy
}//END OF CLASS
