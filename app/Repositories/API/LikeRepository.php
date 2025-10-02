<?php

namespace App\Repositories\API;

use App\Models\Like;
use App\Repositories\BaseRepository;

class LikeRepository extends BaseRepository
{
    protected $repoUser;
    public function __construct(
        Like $model
    ) {
        $this->model = $model;
    }

    public function getLikedByUserId($request)
    {
        $datas = $this->model->where('user_id', $request->personId)
            ->where('is_like', true)->with('person');

        return $datas;
    }

}
