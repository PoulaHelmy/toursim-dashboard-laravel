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
}//END OF CLASS
