<?php 

namespace App\Repositories; 

use App\Models\Comment; 

class CommentRepository {
    public $model;

    public function __construct(Comment $comment)
	{
		$this->model = $comment;
    }

    public function createComment($data) 
    {
        return $this->model->create($data); 
    }

    public function updateComment($data)
    {
        return $this->model->where('id', $data['id'])->update($data);
    }

    public function deleteComment($id) 
    {
        return $this->model->where('id', $id)->delete();
    }

    public function findComment($id)
    {
        return $this->model->where('id', $id)->first();
    }
}