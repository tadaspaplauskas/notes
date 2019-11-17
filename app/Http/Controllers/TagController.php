<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Tag $tag)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $tag = $request->user()->tags()->findOrFail($id);

        $tags = $request->user()->tags;

        return view('tags.edit', [
            'tag' => $tag,
            'tags' => $tags,
        ]);
    }

    public function update(Request $request, $id)
    {
        $tag = $request->user()->tags()->findOrFail($id);

        $request->validate([
            'new_name' => 'required',
            'private' => 'boolean',
        ]);

        $tag->name = $request->input('new_name');
        $tag->private = $request->has('private');

        $tag->save();

        return redirect()->route('tags.notes.index', $tag)
            ->withMessage('Tag was updated');
    }

    public function destroy(Request $request, $id)
    {
        $tag = $request->user()->tags()->findOrFail($id);

        $request->user()->notes()
            ->where('tag_id', $tag->id)
            ->update(['tag_id' => null]);

        $tag->delete();

        return redirect()->route('notes.index')
            ->withMessage('Tag was deleted');
    }

    public function move(Request $request, $id)
    {
        $tag = $request->user()->tags()->findOrFail($id);

        $request->validate([
            'new_tag' => 'required|exists:tags,id',
        ]);

        $newTag = $request->user()->tags()->findOrFail($request->input('new_tag'));

        $request->user()->notes()
            ->where('tag_id', $tag->id)
            ->update(['tag_id' => $newTag->id]);

        return redirect()->route('tags.notes.index', $tag)
            ->withMessage('Tag ' . $tag->name . ' were moved');
    }
}
