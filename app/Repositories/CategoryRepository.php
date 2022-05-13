<?php 

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository {
    public $model;

    public function __construct(Category $category)
	{
		$this->model = $category;
    }

    public function getAllCategory()
    {
        return $this->model->all()->map(function($model) {
            return $model->category_name;
        })->toArray();
    }

    public function searchCategory($key)
    {
        return $this->model
                    ->where('category_name', 'LIKE', '%'.$key.'%')
                    ->orWhere('description', 'LIKE', '%'.$key.'%')
                    ->paginate(5)
                    ->withQueryString();
    }

    public function getListCategory($data) 
    {
        if(!empty($data)) { 
            return $this->model->where('category_name', 'LIKE', "%" . $data['search'] . "%")->paginate(5)->withQueryString();
        } 
        return $this->model->paginate(5); 
    }

    public function createCategory($data) 
    {
        return $this->model->create($data); 
    }

    public function updateCategory($data)
    {
        return $this->model->where('id', $data['id'])->update($data);
    }

    public function deleteCategory($id) 
    {
        return $this->model->where('id', $id)->delete();
    }

    public function findCategory($id) 
    {
        return $this->model->where('id', $id)->first();
    }

    public function findCategoryByName($name) 
    {
        return $this->model->where('category_name', $name)->first();
    }
}