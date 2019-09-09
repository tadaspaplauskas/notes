<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'content',
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function getHtmlAttribute()
    {
        if (empty($this->content)) {
            return '';
        }

        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return $converter->convertToHtml($this->content);
    }
}
