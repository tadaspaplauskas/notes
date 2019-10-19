<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Note;

class BookmarkTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testBookmarking()
    {
        $user = factory(User::class)->create();

        $payload = [
            'url' => 'https://example.com',
            'title' => 'Example Domain',
            'selection' => 'This domain is for use in illustrative examples',
        ];

        $response = $this->actingAs($user)
            ->call('GET', '/bookmark', $payload)
            ->assertSessionHasNoErrors();

        $note = Note::latest()->first();

        $response->assertRedirect(route('notes.edit', $note));

        $this->assertContains($payload['url'], $note->content);
        $this->assertContains($payload['title'], $note->content);
        $this->assertContains($payload['selection'], $note->content);
    }
}
