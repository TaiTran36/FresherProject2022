<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepositories;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class ProfileController extends Controller
{
    public function __construct(UserRepositories $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new UsersImport, request()->file('file'));

        return $this->index();
    }
    public function index()
    {
        $listprofile =  $this->userRepository->getAll(5);
        $data = view('profile.list', compact('listprofile'))->render();
        return response($data);
    }
    function count_online()
    {
        $count = 0;
        $users = $this->userRepository->getAll(5);
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id)) {
                $count++;
            }
        }
        return $count;
    }
    function count(Request $request)
    {
        if ($request->ajax()) {
            $listprofile = $this->userRepository->getAll(5);
            return response($listprofile->total());
        }
    }
    function get_list(Request $request)
    {
        $number = 5;
        if ($request->number) {
            $number = $request->number;
        }
        if ($request->ajax()) {
            $listprofile = $this->userRepository->getAll($number);
            return view('profile.data', compact('listprofile'))->render();
        }
    }
    public function details($id)
    {
        $user = new User;
        if ($user->mySelf()->can('all user') or ($id == Auth::user()->id)) {
            $getData = $this->userRepository->getUser($id);
            return view('profile.detail')->with('profile', $getData);
        } else echo "You don't have permission !";
    }
    public function edit($id)
    {
        $user = new User;
        if ($user->mySelf()->can('edit user') or ($id == Auth::user()->id)) {
            $getData = $this->userRepository->getUser($id);
            return view('profile.edit')->with('getprofileById', $getData);
        } else echo "You don't have permission !";
    }
    public function update(Request $request)
    {
        $get_old_avatar_file = $this->userRepository->getUser($request->id);
        // $request->avatar=Auth::user()->avatar;
        if ($request->file('avatar') != null) {
            if (File::exists(public_path('/profile/' . $get_old_avatar_file[0]->avatar))) {
                File::delete(public_path('/profile/' . $get_old_avatar_file[0]->avatar));
            }
            $profileImage = $request->file('avatar');
            $profileImageSaveAsName = time() . rand(99, 99999) . "-" . $profileImage->getClientOriginalName();
            $upload_path = '../public/profile/';
            $profile_image_url = $profileImageSaveAsName;
            $profileImage->move($upload_path, $profileImageSaveAsName);
            $request->avatar = $profile_image_url;
        }
        if ($request->file('avatar') == null) {
            $request->avatar = $request->avatar_old;
        }
        $this->userRepository->update($request);
        $user = new User;
        if ($user->mySelf()->can('edit user')) {
            return redirect('profile/list');
        }
        return redirect('/profile/' . Auth::user()->id . '/details');
    }
    public function destroy(Request $request)
    {
        $number = 5;
        if ($request->number) {
            $number = $request->number;
        }
        if ($request->ajax()) {
            $this->userRepository->delete($request->id);
            $list = $this->userRepository->getAll($number);
            $data = view('profile.data', compact('list'))->render();
            return response($data);
        }
    }
    public function search(Request $request)
    {
        $number = 5;
        if ($request->number) {
            $number = $request->number;
        }
        if ($request->ajax()) {
            $listprofile =  $this->userRepository->search($request->search, $number);
            return view('profile.data', compact('listprofile'))->render();
        }
    }
    public function search_results_all(Request $request)
    {
        $number = 5;
        if ($request->number) {
            $number = $request->number;
        }
        if ($request->ajax()) {
            $output2 = '';
            $listprofile = $this->userRepository->search($request->search, $number);
            if ($listprofile) {
                $output2 .= $listprofile->total();
            }
            return Response($output2);
        }
    }
    function follow(Request $request)
    {
        $user_id = Auth::user()->id;
        $writer_id = $request->writer_id;
        if ($request->ajax()) {
            $this->userRepository->follow($writer_id, $user_id);
            $followers = $this->userRepository->followers($writer_id);
        }
        return response(count($followers));
    }
    function unfollow(Request $request)
    {
        $user_id = Auth::user()->id;
        $writer_id = $request->writer_id;
        if ($request->ajax()) {
            $this->userRepository->unfollow($writer_id, $user_id);
            $followers = $this->userRepository->followers($writer_id);
        }
        return response(count($followers));
    }
}
