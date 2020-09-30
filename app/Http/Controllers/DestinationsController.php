<?php

namespace App\Http\Controllers;

use App\Http\Requests\BackEnd\Destinations\Store;
use App\Models\Destination;
use App\Models\Seo;
use Illuminate\Http\Request;

class DestinationsController extends Controller
{
    public function index(Request $request)
    {
        $finalResults = Destination::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(5);
        return view('dashboard.destinations.index', compact('finalResults'));

    }//END OF index

    public function create()
    {
        return view('dashboard.destinations.create');
    }//end of create

    public function edit(Destination $destination)
    {
        $seoAttrbutes = $destination->seoAttributes;
        return view('dashboard.destinations.edit', compact('destination', 'seoAttrbutes'));
    }//end of edit

    public function store(Store $request)
    {
        $request_array = $request->all();
        $destination = Destination::create($request->all());
        $request_array['seoable_id'] = $destination->id;
        $request_array['seoable_type'] = 'App\Models\Destination';
        Seo::create($request_array);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('destinations.index');
    }//end of store

    public function update(Request $request, Destination $destination)
    {
        $destination->update($request->all());
        $seo = Seo::where('id', $destination->id)->first();
        $seo->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('destinations.index');
    }//end of update

    public function destroy(Destination $destination)
    {
        $destination->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('destinations.index');
    }//END OF Destroy
}//END OF CLASS
