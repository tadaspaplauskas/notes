<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class Upload extends Model
{
    use SoftDeletes;

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

    public function forceDelete()
    {
        Storage::disk('public')->delete($this->path);

        return parent::forceDelete();
    }
}
