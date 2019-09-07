<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'content',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_note');
    }
}
