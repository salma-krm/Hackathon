<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HackathonController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\ThemeController;
use App\Models\Hackathon;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(RulesController::class)->group(function () {
    route::post('create', 'create');
    route::post('update', 'update');
    route::post('delete', 'delete');
});


Route::controller(ThemeController::class)->group(function () {
    route::post('createtheme', 'create');
    route::post('updatetheme', 'update');
    route::post('deletetheme', 'delete');
});
Route::controller(HackathonController::class)->group(function () {
    route::get('gethackathon', 'index');
    Route::middleware(['auth:JWT', 'role.organisateur'])->post('createhackathon', 'create');
    route::post('updatehackathon', 'update');
    route::post('deletehackathon', 'delete');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:api');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');
});
