<?php

namespace App\Console\Commands;

use App\Services\PostService;
use Illuminate\Console\Command;

class PostsSendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Posts To Subscribers';

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
     * @return int
     */
    public function handle(PostService $service)
    {
        $service->sendPostsToSubscribers();
        $this->info('Done.');
        return 0;
    }
}
