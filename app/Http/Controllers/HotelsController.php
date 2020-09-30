<?php

namespace App\Http\Controllers;

use App\Http\Requests\BackEnd\Hotels\Store;
use App\Models\Hotel;
use Symfony\Component\HttpFoundation\Request;

class HotelsController extends Controller
{
    public function index(Request $request)
    {
        $finalResults = Hotel::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(5);
        return view('dashboard.hotels.index', compact('finalResults'));

    }//END OF index

    public function create()
    {
        return view('dashboard.hotels.create');
    }//end of create

    public function edit(Hotel $hotel)
    {
        return view('dashboard.hotels.edit', compact('hotel'));
    }//end of create

    public function store(Store $request)
    {
        Hotel::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('hotels.index');
    }//end of create

    public function update(Request $request, Hotel $hotel)
    {
        $hotel->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('hotels.index');
    }//end of create

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('hotels.index');
    }//END OF Destroy
}//END OF CLASS
