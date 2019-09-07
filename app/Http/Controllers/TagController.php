<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Tag;
use Auth;

class TagController extends Controller
{

    public function index()
    {

    }

    public function store(Request $request)
    {
        //
    }

    public function show(Tag $tag)
    {
        $notes = $tag->notes()
            ->with(['tags' => function ($q) { $q->withCount('notes'); }])
            ->get();

        $tags = collect();

        foreach ($notes as $note) {
            foreach($note->tags as $nt) {
                if ($tags->has($nt->id) || $nt->id === $tag->id)
                    continue;

                $tags->put($nt->id, $nt);
            }
        }

        return view('tags.show', [
            'tag' => $tag,
            'tags' => $tags,
            'notes' => $notes,
        ]);
    }

    public function update(Request $request, Tag $tag)
    {
        //
    }

    public function destroy(Tag $tag)
    {
        //
    }
}
