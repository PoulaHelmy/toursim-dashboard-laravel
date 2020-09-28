<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Seo implements TranslatableContract
{
    use Translatable;

    protected $table = 'seos';
    public $useTranslationFallback = true;
    public $translatedAttributes = ['page_title', 'meta_keywords', 'meta_description', 'og_title', 'og_description', 'og_image'];

}//End OF CLass
