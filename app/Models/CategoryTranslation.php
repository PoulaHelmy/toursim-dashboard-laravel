<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'categories_translation';
    protected $fillable = ['name', 'slug', 'description'];

}//END OF CLASS
