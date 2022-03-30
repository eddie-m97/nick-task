<?php

namespace App\Repositories;

use App\Models\Subscriber;

class SubscriberRepository
{
    public function createSubscriber(int $websiteId, string $email)
    {
        Subscriber::create([
            'website_id' => $websiteId,
            'email' => $email
        ]);
    }
}
