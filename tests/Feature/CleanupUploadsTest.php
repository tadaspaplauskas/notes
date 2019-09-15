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

class CleanupUploadsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public $user;

    public function setUp():void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testCleanupDeletedUploads()
    {
        $uploadedFile = UploadedFile::fake()->image('file1.jpg');

        Storage::put($this->uploadPath($uploadedFile), 'content content');

        $note = factory(Note::class)->create([
            'user_id' => $this->user->id,
        ]);

        $upload = $note->uploads()->save(factory(Upload::class)->make([
            'path' => $this->uploadPath($uploadedFile),
        ]));

        $upload->deleted_at = now()->subDays(45);
        $upload->save();

        Storage::assertExists($upload->path);

        $this->artisan('uploads:clean');

        $this->assertDatabaseMissing('uploads', [
            'id' => $upload->id,
        ]);

        Storage::assertMissing($upload->path);
    }
}

