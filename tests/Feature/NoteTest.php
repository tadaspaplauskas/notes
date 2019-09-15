<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Storage;
use App\User;
use App\Note;

class NoteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public $user;

    public function setUp():void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testListNotes()
    {
        $notes = factory(Note::class, 10)->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('notes.index'))
            ->assertStatus(200);

        foreach ($notes as $note) {
            $response->assertSee($note->content);
        }
    }

    public function testCreateNote()
    {
        $note = factory(Note::class)->make();

        $response = $this->actingAs($this->user)
            ->post(route('notes.store'), [
                'tag' => 'recipes',
                'content' => $note->content,
            ])
            ->assertRedirect();

        $note = $this->user->notes()->where('content', $note->content)->first();

        $this->assertNotNull($note);
        $this->assertTrue($note->tag->name === 'recipes');
    }

    public function testUpdateNote()
    {
        $note = factory(Note::class)->create([
            'user_id' => $this->user->id,
        ]);

        $updated = factory(Note::class)->make();

        $response = $this->actingAs($this->user)
            ->put(route('notes.update', $note), [
                'tag' => 'recipes',
                'content' => $updated->content,
            ])
            ->assertRedirect();

        $this->assertTrue($this->user->notes()->where('content', $updated->content)->exists());
    }
}
