<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeoIp
{
    public function get($ip)
    {
        // curl this's protocol use to send request from server to another
        $response = Http::baseUrl('https://api.ipgeolocation.io')
            ->get('ipgeo', [
                'apiKey' => 'd90084686e6743a5aae74dc6a446602f',
                'ip' => $ip,
            ]);

        $data = $response->json();
        return $data;
    }
}
