<?php

namespace App\Http\Controllers\Api;

use App\Note;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $notes = $request->user()->notes;

        return response()->json($notes);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tags' => '',
            'text' => 'required',
        ]);

        $note = Auth::user()->notes()->create($data);

        $inputTags = explode(',', $data['tags']);

        foreach ($inputTags as $t) {
            $tag = Auth::user()->tags()->firstOrCreate(['name' => strtolower(trim($t))]);

            $note->tags()->attach($tag);
        }

        return response()->json($note, 201);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}
