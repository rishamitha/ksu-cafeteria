<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Stall extends Authenticatable
{
    use Notifiable;
    const IMAGE_FOLDER = 'uploads/stall/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->attributes['image']) {
            return asset(self::IMAGE_FOLDER . $this->attributes['image']);
        }
    }
}
