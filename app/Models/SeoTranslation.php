<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['page_title', 'meta_keywords', 'meta_description', 'og_title', 'og_description', 'og_image'];

}//END OF CLASS

