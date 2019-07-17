<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'text',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_note');
    }
}
