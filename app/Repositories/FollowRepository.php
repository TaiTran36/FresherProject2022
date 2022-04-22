<?php 

namespace App\Repositories; 

use App\Models\Follow;

class FollowRepository 
{
    public $model;

    public function __construct(Follow $follow)
	{
		$this->model = $follow;
    }

    public function insertFollow($data)
    {
        return $this->model->create($data);
    }

    public function findUserFollowed($data)
    {
        return $this->model->where('followed_id', $data['followed_id'])->where('follower_id', $data['follower_id'])->first();
    }

    public function findFollowerList($id)
    {
        return $this->model->select('follower_id')->where('followed_id', $id)->get();
    }

    public function deleteFollow($data)
    {
        return $this->model->where('followed_id', $data['followed_id'])->where('follower_id', $data['follower_id'])->delete();
    }
}