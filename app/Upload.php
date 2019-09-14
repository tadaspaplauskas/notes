<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
