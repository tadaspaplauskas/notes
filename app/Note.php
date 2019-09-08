<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;

class Note extends Model
{
    protected $fillable = [
        'content',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_note');
    }

    public function getHtmlAttribute()
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return $converter->convertToHtml($this->content);
    }
}
