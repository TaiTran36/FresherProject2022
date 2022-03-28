<?php
namespace App\Repositories;

use App\Http\Requests\ProfilesEditRequest;
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

    public function getAll( $pagination)
{
    $getData = DB::table('users')
    ->leftjoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
    ->leftjoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
    ->select('users.*', 'roles.name as role')
    ->paginate($pagination);
    return $getData;
}
public function getUser($id){
    $getData = User::where('id','=', $id)->get();
    return $getData;
}
public function search($name)
{
    $getData =DB::table('users')
    ->leftjoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
    ->leftjoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
    ->select('users.*', 'roles.name as role')
-> where('users.name', 'LIKE', '%' . $name . '%')->paginate(5);
    return $getData;
}
public function getAvatar($id){
    return DB::table('users')->select('avatar')->where('id',$id)->get();
}
public function create(RegisterRequest $request, string $profile_image_url){
    $dt = Carbon::now('Asia/Ho_Chi_Minh');
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
        'created_at'=>$dt->toDateTimeString() 
    ]);
    return $user;
}
public function update(Request $request)
{
	$dt = Carbon::now('Asia/Ho_Chi_Minh');
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
        'updated_at'=>$dt->toDateTimeString() 
	]);
}
public function delete($id){
    DB::table('users')->where('id', '=', $id)->delete();
}
}