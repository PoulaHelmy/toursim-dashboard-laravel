<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricelist extends Model
{
    protected $table = 'price_lists';
    protected $fillable = ['price', 'plan_id', 'season_id'];
    protected $with = ['plan'];

    public function season()
    {
        return $this->belongsTo('App\Models\Season');
    }//END OF season

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }//END OF season

}//END OF CLASS
