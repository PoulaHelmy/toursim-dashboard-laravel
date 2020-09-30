<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallary extends Model
{
    protected $table = 'gallaries';
    protected $fillable = ['url', 'alt', 'gallarable_id', 'gallarable_type'];
}//End OF Class
