<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'title' => 'required|string',
            'selection' => '',
        ]);

        $note = $request->user()->notes()->make();

        $note->content =
            ($request->input('selection') ? '_' . $request->input('selection') . '_ ' : '') .
            '[' . $request->input('title') . '](' .
            $request->input('url') . ')';

        $tag = $request->user()->tags()->firstOrCreate([
            'name' => 'bookmarks',
        ]);

        $note->tag()->associate($tag);

        $note->save();

        return redirect()->route('notes.edit', $note);
    }
}
