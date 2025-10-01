<?php

namespace App\Services\API;

use App\Helpers\Pagination;
use App\Repositories\API\LikeRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LikeService extends BaseService
{
    protected $repo;

    public function __construct(
        LikeRepository $repo
    ) {
        parent::__construct();
        $this->repo = $repo;
    }

    public function like($request){
        $personId = $request->personId;
        $likedPersonId = $request->likedPersonId;

        if ($personId === $likedPersonId) {
            return $this->responseMessage('Cannot like yourself', 400, false);
        }

        // Check if a like/dislike already exists
        $existingLike = $this->repo->getByMultipleField([
            'person_id' => $personId,
            'user_id' => $likedPersonId
        ])->first();

        $db = DB::connection($this->connection);
        $db->beginTransaction();

        try {

            if ($existingLike) {
                $existingLike->is_like = true;
                $existingLike->save();

                $db->commit();
                return $this->responseMessage('Person liked successfully', 200, true);
            }

            $data['person_id'] = $personId;
            $data['user_id'] = $likedPersonId;
            $data['is_like'] = true;
            $this->repo->create($data);

            $db->commit();
            return $this->responseMessage('Person liked successfully', 200, true);
        } catch (Exception $exc) {
            Log::error($exc);
            $db->rollback();
            return $this->responseMessage('Could not update. Please check again.', 400, false);
        }
    }

    public function dislike($request){
        $personId = $request->personId;
        $dislikedPersonId = $request->dislikedPersonId;

        if ($personId === $dislikedPersonId) {
            return $this->responseMessage('Cannot dislike yourself', 400, false);
        }

        // Check if a like/dislike already exists
        $existingLike = $this->repo->getByMultipleField([
            'person_id' => $personId,
            'user_id' => $dislikedPersonId
        ])->first();

        $db = DB::connection($this->connection);
        $db->beginTransaction();

        try {

            if ($existingLike) {
                $existingLike->is_like = false;
                $existingLike->save();
                
                $db->commit();
                return $this->responseMessage('Person disliked successfully', 200, true);
            }

            $data['person_id'] = $personId;
            $data['user_id'] = $dislikedPersonId;
            $data['is_like'] = false;
            $this->repo->create($data);

            $db->commit();
            return $this->responseMessage('Person disliked successfully', 200, true);
        } catch (Exception $exc) {
            Log::error($exc);
            $db->rollback();
            return $this->responseMessage('Could not update. Please check again.', 400, false);
        }
    }

    public function getLiked($request){
        try {
            $datas = $this->repo->getLikedByUserId($request);
            return Pagination::paginate($datas, $request);
        } catch (Exception $exc) {
            Log::error($exc);
            return $this->responseMessage('Data not found', 400, false, $exc);
        }
    }
}