<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    // This currently gets both the Current weather and the Future weather
    // the Future weather is currently 7 Days and can be changed to anything lower (if im right it can actually go to 9 or 13?..)
    public function index () {
        $location = 'Lelystad';
        $units = 'metric';
        $cnt = '7';
        $appid = config('services.openweather.key');

        $currentResponse = Http::get("http://api.openweathermap.org/data/2.5/weather?appid={$appid}&q={$location}&units={$units}");
        $futureResponse = Http::get("http://api.openweathermap.org/data/2.5/forecast/daily?appid={$appid}&q={$location}&units={$units}&cnt={$cnt}");

        dump($futureResponse->json());

        return view('weather', [
            'currentWeather' => $currentResponse->json(),
            'futureWeather' => $futureResponse->json(),
        ]);
    }
}
