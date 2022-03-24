<?php
namespace App\Repositories;
use Illuminate\Support\Facades\File;
use App\Models\Profile;

class AdminRepository {

    public $model;
    public function __construct(Profile $admin) {
        $this->model = $admin;
    }

    public function getRoleId($id) {
        return $this->model->where('id', $id)->pluck('role_id');
    }

    public function setUser($id) {
        return $this->model->with('role')->where('role_id', $id)->paginate(1);
    }

    public function setAdmin() {
        return $this->model->with('role')->paginate(1);

    }
    public function setModder() {
        return $this->model->with('role')->where('role_id', '<>', 1)->paginate(1);
    }
}