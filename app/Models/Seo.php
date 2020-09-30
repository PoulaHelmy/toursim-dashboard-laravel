<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'seos';
    public $useTranslationFallback = true;
    public $translatedAttributes = ['page_title', 'meta_keywords', 'meta_description', 'og_title', 'og_description', 'og_image'];
    protected $fillable = ['page_title', 'meta_keywords', 'meta_description', 'og_title', 'og_description', 'og_image', 'seoable_type', 'seoable_id'];

    public function seoable()
    {
        return $this->morphTo();
    }
}//End OF CLass
