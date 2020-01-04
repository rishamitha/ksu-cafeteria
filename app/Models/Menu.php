<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Menu extends Model
{
    use SoftDeletes;

    const IMAGE_FOLDER = 'uploads/menu/';

    protected $fillable = ['name', 'description', 'price'];

    public function stall()
    {
        return $this->belongsTo(Stall::class);
    }

    public function setStallIdAttribute($value)
    {
        $this->attributes['stall_id'] = Auth::id();
    }

    public function getImageUrlAttribute()
    {
        if ($this->attributes['image']) {
            return asset(self::IMAGE_FOLDER . $this->attributes['image']);
        }
    }
}
