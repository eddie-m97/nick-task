<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class BaseController extends Controller
{
    /**
     * Return Success Response
     *
     * @param string $message
     * @param array|null $data
     * @param int $status
     *
     * @return JsonResponse
     * @noinspection PhpUndefinedMethodInspection
     */
    protected function successResponse(string $message = 'Success', $data = null, int $status = 200): JsonResponse
    {
        return response()->apiSuccess($message, $data, $status);
    }

    /**
     * Return Success Response
     *
     * @param string $message
     * @param array|null $errors
     * @param int $status
     *
     * @return JsonResponse
     * @noinspection PhpUndefinedMethodInspection
     */
    protected function errorResponse(string $message = 'Error', $errors = null, int $status = 500): JsonResponse
    {
        return response()->apiError($message, $errors, $status);
    }
}
