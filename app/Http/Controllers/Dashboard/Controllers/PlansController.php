<?php

namespace App\Http\Controllers\Dashboard\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\BackEnd\Plans\Store;
use App\Http\Requests\BackEnd\Plans\Update;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function index(Request $request)
    {
        $finalResults = Plan::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(5);
        return view('dashboard.plans.index', compact('finalResults'));

    }//END OF index

    public function create()
    {
        return view('dashboard.plans.create');
    }//end of create

    public function edit(Plan $plan)
    {
        return view('dashboard.plans.edit', compact('plan'));
    }//end of create

    public function store(Store $request)
    {
        dd($request->all());
        Plan::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('plans.index');
    }//end of create

    public function update(Update $request, Plan $plan)
    {
        $plan->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('plans.index');
    }//end of create

    public function destroy(Plan $plan)
    {
        $plan->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('plans.index');
    }//END OF Destroy
}//END OF CLASS

