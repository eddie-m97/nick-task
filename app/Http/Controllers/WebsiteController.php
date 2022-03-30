<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Repositories\SubscriberRepository;
use App\Repositories\WebsiteRepository;
use Illuminate\Http\JsonResponse;

class WebsiteController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(WebsiteRepository $repository): JsonResponse
    {
        $data = $repository->listWebsites();
        return $this->successResponse('Success', $data);
    }

    public function subscribe(SubscribeRequest $request, SubscriberRepository $repository): JsonResponse
    {
        $repository->createSubscriber($request->website_id, $request->email);
        return $this->successResponse();
    }

}
