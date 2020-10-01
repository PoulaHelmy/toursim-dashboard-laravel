<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncludingTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'including_translations';
    protected $fillable = ['name'];

}//END OF CLASS
