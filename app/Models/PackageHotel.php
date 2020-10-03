<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageHotel extends Model
{
    protected $table = 'package_hotels';
    protected $fillable = ['package_id', 'plan_id', 'hotel_id'];
    protected $hidden = ['created_at', 'updated_at', 'package_id', 'plan_id', 'id'];

    public function package()
    {
        return $this->belongsTo('App\Models\Package');
    }//END OF package

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }//END OF plan


}//END OF CLASS
