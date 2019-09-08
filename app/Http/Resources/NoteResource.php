<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use League\CommonMark\CommonMarkConverter;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return [
            'id' => $this->id,
            'content' => $this->content,
            'html' => $converter->convertToHtml($this->content),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->created_at->diffForHumans(),
        ];
    }
}
