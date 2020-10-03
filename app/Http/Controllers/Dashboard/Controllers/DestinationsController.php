<?php

namespace App\Http\Controllers\Dashboard\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\Traits\PhotosTrait;
use App\Http\Controllers\Dashboard\Traits\SeoTrait;
use App\Http\Repository\Interfaces\DestinationsRepositoryInterface;
use App\Http\Requests\BackEnd\Destinations\Store;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationsController extends Controller
{
    use  SeoTrait, PhotosTrait;

    protected $destinationsRepository;

    public function __construct(DestinationsRepositoryInterface $destinationsRepository)
    {
        $this->destinationsRepository = $destinationsRepository;
    }//END OF __construct

    public function index(Request $request)
    {
        $finalResults = $this->destinationsRepository->GetAllDestinations($request, 5);
        return view('dashboard.destinations.index', compact('finalResults'));
    }//END OF index

    public function create()
    {
        return view('dashboard.destinations.create');
    }//end of create

    public function edit(Destination $destination)
    {
        return view('dashboard.destinations.edit', compact('destination'));
    }//end of edit

    public function store(Store $request)
    {
        $destination = Destination::create($request->all());

        $this->store_seo($request->all(), $destination->id, 'App\Models\Destination');

        $this->store_photos($request->all(), $destination->id, 'App\Models\Destination');

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('destinations.index');
    }//end of store

    public function update(Request $request, Destination $destination)
    {
        $destination->update($request->all());
        $this->update_seo($request->all(), $destination);
        $this->update_photos($request->all(), $destination);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('destinations.index');
    }//end of update

    public function destroy(Destination $destination)
    {
        $this->delete_seo($destination);
        $this->delete_photos($destination);
        $destination->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('destinations.index');
    }//END OF Destroy

}//END OF CLASS
