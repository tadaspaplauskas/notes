<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Note;

class PerformanceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDBPerformance()
    {
        $this->markTestSkipped();
        factory(Note::class, 10000)->create(['user_id' => '70E2E8DE-500E-4630-B3CB-166131D35C21']);

        $theOne = factory(Note::class)->create(['user_id' => '70E2E8DE-500E-4630-B3CB-166131D35C21']);

        factory(Note::class, 10000)->create(['user_id' => '70E2E8DE-500E-4630-B3CB-166131D35C21']);

        $this->assertNotNull(Note::find($theOne->id));
    }
}
