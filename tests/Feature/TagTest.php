<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Tag;
use App\Note;

class TagTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public $user;

    public function setUp():void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testRenameTag()
    {
        $tag = factory(Tag::class)->create([
            'user_id' => $this->user->id,
        ]);

        $updated = factory(Tag::class)->make();

        $response = $this->actingAs($this->user)
            ->put(route('tags.update', $tag), [
                'new_name' => $updated->name,
            ])
            ->assertRedirect();

        $tag->refresh();

        $this->assertEquals($tag->name, $updated->name);
    }

    public function testDeleteTag()
    {
        $tag = factory(Tag::class)->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)
            ->delete(route('tags.destroy', $tag))
            ->assertRedirect();

        $this->assertDatabaseMissing('tags', [
            'id' => $tag->id,
        ]);
    }

    public function testMoveTag()
    {
        $oldTag = factory(Tag::class)->create([
            'user_id' => $this->user->id,
        ]);

        $newTag = factory(Tag::class)->create([
            'user_id' => $this->user->id,
        ]);

        $oldTag->notes()->saveMany(factory(Note::class, 10)->make([
            'user_id' => $this->user->id,
        ]));

        $this->assertEquals($oldTag->notes()->count(), 10);
        $this->assertEquals($newTag->notes()->count(), 0);

        $response = $this->actingAs($this->user)
            ->post(route('tags.move', $oldTag), [
                'new_tag' => $newTag->id,
            ])
            ->assertRedirect();

        $this->assertEquals($oldTag->notes()->count(), 0);
        $this->assertEquals($newTag->notes()->count(), 10);
    }
}
