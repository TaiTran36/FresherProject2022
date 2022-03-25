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
        $listprofile =  $this->userRepository->getAll(5);
        return view('profile.list', compact('listprofile'))->render();
    }
    function get_list(Request $request)
    {
     if($request->ajax())
     {
        $listprofile= $this->userRepository->getAll(5);
        return view('profile.data', compact('listprofile'))->render();
     }
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
    $get_old_avatar_file = $this->userRepository->getUser($request->id);
    if(File::exists(public_path('/profile/'.$get_old_avatar_file[0]->avatar))) {
    File::delete(public_path('/profile/'.$get_old_avatar_file[0]->avatar));
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
public function search(Request $request)
    {
        if ($request->ajax()) {
            $listprofile =  $this->userRepository->search($request->search);
            return view('profile.data', compact('listprofile'))->render();
        }
    }
    public function search_results_all(Request $request)
    {
        if ($request->ajax()) {
            $output2 = '';
            $listprofile = $this->userRepository->search($request->search);
            if ($listprofile) {
                $output2.=$listprofile->total();
            }
            return Response($output2);
        }
    }
}