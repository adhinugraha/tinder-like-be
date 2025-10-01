<?php

namespace App\Repositories\API;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PeopleRepository extends BaseRepository
{
    protected $repoUser;
    public function __construct(
        User $model
    ) {
        $this->model = $model;
    }

    public function getRecommendations($request)
    {
        $datas = $this->model
            ->with('images');

        return $datas;
    }

}
