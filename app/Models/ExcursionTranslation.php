<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcursionTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'excursion_translations';
    protected $fillable = ['name', 'slug', 'short_description', 'overview', 'run', 'type'];
}//END OF CLASS
