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

/**
 * API Routes for Tinder-Like application
 */

Route::middleware('api')->group(function () {
    Route::prefix('people')->group(function () {
        /**
         * @OA\Get(
         *     path="/api/people/recommendations",
         *     summary="Get people recommendations",
         *     tags={"People"},
         *     @OA\Response(
         *         response=200,
         *         description="Successful operation",
         *         @OA\JsonContent(
         *             @OA\Property(property="data", type="array", @OA\Items(type="object")),
         *             @OA\Property(property="links", type="object"),
         *             @OA\Property(property="meta", type="object")
         *         )
         *     )
         * )
         */
        Route::get('recommendations', [PeopleController::class, 'recommendations']);

        /**
         * @OA\Get(
         *     path="/api/people/{personId}/liked",
         *     summary="Get people liked by a user",
         *     tags={"Likes"},
         *     @OA\Parameter(
         *         name="personId",
         *         in="path",
         *         required=true,
         *         description="ID of the person",
         *         @OA\Schema(type="integer")
         *     ),
         *     @OA\Response(
         *         response=200,
         *         description="Successful operation",
         *         @OA\JsonContent(
         *             @OA\Property(property="data", type="array", @OA\Items(type="object")),
         *             @OA\Property(property="links", type="object"),
         *             @OA\Property(property="meta", type="object")
         *         )
         *     )
         * )
         */
        Route::get('{personId}/liked', [LikeController::class, 'liked']);

        /**
         * @OA\Post(
         *     path="/api/people/{personId}/like/{likedPersonId}",
         *     summary="Like a person",
         *     tags={"Likes"},
         *     @OA\Parameter(
         *         name="personId",
         *         in="path",
         *         required=true,
         *         description="ID of the person who is liking",
         *         @OA\Schema(type="integer")
         *     ),
         *     @OA\Parameter(
         *         name="likedPersonId",
         *         in="path",
         *         required=true,
         *         description="ID of the person being liked",
         *         @OA\Schema(type="integer")
         *     ),
         *     @OA\Response(
         *         response=200,
         *         description="Successful operation",
         *         @OA\JsonContent(
         *             @OA\Property(property="message", type="string", example="Person liked successfully"),
         *             @OA\Property(property="success", type="boolean", example=true),
         *             @OA\Property(property="data", type="array", @OA\Items(type="object"))
         *         )
         *     ),
         *     @OA\Response(
         *         response=400,
         *         description="Bad request",
         *         @OA\JsonContent(
         *             @OA\Property(property="message", type="string", example="Cannot like yourself"),
         *             @OA\Property(property="success", type="boolean", example=false)
         *         )
         *     )
         * )
         */
        Route::post('{personId}/like/{likedPersonId}', [LikeController::class, 'like']);

        /**
         * @OA\Post(
         *     path="/api/people/{personId}/dislike/{dislikedPersonId}",
         *     summary="Dislike a person",
         *     tags={"Likes"},
         *     @OA\Parameter(
         *         name="personId",
         *         in="path",
         *         required=true,
         *         description="ID of the person who is disliking",
         *         @OA\Schema(type="integer")
         *     ),
         *     @OA\Parameter(
         *         name="dislikedPersonId",
         *         in="path",
         *         required=true,
         *         description="ID of the person being disliked",
         *         @OA\Schema(type="integer")
         *     ),
         *     @OA\Response(
         *         response=200,
         *         description="Successful operation",
         *         @OA\JsonContent(
         *             @OA\Property(property="message", type="string", example="Person disliked successfully"),
         *             @OA\Property(property="success", type="boolean", example=true),
         *             @OA\Property(property="data", type="array", @OA\Items(type="object"))
         *         )
         *     ),
         *     @OA\Response(
         *         response=400,
         *         description="Bad request",
         *         @OA\JsonContent(
         *             @OA\Property(property="message", type="string", example="Cannot dislike yourself"),
         *             @OA\Property(property="success", type="boolean", example=false)
         *         )
         *     )
         * )
         */
        Route::post('{personId}/dislike/{dislikedPersonId}', [LikeController::class, 'dislike']);
    });
});