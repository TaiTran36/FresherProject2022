<?php

namespace App\Repositories; 

use App\Models\RoleUser; 

class RoleUserRepository {
    public $model;

    public function __construct(RoleUser $role)
	{
		$this->model = $role;
    }

    public function getAllRole()
    {
        return $this->model->all()->map(function($model) {
            return $model->user_type;
        })->toArray();
    }

    public function findIndexRole($type)
    {
        return $this->model->select('role_number')->where('user_type', $type)->first();
    }
}