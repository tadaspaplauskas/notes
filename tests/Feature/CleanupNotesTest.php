<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Storage;
use App\Note;
use App\User;
use App\Upload;

class CleanupNotesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public $user;

    public function setUp():void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testCleanupDeletedNotes()
    {
        $uploadedFile = UploadedFile::fake()->image('file1.jpg');

        Storage::put($this->uploadPath($uploadedFile), 'content content');

        $note = factory(Note::class)->create([
            'user_id' => $this->user->id,
        ]);

        $upload = $note->uploads()->save(factory(Upload::class)->make([
            'path' => $this->uploadPath($uploadedFile),
        ]));

        $note->deleted_at = now()->subDays(45);
        $note->save();

        Storage::assertExists($upload->path);

        $this->artisan('notes:clean');

        $this->assertDatabaseMissing('notes', [
            'id' => $note->id,
        ]);

        Storage::assertMissing($upload->path);
    }
}
