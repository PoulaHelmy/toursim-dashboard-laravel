<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoriable extends Model
{
    protected $table = 'categoriable';
    protected $fillable = ['category_id', 'categoriable_id', 'categoriable_type'];

}//END OF CLASS
