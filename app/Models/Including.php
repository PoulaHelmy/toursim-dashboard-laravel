<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Including extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'includings';
    public $useTranslationFallback = true;
    public $translatedAttributes = ['name'];
    protected $fillable = ['name', 'type', 'includable_id', 'includable_type'];

    public function includable()
    {
        return $this->morphTo();
    }
}//End OF Clas
