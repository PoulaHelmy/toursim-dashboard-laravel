<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'image', 'id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $appends = ['image_path'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }//end of get  name

    public function getImagePathAttribute()
    {
        return asset('uploads/user_images/' . $this->image);

    }//end of get image path

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user');
    }//end of permissions
}//end of CLASS
