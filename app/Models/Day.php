<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Day extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'days';
    public $useTranslationFallback = true;
    public $translatedAttributes = ['title', 'summery'];
    protected $fillable = ['title', 'summery', 'package_id'];

    public function package()
    {
        return $this->belongsTo('App\Models\Package');
    }

}//END OF CLASS
