<?php

namespace App\Http\Controllers;

use App\Note;
use App\Tag;
use App\Upload;
use Illuminate\Http\Request;
use App\Http\Resources\NoteResource;
use App\Http\Requests\NoteRequest;
use Storage;
use Auth;
use Str;

class NoteController extends Controller
{
    public function index(Request $request, $tagId = null)
    {
        $tag = $tagId ? $request->user()->tags()->findOrFail($tagId) : new Tag;

        $query = $tag->exists ? $tag->notes() : $request->user()->notes();

        if ($search = $request->get('search')) {
            $query->where('content', 'LIKE', '%' . $search . '%');

            Note::setSearchPhrase($search);
        }

        $notes = $query->latest()->get();

        $tags = $request->user()->tags()->withCount('notes')->get();

        return view('notes.index', [
            'notes' => $notes,
            'tags' => $tags,
            'selectedTag' => $tag,
            'search' => $search,
        ]);
    }

    public function create(Request $request, $tagId = null)
    {
        $tag = $tagId ? $request->user()->tags()->findOrFail($tagId) : new Tag;

        $tags = $request->user()->tags;

        return view('notes.create', [
            'availableTags' => $tags,
            'note' => new Note,
            'tag' => $tag,
        ]);
    }

    public function store(NoteRequest $request)
    {
        $note = $request->user()->notes()->create($request->all());

        $tag = $request->user()->tags()->firstOrCreate([
            'name' => $request->get('tag'),
        ]);

        $note->tag()->associate($tag);

        $note->save();

        return redirect()->route('notes.edit', $note);
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);

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
    public function update(NoteRequest $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);

        $note->fill($request->all());

        $tag = $request->user()->tags()->firstOrCreate([
            'name' => $request->get('tag'),
        ]);

        $note->tag()->associate($tag);

        $note->save();

        foreach ($request->uploads ?? [] as $upload) {
            $path = Storage::disk('public')
                ->putFile('uploads/' . Auth::id(), $upload);

            $note->uploads()->create([
                'path' => $path,
                'name' => $upload->getClientOriginalName(),
                'size' => $upload->getSize(),
                'is_image' => Str::startsWith($upload->getMimeType(), 'image/'),
            ]);
        }

        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);

        $note->delete();

        return redirect()->back()
            ->withMessage('Deleted.
                <a href="' . route('notes.restore', $note) . '">Undo.</a>');
    }

    public function restore(Request $request, $id)
    {
        $note = $request->user()->notes()->withTrashed()->findOrFail($id)->restore();

        return redirect()->back()
            ->withMessage('Restored.');
    }
}
