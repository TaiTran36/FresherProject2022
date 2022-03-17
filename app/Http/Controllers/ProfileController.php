<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepositories;


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
        if ($user->mySelf()->can('all user') or ( $id==Auth::user()->id))
        {
        $getData = $this->userRepository->getUser($id);
        return view('profile.edit')->with('getprofileById',$getData);}
        else echo "You don't have permission !";
    }
public function update(Request $request)
{
    $this->userRepository->update($request);
    $user= new User ;
    if ($user->mySelf()->can('all user'))
    {
	return redirect('profile/list'); }
    else
    // return redirect('/profile/Auth::user()->id/details');
    return redirect('/profile/'.Auth::user()->id.'/details');
}
public function destroy($id)
{
    $this->userRepository->delete($id);
	return redirect('profile/list');
}
}
