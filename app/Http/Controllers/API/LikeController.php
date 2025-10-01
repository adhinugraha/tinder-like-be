<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\API\LikeService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    protected $service;

    public function __construct(
        LikeService $service
    )
    {
        $this->service = $service;
    }

    public function like(Request $request){
        return $this->service->like($request);
    }

    public function dislike(Request $request){
        return $this->service->dislike($request);
    }

    public function liked(Request $request)
    {
        return $this->service->getLiked($request);
    }
}
