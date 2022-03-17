<?php
namespace App\Repositories;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
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
    public function getAllUser()
    {
        $getData_all = User::all();
        return $getData_all;
    }

    public function pagination( $pagination)
{
    $getData =DB::table('users')->paginate($pagination);
    return $getData;
}
public function getUser($id){
    $getData = User::where('id','=', $id)->get();
    return $getData;
}
public function create(RegisterRequest $request, string $profile_image_url){
    $data = $request->all();
    $user= User::create([
        'name' => $data['name'],
        'username_login' => $data['username'],
        'nickname' => $data['nickname'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'date_of_birth'=> $data['date_of_birth'],
        'description'=> $data['description'],
        'address'=> $data['address'],
        'phone_number'=> $data['phone_number'],
        'avatar' => $profile_image_url,
    ]);
    return $user;
}
public function update(Request $request)
{
	date_default_timezone_set("Asia/Ho_Chi_Minh");	
	DB::table('users')->where('id', $request->id)->update([
		'name' => $request->name,
        'date_of_birth'=> $request->date_of_birth,
        'nickname'=> $request->nickname,
        'username_login'=> $request->username,
        'email'=> $request->email,
        'description'=> $request->description,
        'avatar' => $request->avatar,
        'address'=> $request->address,
        'phone_number'=> $request->phone_number,
		'updated_at' => date('Y-m-d H:i:s')
	]);
}
public function delete($id){
    DB::table('users')->where('id', '=', $id)->delete();
}
}