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
    public function getAllUser()
    {
        $getData_all = User::all();

        return $getData_all;
    }

    public function pagination( $pagination)
{
    $getData =DB::table('users')->paginate($pagination);
    if($key = request()->key){
        $getData = User::orderBy('created_at' ,'DESC')->where('name','like','%' .$key. '%')->paginate(5);
    }
    return $getData;
}
public function getUser($id){
    $getData = User::where('id','=', $id)->get();
    return $getData;
}

public function update(Request $request)
{
	$dt = Carbon::now('Asia/Ho_Chi_Minh');
	DB::table('users')->where('id', $request->id)->update([
		'name' => $request->name,
        'date_of_birth'=> $request->date_of_birth,
        'nickname'=> $request->nickname,
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