<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Destination implements TranslatableContract
{
    use Translatable;

    protected $table = 'destination';
    public $useTranslationFallback = true;
    public $translatedAttributes = ['name', 'slug', 'description'];

}//End OF CLass
