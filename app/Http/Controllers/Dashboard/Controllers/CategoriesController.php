<?php

namespace App\Http\Controllers\Dashboard\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\Traits\PhotosTrait;
use App\Http\Controllers\Dashboard\Traits\SeoTrait;
use App\Http\Repository\Interfaces\CategoriesRepositoryInterface;
use App\Http\Requests\BackEnd\Categories\Store;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Request;

class CategoriesController extends Controller
{
    use SeoTrait, PhotosTrait;


    protected $categoriesRepository;

    public function __construct(CategoriesRepositoryInterface $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }//END OF __construct

    public function index(Request $request)
    {
        $finalResults = $this->categoriesRepository->GetAllCategories($request, 5);
        return view('dashboard.categories.index', compact('finalResults'));

    }//END OF index

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.create', compact('categories'));
    }//end of create

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }//end of edit

    public function store(Store $request)
    {
        $category = Category::create($request->all());

        $this->store_seo($request->all(), $category->id, 'App\Models\Category');

        $this->store_photos($request->all(), $category->id, 'App\Models\Category');

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('categories.index');
    }//end of store

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        $this->update_seo($request->all(), $category);
        $this->update_photos($request->all(), $category);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('categories.index');
    }//end of update

    public function destroy(Category $category)
    {
        $this->delete_seo($category);
        $this->delete_photos($category);
        $category->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('categories.index');
    }//END OF Destroy

}//END OF CLASS
