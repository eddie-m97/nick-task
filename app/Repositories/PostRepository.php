<?php

namespace App\Repositories;

use App\Events\PostCreated;
use App\Models\Post;

class PostRepository
{
    /**
     * @param int $websiteId
     * @param string $body
     * @return void
     */
    public function createPost(int $websiteId, string $body)
    {
        $post = Post::create([
            'website_id' => $websiteId,
            'body' => $body
        ]);
        event(new PostCreated($post));
    }
}
