<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Package extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'packages';
    public $useTranslationFallback = true;
    public $translatedAttributes = ['name', 'slug', 'short_description', 'overview', 'run', 'type'];
    protected $fillable = ['discount', 'start', 'duration', 'status', 'featured', 'destination_id',
        'name', 'slug', 'short_description', 'overview', 'run', 'places', 'type'];
    protected $with = ['seoAttributes', 'photos', 'destination', 'gallary', 'categories', 'includes', 'days', 'hotels'];

    public function seoAttributes()
    {
        return $this->morphOne('App\Models\Seo', 'seoable');
    }//End OF seoAttributes

    public function photos()
    {
        return $this->morphOne('App\Models\Photo', 'photoable');
    }//End OF photos

    public function destination()
    {
        return $this->belongsTo('App\Models\Destination');
    }//End OF distination

    public function gallary()
    {
        return $this->morphMany('App\Models\Gallary', 'gallarable');
    }//End OF gallary

    public function categories()
    {
        return $this->morphToMany('App\Models\Category', 'categoriable');
    }//End OF categories

    public function includes()
    {
        return $this->morphMany('App\Models\Including', 'includable');
    }//End OF categories

    public function days()
    {
        return $this->hasMany('App\Models\Day');
    }//End OF categories

    public function seasons()
    {
        return $this->hasMany('App\Models\Season');
    }//End OF categories

    public function hotels()
    {
        return $this->hasMany('App\Models\PackageHotel');
    }//End OF categories


}//End OF CLass
