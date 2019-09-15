<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Upload;

class CleanupUploads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'uploads:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove uploads that have been deleted for longer than 30 days';

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
        $notes = Upload::onlyTrashed()->where('deleted_at', '<', now()->subDays(30))
            ->get()->each(function ($n) {
                $n->forceDelete();
            });
    }
}

