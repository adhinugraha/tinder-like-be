<?php

namespace App\Repositories\API;

use App\Models\Like;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PeopleRepository extends BaseRepository
{
    protected $likeModel;
    public function __construct(
        User $model,
        Like $likeModel
    ) {
        $this->model = $model;
        $this->likeModel = $likeModel;
    }

    public function getRecommendations($request)
    {
        $userId = $request->user;
        
        $interactedUserIds = $this->likeModel->where('user_id', $userId)
            ->pluck('person_id')
            ->toArray();
            
        $interactedUserIds[] = $userId;

        $datas = $this->model
            ->with('images')
            ->whereNotIn('id', $interactedUserIds);

        return $datas;
    }

}
