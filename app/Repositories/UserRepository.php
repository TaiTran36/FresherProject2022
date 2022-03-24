<?php
namespace App\Repositories;
use Illuminate\Support\Facades\File;
use App\Models\Profile;

class UserRepository {

    public $model;
    public function __construct(Profile $user) {
        $this->model = $user;
    }
    public function find($id) {
        return $this->model->find($id);
    }
    public function updateUser($dataUpdate, $id)
    {
        return $this->model->where('id', $id)->update($dataUpdate); 
    }

    public function delete($id) {
        return $this->model->where('id', $id)->delete($id);
    }

    public function searchUser($search)
    {
        return $this->model->where('name', 'like', "%$search%")->paginate(1);
    }

    function getRoleId($id) {
        return $this->model->where('id', $id)->pluck('role_id');
    }
}