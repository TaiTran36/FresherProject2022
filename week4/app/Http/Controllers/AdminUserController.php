<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class AdminUserController extends Controller
{
    //
    function delete($id)
    {
        if (Auth::id() != $id) {
            $users = Profile::find($id);
            $users->delete();

            return redirect('admin/dashboard')->with('status', 'Đã xóa thành công');
        } else {
            return redirect('admin/dashboard')->with('status', 'Không thể xóa chính mình');
        }
    }
    public function edit($id)
    {
        $user = Profile::find($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if ($request->input('btn_edit')) {
            $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'dob' => 'required|string|max:20',
                    'nickname' => 'required|string|max:255',
                    'email' => 'required|string|max:255|unique:profile',
                    'description' => 'required|string|max:255',
                    'avatar' => 'required|string|max:255',
                    'phone' => 'required|string|max:10'
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min kí tự',
                    'max' => ':attribute có độ dài ít nhất :max kí tự'
                ],
                [
                    'name' => 'Tên người dùng',
                    'dob' => 'Ngày sinh',
                    'nickname' => 'Biệt danh',
                    'descrition' => 'Giới thiệu bản thân',
                    'avatar' => 'Avatar',
                    'phone' => 'Số điện thoại'
                ]
            );
        }
        // return $request->all();
        $user = Profile::find($id);
        $user->name = $request->input('name');
        $user->dob = $request->input('dob');
        $user->nickname = $request->input('nickname');
        $user->email = $request->input('email');
        $user->description = $request->input('description');

        if ($request->hasFile('avatar')) {
            $des = 'uploads/profiles/' . $user->avatar;
            if (File::exists($des)) {
                unlink($des);
            }
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/profiles/', $filename);
            $user->avatar = $filename;
        }
        $user->phone = $request->input('phone');

        
        // dd($request->all());
        $user->update();
        return redirect('admin/dashboard')->with('status', 'Sửa thành công');
    }
    
    public function show($id)
    {
        $user = Profile::find($id);
        return view('admin.show', compact('user'));
    }
}
