<?php

namespace App\Repositories; 

use App\Models\Like; 

class LikeRepository 
{
    public $model;

    public function __construct(Like $like)
	{
		$this->model = $like;
    }

    public function insertLike($data)
    {
        return $this->model->create($data);
    }

    public function updateLike($data)
    {
        return $this->model->where('likeable_id', $data['likeable_id'])->where('user_id', $data['user_id'])->update($data);
    }

    public function deleteUserLikedPost($data)
    {
        return $this->model->where('likeable_id', $data['likeable_id'])->where('user_id', $data['user_id'])->where('likeable_type', "like")->delete();
    }

    public function deleteUserDislikedPost($data) 
    {
        return $this->model->where('likeable_id', $data['likeable_id'])->where('user_id', $data['user_id'])->where('likeable_type', "dislike")->delete();
    }

    public function findUserLikedPost($data)
    {
        return $this->model->where('likeable_id', $data['likeable_id'])->where('user_id', $data['user_id'])->where('likeable_type', "like")->first();
    }

    public function findUserDislikedPost($data)
    {
        return $this->model->where('likeable_id', $data['likeable_id'])->where('user_id', $data['user_id'])->where('likeable_type', "dislike")->first();
    }

    public function countLikeOfAPost($id)
    {
        return $this->model->where('likeable_id', $id)->where('likeable_type', 'like')->count();
    }

    public function countDislikeOfAPost($id)
    {
        return $this->model->where('likeable_id', $id)->where('likeable_type', 'dislike')->count();
    }
}
