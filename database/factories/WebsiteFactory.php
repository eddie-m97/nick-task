<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class WebsiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $domain = $this->faker->domainName();
        return [
            'name' => Str::ucfirst(Str::before($domain, '.')),
            'url' => Arr::random(['http://', 'https://']) . $domain,
        ];
    }
}
