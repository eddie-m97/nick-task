<?php

namespace App\Providers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ResponseFactory::macro('apiSuccess', function (string $message = 'Success', $data = null, int $status = 200) {
            return response()->json([
                'message' => $message,
                'data' => $data,
            ], $status);
            // Other data
        });
        ResponseFactory::macro('apiError', function (string $message = 'Error', $errors = null, int $status = 500) {
            return response()->json([
                'message' => $message,
                'errors' => $errors,
                // Other data
            ], $status);
        });
    }
}
