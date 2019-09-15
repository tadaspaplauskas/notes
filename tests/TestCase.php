<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\UploadedFile;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function uploadPath(UploadedFile $file)
    {
        return 'uploads/' . $this->user->id . '/' . $file->hashName();
    }
}

