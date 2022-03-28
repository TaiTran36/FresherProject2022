<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\PostRepositories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct(PostRepositories $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function index()
    {
        $listpost= $this->postRepository->getAll(5);
        return view('post.list', compact('listpost'))->render();
    }
    function get_list(Request $request)
    {
     if($request->ajax())
     {
        $listpost= $this->postRepository->getAll(5);
        return view('post.data', compact('listpost'))->render();
     }
    }
    public function details($url)
    {
        $getData = $this->postRepository->details($url);
        return view('post.detail')->with('post',$getData);
    }
    public function create()
    {
        return view('post.create');
    }
    public function insert(Request $request)
{
    $this->postRepository->insert($request);
	return redirect('post/list');
}
    public function edit($url)
    {
        $getData = $this->postRepository->getPost($url);
        $writer_id=$this->postRepository->getPost_writer_id($url);
        $user= new User ;
        if ($user->mySelf()->can('edit post') or ( $writer_id==Auth::user()->id))
        return view('post.edit')->with('getpostById',$getData); else echo "You don't have permission !";
    }
public function update(Request $request)
{  
    $this->postRepository->update($request);
	return redirect('post/list');
    
}
public function destroy($url)
{
    $writer_id=$this->postRepository->getPost_writer_id($url);
    $user= new User ;
    if ($user->mySelf()->can('edit post') or ( $writer_id==Auth::user()->id))
    {
	$this->postRepository->delete($url);
	return redirect('post/list');}
    else echo "You don't have permission !";
}
public function search(Request $request)
    {
        if ($request->ajax()) {
            $listpost = $this->postRepository->search($request->search);
            return view('post.data', compact('listpost'))->render();
        }
    }
    public function search_results_all(Request $request)
    {
        if ($request->ajax()) {
            $output2 = '';
            $posts = $this->postRepository->search($request->search);
            if ($posts) {
                $output2.=$posts->total();
            }
            return Response($output2);
        }
    }
    // public function sort(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data =  Post::orderBy($request->title,'desc')->get();
    //         // return $data;
    //         // return view('post.data', compact('listpost'))->render();
    //         echo $data;
    //         // echo"aaa";
    //     }
    // }


}
