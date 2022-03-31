<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Subscriber;
use App\Notifications\PostPublished;

class PostService
{
    private const SUBSCRIBER_CHUNK_SIZE = 50;

    /**
     * @param Post $post
     * @return void
     */
    public function sendPostToSubscribers(Post $post)
    {
        Subscriber::where('website_id', $post->website_id)->whereDoesntHave('sentPosts', function ($query) use ($post) {
            $query->where('post_id', $post->id);
        })->chunkById(self::SUBSCRIBER_CHUNK_SIZE, function ($subscribers) use ($post) {
            foreach ($subscribers as $subscriber) {
                $subscriber->notify(new PostPublished($post));
                // Even if job fails at all, and we run "php artisan queue:failed", subscriber will not get duplicate email.
                $subscriber->sentPosts()->create([
                    'post_id' => $post->id
                ]);
            }
        });
    }
}
