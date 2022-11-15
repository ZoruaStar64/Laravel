<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeatherController;
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

// This route is the home page of the website
Route::view('/', 'index');

// This route here directs to the Weather API page
Route::get('/weather', [WeatherController::class, 'index']);

Route::prefix('user')->group(function() {
    Route::get('register-user', [UserController::class, 'registerPage']);
    // Route::post('register', [UserController::class, 'register']);
    Route::get('login-user', [UserController::class, 'loginPage']);
    // Route::post('login', [UserController::class, 'login']);
});

// All these routes are related to the Todos page
Route::prefix('todos')->group(function () {
    Route::get('/', [TodoController::class, 'index']);
    Route::get('create', [TodoController::class, 'create']);
    Route::post('store-data', [TodoController::class, 'store']);
    Route::delete('{todo}', [TodoController::class, 'delete']);
    Route::get('{todo}', [TodoController::class, 'details']);
    Route::get('{todo}/edit', [TodoController::class, 'edit']);
    Route::post('{todo}', [TodoController::class, 'update']);
    Route::post('check/{todo}', [TodoController::class, 'check']);
    
});