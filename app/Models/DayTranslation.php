<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'day_translations';
    protected $fillable = ['title', 'summery'];

}//END OF CLASS
