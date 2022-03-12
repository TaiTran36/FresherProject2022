<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\profiles;
use Illuminate\Support\Facades\Session;
class ProfileController extends Controller
{
    public function index()
    {
        $getData_all = profiles::all();
        $getData = DB::table('profiles')->paginate(5);
        return view('profile.list')->with('listprofile',$getData_all)->with('listprofile_pagination',$getData);
    }
    public function details($id)
    {
        $getData = profiles::where('id','=', $id)->get();
        return view('profile.detail')->with('profile',$getData);
    }
    public function edit($id)
    {
    
        $getData = profiles::where('id',$id)->get();
        return view('profile.edit')->with('getprofileById',$getData);
    }
public function update(Request $request)
{	
 
	DB::table('profiles')->where('id', $request->id)->update([
		'name' => $request->name,
        'date_of_birth'=> $request->date_of_birth,
        'nickname'=> $request->nickname,
        'username'=> $request->username,
        'email'=> $request->email,
        'description'=> $request->description,
        'avatar'=> $request->avatar,
        'address'=> $request->address,
        'phone_number'=> $request->phone_number,
		'updated_at' => date('Y-m-d H:i:s')
	]);
	
	return redirect('profile');
}
public function destroy($id)
{
	$deleteData = DB::table('profiles')->where('id', '=', $id)->delete();
	
	return redirect('profile');
}
}
