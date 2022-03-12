<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    
    public function index()
    {
        $getData_all = User::all();
        $getData = DB::table('users')->paginate(5);
        return view('profile.list')->with('listprofile',$getData_all)->with('listprofile_pagination',$getData);
    }
    public function details($id)
    {
        $user= new User ;
        if ($user->mySelf()->can('all user') or ( $id==Auth::user()->id))
        {
        $getData = User::where('id','=', $id)->get();
        return view('profile.detail')->with('profile',$getData); } 
        else echo "You don't have permission !";
    }
    public function edit($id)
    {
        $user= new User ;
        if ($user->mySelf()->can('all user') or ( $id==Auth::user()->id))
        {
        $getData = User::where('id',$id)->get();
        return view('profile.edit')->with('getprofileById',$getData);}
        else echo "You don't have permission !";
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
    $user= new User ;
    if ($user->mySelf()->can('all user'))
    {
	return redirect('profile'); }
    else
    // return redirect('/profile/Auth::user()->id/details');
    return redirect('/profile/'.Auth::user()->id.'/details');

}
public function destroy($id)
{

	$deleteData = DB::table('users')->where('id', '=', $id)->delete();
	
	return redirect('profile');
}
}
