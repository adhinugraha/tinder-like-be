<?php

namespace App\Services\API;

use App\Helpers\Pagination;
use App\Repositories\API\PeopleRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class PeopleService extends BaseService
{
    protected $repo;

    public function __construct(
        PeopleRepository $repo
    ) {
        parent::__construct();
        $this->repo = $repo;
    }

    public function getRecommendations($request){
        try {
            $datas = $this->repo->getRecommendations($request);
            return Pagination::paginate($datas, $request);
        } catch (Exception $exc) {
            Log::error($exc);
            return $this->responseMessage('Data not found', 400, false, $exc);
        }

    }
}