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

    protected static function boot()
    {
        parent::boot();

        self::deleting(function (Upload $model) {
            if ($model->forceDeleting) {
                Storage::delete($model->path);
            }
        });
    }

    public function getUrlAttribute()
    {
        return Storage::disk('public')->url($this->path);
    }
}
