<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Note;
use App\Tag;

class PublicPageTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user, $tags, $notes;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->tags = factory(Tag::class, 5)->create([
            'user_id' => $this->user->id,
        ]);

        $this->notes = collect();

        foreach ($this->tags as $tag) {
            $this->notes->push(factory(Note::class)->create([
                'user_id' => $this->user->id,
                'tag_id' => $tag->id,
            ]));
        }
    }

    public function testPublicPageWithAuth()
    {
        $response = $this->actingAs($this->user)
            ->get(route('public', $this->user))
            ->assertStatus(200);

        foreach ($this->notes as $note) {
            $response->assertSee($note->html);
        }
    }

    public function testPublicPageWithoutAuth()
    {
        $response = $this->get(route('public', $this->user))
            ->assertStatus(200);

        foreach ($this->notes as $note) {
            $response->assertSee($note->html);
        }
    }
}
