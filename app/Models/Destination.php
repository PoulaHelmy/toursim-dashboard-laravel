<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'destination';
    public $useTranslationFallback = true;
    public $translatedAttributes = ['name', 'slug', 'description'];
    protected $fillable = ['name', 'slug', 'description'];

    public function seoAttributes()
    {
        return $this->morphOne('App\Models\Seo', 'seoable');
    }//End OF seoAttributes

    public function photos()
    {
        return $this->morphOne('App\Models\Photo', 'photoable');
    }//End OF photos

    public function excursions()
    {
        return $this->hasMany('App\Models\Excursion');
    }//End OF excursions
}//End OF CLass
