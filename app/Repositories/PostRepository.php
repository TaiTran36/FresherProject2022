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
            return $this->model->where('title', 'LIKE', "%" . $data['search'] . "%")->oldest()->paginate(5)->withQueryString();
        } 
        return $this->model->latest()->paginate(5); 
    }

    public function findPost($id) 
    {
        return $this->model->where('id', $id)->first();
    }

    public function findPostByUrl($url) 
    {
        return $this->model->where('url', $url)->first();
    }

    public function checkExistUrl($data) 
    {
        $post = $this->model->where('id', '!=', $data['id'])->where('url', $data['url'])->first(); 

        if($post) {
            return FALSE; 
        }

        return TRUE; 
    }

    public function deletePost($id) 
    {
        return $this->model->where('id', $id)->delete();
    }

    public function countPostsOfAuthor($author)
    {
        return $this->model->where('author', $author)->count();
    }
}