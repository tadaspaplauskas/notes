<?php

namespace App;

use League\CommonMark\CommonMarkConverter;
use Illuminate\Database\Eloquent\SoftDeletes;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Note extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'content',
    ];

    protected static $searchPhrase;

    protected static function boot(): void
    {
        parent::boot();

        self::deleting(function (Note $model) {
            if ($model->forceDeleting) {
                $model->uploads->each(function($u) { $u->forceDelete(); });
            }
        });
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function uploads()
    {
        return $this->hasMany(Upload::class);
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

        $html = $converter->convertToHtml($this->content);

        $s = static::$searchPhrase;
        if ($s) {
            // using regex to keep case
            $html = preg_replace('/(' . preg_quote($s) . ')/i',
                '<span class="bg-warning">$1</span>',
                $html);
        }

        return $html;
    }

    public static function setSearchPhrase($phrase)
    {
        static::$searchPhrase = $phrase;
    }
}

