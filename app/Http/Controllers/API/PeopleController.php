<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\API\PeopleService;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    protected $service;

    public function __construct(
        PeopleService $service
    )
    {
        $this->service = $service;
    }

    public function recommendations(Request $request)
    {
        return $this->service->getRecommendations($request);
    }
}
