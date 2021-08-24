<?php

use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Cache;
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
    return view('welcome');
});

Route::get('/cache-flush', function() {
    Cache::flush();
    return "Cache has been flushed";
});

Route::get('/hamming-distance/{firstNum}/{secondNum}', [UserController::class, 'hammingDistance']);
