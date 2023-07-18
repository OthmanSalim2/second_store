<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Currency;
use App\Services\GeoIp;
use App\Services\Weather;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $geoip = new GeoIp();
        $geo = $geoip->get('94.26.123.46');

        $currency = new Currency();
        $ex = $currency->getBulk($geo['currency']['code'], ['USD', 'JOD']);

        // dd($ex);
        $weather = (new Weather())->getByCity('Gaza');

        return view('dashboard.dashboard', [
            'geo' => $geo,
            // 'exchange' => $ex['results'],
            'weather' => $weather,
            'user' => Auth::user(),

        ]);
    }
}
