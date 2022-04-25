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
}