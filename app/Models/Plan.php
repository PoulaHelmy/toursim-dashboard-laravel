<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'plans';
    public $useTranslationFallback = true;
    public $translatedAttributes = ['name'];
    protected $fillable = ['name'];
    protected $with = ['pkgs_hotels'];


    public function price_lists()
    {
        return $this->hasMany('App\Models\Pricelist');
    }//END OF prriceLists

    public function pkgs_hotels()
    {
        return $this->hasMany('App\Models\PackageHotel');
    }//END OF pkgs_hotels


}//END OF CLASS
