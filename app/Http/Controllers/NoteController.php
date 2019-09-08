<?php

namespace App\Http\Controllers;

use App\Note;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\NoteResource;

class NoteController extends Controller
{
    public function index(Request $request, Tag $tag)
    {
        $notes = $tag->exists ? $tag->notes : $request->user()->notes;

        $tags = $request->user()->tags()->withCount('notes')->get();

        return view('notes.index', [
            'notes' => $notes,
            'tags' => $tags,
            'selectedTag' => $tag,
        ]);
    }

    public function create(Request $request, Tag $tag)
    {
        $tags = $request->user()->tags;

        return view('notes.create', [
            'availableTags' => $tags,
            'note' => new Note,
            'tag' => $tag,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required',
            'tag' => 'required'
        ]);

        $note = $request->user()->notes()->create($data);

        $tag = $request->user()->tags()->firstOrCreate(['name' => strtolower(trim($data['tag']))]);

        $note->tag()->associate($tag);

        $note->save();

        return redirect()->route('notes.edit', $note);
    }

    public function show(Note $note)
    {
        //
    }

    public function edit(Request $request, Note $note)
    {
        $tags = $request->user()->tags;

        return view('notes.edit', [
            'availableTags' => $tags,
            'note' => $note,
            'tag' => $note->tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $data = $request->validate([
            'content' => 'required',
            'tag' => 'required'
        ]);

        $note->fill($data);

        $tag = $request->user()->tags()->firstOrCreate(['name' => strtolower(trim($data['tag']))]);

        $note->tag()->associate($tag);

        $note->save();

        return redirect()->back();
    }

    public function delete(Note $note)
    {
        $note->delete();

        return redirect()->back()
            ->withMessage('Deleted.
                <a href="' . route('notes.restore', $note) . '">Undo.</a>');
    }

    public function restore(Request $request, $id)
    {
        $note = $request->user()->notes()->withTrashed()->find($id)->restore();

        return redirect()->back()
            ->withMessage('Restored.');
    }
}
