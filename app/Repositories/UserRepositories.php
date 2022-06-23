<?php

namespace App\Repositories;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserRepositories
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getAll($pagination)
    {
        $getData = DB::table('users')
            ->leftjoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftjoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.name as role')
            // ->sortable()
            ->paginate($pagination);
        return $getData;
    }
    public function getUser($id)
    {
        $getData = User::where('users.id', '=', $id)
            ->leftjoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->select('users.*', 'model_has_roles.role_id as role')
            ->get();
        return $getData;
    }
    public function getBirthday()
    {
        $getData = User::whereMonth('date_of_birth', date('m'))
            ->whereDay('date_of_birth', date('d'))
            ->get();
        return $getData;
    }
    public function search($name,$number)
    {
        $getData = DB::table('users')
            ->leftjoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftjoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.name as role')
            ->where('users.name', 'LIKE', '%' . $name . '%')->paginate($number);
        return $getData;
    }
    public function getAvatar($id)
    {
        return DB::table('users')->select('avatar')->where('id', $id)->get();
    }
    public function create(RegisterRequest $request, string $profile_image_url)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $data = $request->all();
        $user = User::create([
            'name' => $data['name'],
            'username_login' => $data['username'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'date_of_birth' => $data['date_of_birth'],
            'description' => $data['description'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'avatar' => $profile_image_url,
            'created_at' => $dt->toDateTimeString()
        ]);
        $user->assignRole('user');
        return $user;
    }
    public function update(Request $request)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'nickname' => $request->nickname,
            'username_login' => $request->username,
            'email' => $request->email,
            'description' => $request->description,
            'avatar' => $request->avatar,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'updated_at' => $dt->toDateTimeString()
        ]);
        DB::table('model_has_roles')->where('model_id', $request->id)->update([
            'role_id' => $request->role
        ]);
    }
    public function delete($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();
    }
    public function follow($writer_id, $user_id)
    {
        DB::table('follows')->insertGetId([  // không hiểu sao insertGetId thì chạy mà Create thì lại khum chạy
            'user_id' => $user_id,
            'writer_id' => $writer_id,
        ]);
    }
    public function unfollow($writer_id, $user_id)
    {
        DB::table('follows')
            ->where("writer_id", $writer_id)
            ->where("user_id", $user_id)->delete();
    }
    public function followers($writer_id)
    {
        return DB::table('follows')
            ->where('writer_id', $writer_id)
            ->join('users', 'follows.user_id', '=', 'users.id')
            ->select('users.email as email', 'users.name as name','users.id as id')
            ->get();
    }
    public function checkFollowed($writer_username_login, $user)
    {
        $check = DB::table('follows')
            ->join('users', 'follows.writer_id', '=', 'users.id')
            ->where("users.username_login", $writer_username_login)
            ->where("follows.user_id", $user)->first();
        if ($check != null)
            return true;
        else return false;
    }
    public function getFollowerByUsername($writer_username_login)
    {
        return DB::table('follows')
            ->join('users', 'follows.writer_id', '=', 'users.id')
            ->where("users.username_login", $writer_username_login)
            ->get();
    }
}
