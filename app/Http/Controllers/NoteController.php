<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\NoteResource;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $notes = $request->user()->notes;

        return NoteResource::collection($notes);
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

        return new NoteResource($note);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return new NoteResource($note);
    }
}
