<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
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

    protected static function boot(): void
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
        return Storage::url($this->path);
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}

