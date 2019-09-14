<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;

class Tag extends Model
{
    protected $fillable = [
        'name',

    ];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::kebab($value);
    }
}
