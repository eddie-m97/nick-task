<?php

namespace App\Jobs;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPostToSubscribersJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private const QUEUE_NAME = 'process-post';

    protected Post $post;

    /**
     * The number of seconds after which the job's unique lock will be released.
     *
     * @var int
     */
    public $uniqueFor = 14400; // 4 hours

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->queue = self::QUEUE_NAME;
        $this->post = $post;
    }

    /**
     * The unique ID of the job.
     *
     * @return int
     */
    public function uniqueId()
    {
        return $this->post->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(PostService $postService)
    {
        $postService->sendPostToSubscribers($this->post);
    }
}
