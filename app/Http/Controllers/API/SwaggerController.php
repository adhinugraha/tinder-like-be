<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     title="Tinder-Like API",
 *     version="1.0.0",
 *     description="API for Tinder-Like application",
 *     @OA\Contact(
 *         email="admin@example.com",
 *         name="API Support"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="/api",
 *     description="API Server"
 * )
 * 
 * @OA\Schema(
 *     schema="Error",
 *     required={"message", "success"},
 *     @OA\Property(property="message", type="string", example="Error message"),
 *     @OA\Property(property="success", type="boolean", example=false)
 * )
 * 
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
 * 
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
 * 
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
 * 
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
class SwaggerController extends Controller
{
    // This controller exists solely for Swagger annotations
}