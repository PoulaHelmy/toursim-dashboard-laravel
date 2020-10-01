<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ralated extends Model
{
    protected $table = 'related_booking';
    protected $fillable = ['relatable_id', 'relatable_type', 'excursion_id'];

}//End Of Class
