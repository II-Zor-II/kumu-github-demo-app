<?php

use App\Http\Controllers\api\GithubController;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/user', [UserController::class, 'store']);

Route::middleware('auth:sanctum')->get('/users/github', [GithubController::class, 'getUsers']);
