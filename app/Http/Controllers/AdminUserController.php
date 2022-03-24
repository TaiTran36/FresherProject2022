<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Repositories\UserRepository;
use App\Http\Requests\UserRequest;

class AdminUserController extends Controller
{


    public $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    //delete user   
    function delete($id)
    {
        if (Auth::id() != $id) {
            $this->userRepository->delete($id);

            return redirect('admin/dashboard')->with('status', 'Đã xóa thành công');
        } else {
            return redirect('admin/dashboard')->with('status', 'Không thể xóa chính mình');
        }
    }

    //edit user 

    public function edit($id)
    {
        if ($id != Auth::user()->id) {
            $message = "Bạn không có quyền truy cập vào trang này";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='../dashboard';</script>";
        }
        $user = $this->userRepository->find($id);
        return view('admin.edit', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {

        // return $request->all();
        $data['name'] = $request->input('name');
        $data['dob'] = $request->input('dob');
        $data['nickname'] = $request->input('nickname');
        $data['email'] = $request->input('email');
        $data['description'] = $request->input('description');

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar');
            $old_image = $this->userRepository->find($id);
            // return dd($old_image);
            $des = 'uploads/profiles/' . $old_image->avatar;
            if (File::exists($des)) {
                File::delete($des);
            }
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/profiles/', $filename);
            $data['avatar'] = $filename;
        }

        $data['phone'] = $request->input('phone');
        $data['address'] = $request->input('address');

        $this->userRepository->updateUser($data, $id);

        return redirect('admin/dashboard')->with('status', 'Sửa thành công');
    }

    //show list user 

    public function show($id)
    {
        $user = $this->userRepository->find($id);
        return view('admin.show', compact('user'));
    }

    public function search(Request $request)
    {
        $role = $this->userRepository->getRoleId(Auth::id());

        foreach ($role as $value) {
            $role_id = $value;
        }
        
        if ($role_id == 1 || $role_id == 2) {
            $search = $request->input('search');
            $searchName = $this->userRepository->searchUser($search);
            $searchName->append($request->all());
            return view('admin.search', compact('searchName'));
        } else {
            return view('admin.dashboard');
        }
    }
}
