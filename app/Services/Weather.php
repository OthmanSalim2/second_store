<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Weather
{

    protected $apiKey = 'd6562e520ff7c1cd4966625646c0f2c1';

    protected $baseUrl = 'https://api.openweathermap.org/data/2.5';

    public function getByCity($city)
    {
        return Http::baseUrl($this->baseUrl)
            ->get('weather', [
                'appid' => $this->apiKey,
                'q' => $city,
                'units' => 'metric',
                'lang' => 'ar',
            ])
            ->json();
    }
}
