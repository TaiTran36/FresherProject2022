<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilesEditRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepositories;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function __construct(UserRepositories $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $getData_all =  $this->userRepository->getAllUser();
        $getData = $this->userRepository->pagination(5);
        return view('profile.list')->with('listprofile',$getData_all)->with('listprofile_pagination',$getData);
    }
    public function details($id)
    {
        $user= new User ;
        if ($user->mySelf()->can('all user') or ( $id==Auth::user()->id))
        {
        $getData =$this->userRepository->getUser($id);
        return view('profile.detail')->with('profile',$getData); } 
        else echo "You don't have permission !";
    }
    public function edit($id)
    {
        $user= new User ;
        if ($user->mySelf()->can('edit user') or ( $id==Auth::user()->id))
        {
        $getData = $this->userRepository->getUser($id);
        return view('profile.edit')->with('getprofileById',$getData);}
        else echo "You don't have permission !";
    }
public function update(Request $request)
{
    $get_old_avatar_file = DB::table('users')->select('avatar')->where('id',$request->id)->get();
    if(File::exists(public_path($get_old_avatar_file[0]->avatar))) {
    File::delete(public_path($get_old_avatar_file[0]->avatar));
    }
    // $request->avatar=Auth::user()->avatar;
if($request->file('avatar')!=null){
    $profileImage = $request->file('avatar');
    $profileImageSaveAsName = time() .rand(99,99999)."-".$profileImage->getClientOriginalName();
    $upload_path = '../public/profile/';
    $profile_image_url = $profileImageSaveAsName;
    $profileImage->move($upload_path, $profileImageSaveAsName);
    $request->avatar=$profile_image_url;
}
    $this->userRepository->update($request);
    $user= new User ;
    if ($user->mySelf()->can('edit user'))
    {
	return redirect('profile/list'); }
    return redirect('/profile/'.Auth::user()->id.'/details');
}
public function destroy($id)
{
    $this->userRepository->delete($id);
	return redirect('profile/list');
}
}