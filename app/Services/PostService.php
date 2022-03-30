<?php

namespace App\Services;

use App\Models\Post;
use App\Notifications\PostPublished;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Log;

class PostService
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function sendPostsToSubscribers()
    {
        $posts = $this->postRepository->getNotSentPosts();
        foreach ($posts as $post) {
            try {
                $this->sendPostToSubscribers($post);
            } catch (\Exception $exception) {
                Log::error('Error to send post to subscribers', [
                    'post_id' => $post->id,
                    'message' => $exception->getMessage(),
                    'trace' => $exception->getTraceAsString(),
                ]);
            }
        }
    }

    private function sendPostToSubscribers(Post $post)
    {
        foreach ($post->website->subscribers as $subscriber) {
            $subscriber->notify(new PostPublished($post));
        }
        $post->update(['sent' => true]);
    }
}
