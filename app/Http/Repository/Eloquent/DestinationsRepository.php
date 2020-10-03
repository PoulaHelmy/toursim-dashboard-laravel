<?php

namespace App\Http\Repository\Eloquent;

use App\Http\Repository\Interfaces\DestinationsRepositoryInterface;
use App\Models\Destination;

class DestinationsRepository implements DestinationsRepositoryInterface
{
    protected $destination;

    public function __construct(Destination $destination)
    {
        $this->destination = $destination;
    }//END OF __construct

    public function GetAllDestinations($request, $paginateSize)
    {
        return $finalResults = $this->destination->where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate($paginateSize);
    }//END OF GetAllDestinations

}//END OF CLASS
