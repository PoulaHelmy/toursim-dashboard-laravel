<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'destination_translation';
    protected $fillable = ['name', 'slug', 'description'];

}//END OF CLASS
