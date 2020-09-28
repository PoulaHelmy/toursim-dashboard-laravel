<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category implements TranslatableContract
{
    use Translatable;

    protected $table = 'categories';
    public $useTranslationFallback = true;
    public $translatedAttributes = ['name', 'slug', 'description'];

}//End OF CLass
