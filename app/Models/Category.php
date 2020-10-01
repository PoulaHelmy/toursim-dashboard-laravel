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

    public function seoAttributes()
    {
        return $this->morphOne('App\Models\Seo', 'seoable');
    }

    public function photos()
    {
        return $this->morphOne('App\Models\Photo', 'photoable');
    }

    public function parent()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
//    public function parent()
//    {
//        return $this->hasMany(self::class, 'parent_id');
//    }

}//End OF CLass
