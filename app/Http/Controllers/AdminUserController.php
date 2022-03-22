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
    public function __construct(UserRepository $userRepository) {
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
            //return dd($old_image);
            // $des = 'uploads/profiles/' . $old_image->avatar;
            // if ($data['avatar'] != '') {
            //     if($data['avatar'] == 'uploads/photo_default.png') {
            //         File::copy(public_path('uploads/photo_default.png'), public_path('uploads/profiles/photo_default_copy.png'));
            //     }
            //     unlink($des);
            // } 
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
        $user = $this->userRepository->getAll($id);
        return view('admin.show', compact('user'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $searchName = $this->userRepository->searchUser($search);
        return view('admin.search', compact('searchName'));
    }
}
