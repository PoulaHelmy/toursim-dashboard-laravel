<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    protected $fillable = ['banner_url', 'banner_alt', 'thumb_url', 'thumb_alt', 'photoable_id', 'photoable_type'];

    public function photoable()
    {
        return $this->morphTo();
    }
}//END OF CLASS
