<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Note;

class CleanupNotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notes:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes notes and related resources for real after 30 days since soft deletion';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $notes = Note::onlyTrashed()->where('deleted_at', '<', now()->subDays(30))
            ->get()->each(function ($n) {
                $n->forceDelete();
            });
    }
}
