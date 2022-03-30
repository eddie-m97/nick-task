<?php

namespace App\Repositories;

use App\Models\Website;
use Illuminate\Support\Facades\Cache;

class WebsiteRepository
{
    public function listWebsites()
    {
        $page = (int)request('page', 1);
        return Cache::remember('list-websites-' . $page, now()->addDay(), function () {
            return Website::orderBy('id')->simplePaginate(20);
        });
    }
}
