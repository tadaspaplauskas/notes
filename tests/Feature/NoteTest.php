<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Note;

class NoteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public $user;
    public $account;

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
            $response->assertSee($note->text);
        }
    }

    public function testCreateNote()
    {
        $note = factory(Note::class)->make();

        $response = $this->actingAs($this->user)
            ->post(route('notes.store'), [
                'text' => $note->text,
            ])
            ->assertStatus(302)
            ->withSession([
                'message' => 'Note created successfully'
            ]);

        $this->assertDatabaseHas('notes', [
            'text' => $note->text,
            'user_id' => $this->user->id,
        ]);
    }
}
