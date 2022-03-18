<?php 

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Str;

class PostRepository {
    public $model;

    public function __construct(Post $post)
	{
		$this->model = $post;
    }

    public function createPost($data) 
    {
        return $this->model->create($data); 
    }

    public function updatePost($data)
    {
        return $this->model->where('id', $data['id'])->update($data);
    }
 
    public function getListPost($data) 
    {
        if(!empty($data)) { 
            return $this->model->where('title', 'LIKE', "%" . $data['search'] . "%")->latest()->paginate(10);
        } 
        return $this->model->latest()->paginate(10); 
    }

    public function findPost($id) 
    {
        return $this->model->where('id', $id)->first();
    }
}