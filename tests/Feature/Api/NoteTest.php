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
            ->get(route('api.notes.index'))
            ->assertStatus(200);

        foreach ($notes as $note) {
            $response->assertSee($note->text);
        }
    }

    public function testCreateNote()
    {
        $note = factory(Note::class)->make();

        $response = $this->actingAs($this->user)
            ->post(route('api.notes.store'), [
                'tags' => 'recipes,quotes',
                'text' => $note->text,
            ])
            ->assertStatus(201);

        $note = $this->user->notes()->where('text', $note->text)->first();

        $this->assertNotNull($note);

        $tags = $note->tags->pluck('name');

        $this->assertTrue($tags->contains('recipes'));
        $this->assertTrue($tags->contains('quotes'));
    }
}
