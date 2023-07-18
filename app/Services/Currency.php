<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Currency
{

    protected $apiKey = '1464a5bc6c859e40dec9';

    public function get($from, $to)
    {
        $q = strtoupper($from) . '_' . strtoupper($to);
        $ch = curl_init("https://free.currconv.com/api/v7/convert?apiKey={$this->apiKey}&q={$q}&compact=y");
        // curl_setopt it's use add option on url

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // here I don't send any header
        curl_setopt($ch, CURLOPT_HEADER, false);

        // curl_exec this's function use to send the request
        $result = curl_exec($ch);

        // json_decode it's use convert the string to json object

        return json_decode($result, true);
    }

    public function getBulk($from, array $to)
    {
        $q = [];

        foreach ($q as $value) {
            $q[] = strtoupper($value) . '_' . strtoupper($from);
        }

        return Http::baseUrl('https://free.currconv.com/api/v7')
            ->get('convert', [
                'apiKey' => $this->apiKey,
                'q' => implode(',', $q),
            ]);
    }
}
