<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Repositories\PostRepository;
use Illuminate\Http\JsonResponse;

class PostController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePostRequest $request
     * @param PostRepository $repository
     * @return JsonResponse
     */
    public function store(CreatePostRequest $request, PostRepository $repository): JsonResponse
    {
        $repository->createPost($request->website_id, $request->body);
        return $this->successResponse();
    }
}
