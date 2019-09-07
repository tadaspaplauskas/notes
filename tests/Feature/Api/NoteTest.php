<?php

namespace Tests\Feature\Api;

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
            $response->assertSee($note->content);
        }
    }

    public function testCreateNote()
    {
        $note = factory(Note::class)->make();

        $response = $this->actingAs($this->user)
            ->post(route('notes.store'), [
                'tags' => 'recipes,quotes',
                'content' => $note->content,
            ])
            ->assertStatus(201);

        $note = $this->user->notes()->where('content', $note->content)->first();

        $this->assertNotNull($note);

        $tags = $note->tags->pluck('name');

        $this->assertTrue($tags->contains('recipes'));
        $this->assertTrue($tags->contains('quotes'));
    }

    public function testUpdateNote()
    {
        $note = factory(Note::class)->create([
            'user_id' => $this->user->id,
        ]);

        $updated = factory(Note::class)->make();

        $response = $this->actingAs($this->user)
            ->put(route('notes.update', $note), [
                'content' => $updated->content,
            ])
            ->assertStatus(200);

        $note = $this->user->notes()->where('content', $updated->content)->first();

        $this->assertNotNull($note);
    }
}
