<?php

namespace App\Http\Controllers\Dashboard\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Repository\Interfaces\PackagesRepositoryInterface;
use App\Http\Requests\BackEnd\Packages\Store;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\Plan;
use Illuminate\Http\Request;

class PackagesController extends Controller
{

    protected $packagesRepository;

    public function __construct(PackagesRepositoryInterface $packagesRepository)
    {
        $this->packagesRepository = $packagesRepository;
    }//END OF __construct

    public function index(Request $request)
    {
        $finalResults = $this->packagesRepository->GetAllPackages($request, 5);
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

    public function store(Store $request)
    {
        /*--------------------PACKAGE CREATING AND ALL DEPENDANDCIES -----------------*/
        $this->packagesRepository->StorePackage($request);
        /*--------------------END PACKAGE CREATING AND ALL DEPENDANDCIES----------------*/
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('packages.index');
    }//end of store

    public
    function update(Request $request, Package $package)
    {
        /*--------------------PACKAGE UPDATING AND ALL DEPENDANDCIES -----------------*/
        $this->packagesRepository->UpdatePackage($request, $package);
        /*--------------------END PACKAGE UPDATING AND ALL DEPENDANDCIES----------------*/
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('packages.index');
    }//end of update

    public
    function destroy(Package $package)
    {
        $this->packagesRepository->DeletePackage($package);
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('packages.index');
    }//END OF Destroy

}//END OF CLASS
