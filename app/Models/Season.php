<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $table = 'seasons';
    protected $fillable = ['start', 'end', 'package_id'];

    public function package()
    {
        return $this->belongsTo('App\Models\Package');
    }

}//END OF CLASS
