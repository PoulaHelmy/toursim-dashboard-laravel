<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'categories';
    public $useTranslationFallback = true;
    public $translatedAttributes = ['name', 'slug', 'description'];
    protected $fillable = ['name', 'slug', 'description'];
    protected $with = ['seoAttributes', 'photos'];

    public function seoAttributes()
    {
        return $this->morphOne('App\Models\Seo', 'seoable');
    }//End OF seoAttributes

    public function photos()
    {
        return $this->morphOne('App\Models\Photo', 'photoable');
    }//End OF photos

    public function parent()
    {
        return $this->hasMany(self::class, 'parent_id');
    }//End OF parent

    public function excursions()
    {
        return $this->morphedByMany('App\Models\Excursion', 'categoriable');
    }//End OF excursions

    public function packages()
    {
        return $this->morphedByMany('App\Models\Excursion', 'categoriable');
    }//End OF packages


}//End OF CLass

//    public function parent()
//    {
//        return $this->hasMany(self::class, 'parent_id');
//    }
