<?php

namespace App\Http\Controllers\Dashboard\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Repository\Interfaces\ExcursionsRepositoryInterface;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Excursion;
use App\Models\Includes;
use Illuminate\Http\Request;

class ExcursionsController extends Controller
{
    protected $excursionsRepository;

    public function __construct(ExcursionsRepositoryInterface $excursionsRepository)
    {
        $this->excursionsRepository = $excursionsRepository;
    }//END OF __construct

    public function index(Request $request)
    {
        $finalResults = $this->excursionsRepository->GetAllExcursions($request, 5);
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
        $this->excursionsRepository->StoreExcursion($request);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('excursions.index');
    }//end of store

    public
    function update(Request $request, Excursion $excursion)
    {
        $this->excursionsRepository->UpdateExcursion($request, $excursion);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('excursions.index');
    }//end of update

    public
    function destroy(Excursion $excursion)
    {
        $this->excursionsRepository->DeleteExcursion($excursion);
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('excursions.index');
    }//END OF Destroy


}//END OF CLASS
