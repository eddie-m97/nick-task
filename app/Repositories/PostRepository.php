<?php

namespace App\Repositories;

use App\Events\PostCreated;
use App\Models\Post;

class PostRepository
{
    public function createPost(int $websiteId, string $body)
    {
        $post = Post::create([
            'website_id' => $websiteId,
            'body' => $body
        ]);
        event(new PostCreated($post));
    }

    public function getNotSentPosts()
    {
        return Post::select('id', 'website_id', 'body', 'created_at')->where('sent', false)->has('subscribers')->with([
            'website' => function ($query) {
                $query->select('id', 'name')->with('subscribers:id,website_id,email');
            },
        ])->get();
    }
}
