<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $table = 'seasons';
    protected $fillable = ['start', 'end', 'package_id'];
    protected $with = ['price_lists'];

    public function package()
    {
        return $this->belongsTo('App\Models\Package');
    }//END OF package

    public function price_lists()
    {
        return $this->hasMany('App\Models\Pricelist');
    }//END OF prriceLists


}//END OF CLASS
