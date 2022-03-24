<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AdminRepository;

class DashboardController extends Controller
{
    //
    public $adminRepository;
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }
    public function index()
    {

        // $users = Profile::paginate(10);
        // //return $users;
        // return view('admin.dashboard', compact('users'));
        $role = $this->adminRepository->getRoleId(Auth::id());

        foreach ($role as $value) {
            $role_id = $value;
        }
        $users = $this->adminRepository->setUser($role_id);
        

        if ($role_id == 1) {
            $users = $this->adminRepository->setAdmin();
            // $list = Role::paginate(1);
        }

        if ($role_id == 2) {
            $users = $this->adminRepository->setModder();
            // $list = Role::where('id', '<>', 1)->paginate(1);
        }

        $data = [
            // 'menu' => $list,
            'data' => $users,
            'auth_id' => $role_id,
        ] ;
        return view('admin.dashboard', compact('data'));
    }
}
