<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricelist extends Model
{
    protected $table = 'price_lists';
    protected $fillable = ['price', 'plan_id', 'season_id'];
}//END OF CLASS
