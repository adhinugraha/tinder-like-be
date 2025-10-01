<?php

use App\Http\Controllers\API\PeopleController;
use App\Http\Controllers\API\LikeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('api')->group(function () {
    Route::prefix('people')->group(function () {
        Route::get('recommendations', [PeopleController::class, 'recommendations']);
        Route::get('{personId}/liked', [LikeController::class, 'liked']);
        Route::post('{personId}/like/{likedPersonId}', [LikeController::class, 'like']);
        Route::post('{personId}/dislike/{dislikedPersonId}', [LikeController::class, 'dislike']);
    });
});