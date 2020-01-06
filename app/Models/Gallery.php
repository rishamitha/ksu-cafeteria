<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    const IMAGE_FOLDER = 'uploads/gallery/';

    protected $fillable = ['caption'];

    public function stall()
    {
        return $this->belongsTo(Stall::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->attributes['image']) {
            return asset(self::IMAGE_FOLDER . $this->attributes['image']);
        }
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope('order', function (Builder $builder) {
    //         $builder->orderBy('created_at', 'desc');
    //     });
    // }
}
