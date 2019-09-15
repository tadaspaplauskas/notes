<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Storage;
use App\User;
use App\Note;
use App\Upload;

class UploadTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public $user;

    public function setUp():void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testUploadFiles()
    {
        Storage::fake('public');

        $uploads = [
            UploadedFile::fake()->image('file1.jpg'),
            UploadedFile::fake()->image('file2.jpg'),
        ];

        $note = factory(Note::class)->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)
            ->put(route('notes.update', $note), [
                'tag' => 'recipes',
                'content' => $note->content,
                'uploads' => $uploads,
            ])
            ->assertRedirect();

        foreach ($uploads as $upload) {
            Storage::disk('public')->assertExists($this->uploadPath($upload));

            $this->assertTrue($note->uploads()
                ->where('path', $this->uploadPath($upload))
                ->where('name', $upload->getClientOriginalName())
                ->where('is_image', 1)
                ->exists());
        }
    }

    public function testDeleteUploadedFile()
    {
        Storage::fake('public');

        $uploadedFile = UploadedFile::fake()->image('file1.jpg');

        Storage::disk('public')
            ->putFile($this->uploadPath($uploadedFile), $uploadedFile);

        $note = factory(Note::class)->create([
            'user_id' => $this->user->id,
        ]);

        $upload = $note->uploads()->save(factory(Upload::class)->make([
            'path' => $this->uploadPath($uploadedFile),
        ]));

        $response = $this->actingAs($this->user)
            ->get(route('uploads.delete', $upload))
            ->assertRedirect();

        Storage::disk('public')->assertExists($this->uploadPath($uploadedFile));

        $this->assertSoftDeleted('uploads', [
            'id' => $upload->id,
        ]);
    }

    public function testRestoreDeletedUploadedFile()
    {
        Storage::fake('public');

        $uploadedFile = UploadedFile::fake()->image('file1.jpg');

        Storage::disk('public')
            ->putFile($this->uploadPath($uploadedFile), $uploadedFile);

        $note = factory(Note::class)->create([
            'user_id' => $this->user->id,
        ]);

        $upload = $note->uploads()->save(factory(Upload::class)->make([
            'path' => $this->uploadPath($uploadedFile),
        ]));

        $upload->delete();

        $response = $this->actingAs($this->user)
            ->get(route('uploads.restore', $upload))
            ->assertRedirect();

        Storage::disk('public')->assertExists($this->uploadPath($uploadedFile));

        $this->assertDatabaseHas('uploads', [
            'id' => $upload->id,
        ]);
    }
}
