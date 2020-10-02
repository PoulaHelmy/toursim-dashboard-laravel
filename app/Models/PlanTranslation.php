<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'plan_translations';
    protected $fillable = ['name'];
}//END OF CLASS
