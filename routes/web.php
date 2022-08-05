<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/weather', function () {
    $location = 'Lelystad';
    $units = 'metric';
    $cnt = '7';
    $appid = 'aa92aac77c3a5120b9a48f8b388521ac';

    $currentResponse = Http::get("http://api.openweathermap.org/data/2.5/weather?appid={$appid}&q={$location}&units={$units}");
    $futureResponse = Http::get("http://api.openweathermap.org/data/2.5/forecast/daily?appid={$appid}&q={$location}&units={$units}&cnt={$cnt}");

    dump($futureResponse->json());

    return view('weather', [
        'currentWeather' => $currentResponse->json(),
        'futureWeather' => $futureResponse->json(),
    ]);
});

Route::get('database', 'App\Http\Controllers\TodoController@index');

Route::get('create', 'App\Http\Controllers\TodoController@create');
Route::post('store-data', 'App\Http\Controllers\TodoController@store');

Route::get('details/{todo}', 'App\Http\Controllers\TodoController@details');

Route::get('edit/{todo}', 'App\Http\Controllers\TodoController@edit');

Route::post('update/{todo}', 'App\Http\Controllers\TodoController@update');

Route::post('check/{todo}', 'App\Http\Controllers\TodoController@check');

Route::get('delete/{todo}', 'App\Http\Controllers\TodoController@delete');

Route::get('/create', function () {
    return view('create');
});
