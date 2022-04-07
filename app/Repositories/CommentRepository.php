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
}