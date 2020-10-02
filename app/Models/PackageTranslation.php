<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'package_translations';
    protected $fillable = ['name', 'slug', 'short_description', 'overview', 'run', 'type'];
}//END OF CLASS
