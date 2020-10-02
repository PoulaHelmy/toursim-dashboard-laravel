<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageHotel extends Model
{
    protected $table = 'package_hotels';
    protected $fillable = ['package_id', 'plan_id', 'hotel_id'];

    public function package()
    {
        return $this->belongsTo('App\Models\Package');
    }
}//END OF CLASS
