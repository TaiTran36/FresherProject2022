<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostRepository
{
    public $model;
    public function __construct(Post $post)
    {
        $this->model = $post;
    }
    public function listPost()
    {
        return $this->model->with('userInfo')->paginate(1);
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

    public function deletePost($id)
    {
        return $this->model->where('id', $id)->delete($id);
    }


    public function updatePost($data, $id)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function searchPost($search)
    {
        return $this->model->where('post_title', 'like', "%$search%")->paginate(1);
    }
}
