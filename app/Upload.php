<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Upload extends Model
{
    protected $fillable = [
        'path',
        'name',
        'size',
        'is_image',
    ];

    protected $casts = [
        'is_image' => 'boolean',
    ];

    public function getUrlAttribute()
    {
        return Storage::disk('public')->url($this->path);
    }
}
