<?php

namespace App\Console\Commands;

use App\Jobs\SendPostToSubscribersJob;
use App\Models\Post;
use App\Traits\LockableCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Command\SignalableCommandInterface;
use Throwable;

class PostsSendCommand extends Command implements SignalableCommandInterface
{
    use LockableCommand;

    private const NOT_PROCESSED_POSTS_CHUNK_SIZE = 50;

    protected string $lockKey = 'posts_send_command_lock';
    protected int $lockTimeout = 60; // Maximum seconds for processing single chunk

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
    public function handle(): int
    {
        if ($this->isLocked()) {
            $this->error('Command already running.');
            return 0;
        }
        $this->lock(); // Creates cache with timeout (in case of failure)
        try {
            $this->processPosts();
        } catch (Throwable $exception) {
            Log::error('Error to dispatch posts sending to subscribers', [
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);
        }
        $this->releaseLock();
        $this->info('Done.');
        return 0;
    }

    /**
     * @return void
     */
    private function processPosts(): void
    {
        Post::select(['id', 'website_id', 'body'])->withExists('subscribers')->chunkById(self::NOT_PROCESSED_POSTS_CHUNK_SIZE, function ($posts) {
            $this->lock(); // Refresh the lock
            foreach ($posts as $post) {
                try {
                    if ($post->subscribers_exists) {
                        SendPostToSubscribersJob::dispatch($post);
                    }
                    $post->update(['processed' => true]);
                } catch (Throwable $exception) {
                    Log::error('Error to dispatch post sending to subscribers', [
                        'post_id' => $post->id,
                        'message' => $exception->getMessage(),
                        'trace' => $exception->getTraceAsString(),
                    ]);
                }
            }
        });
    }
}
