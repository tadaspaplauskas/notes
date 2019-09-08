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

    public function create(Request $request)
    {
        $tags = $request->user()->tags;

        return view('notes.create', [
            'tags' => $tags,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required',
            'tags' => ''
        ]);

        $note = $request->user()->notes()->create($data);

        if (isset($data['tags'])) {
            $inputTags = explode(',', $data['tags']);

            foreach ($inputTags as $t) {
                $tag = $request->user()->tags()->firstOrCreate(['name' => strtolower(trim($t))]);

                $note->tags()->attach($tag);
            }
        }

        return redirect()->route('notes.index')
            ->withMessage('New note created');
    }

    public function show(Note $note)
    {
        //
    }

    public function edit(Note $note)
    {
        //
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
            'tags' => ''
        ]);

        $note->update($data);

        if (isset($data['tags'])) {
            $inputTags = explode(',', $data['tags']);

            foreach ($inputTags as $t) {
                $tag = $request->user()->tags()->firstOrCreate(['name' => strtolower(trim($t))]);

                $note->tags()->attach($tag);
            }
        }

        return new NoteResource($note);
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
