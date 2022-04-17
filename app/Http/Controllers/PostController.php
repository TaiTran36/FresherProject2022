<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\PostRepositories;
use App\Repositories\CategoryRepositories;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct(PostRepositories $postRepository, CategoryRepositories $categoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
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
        $categories[] =  $this->categoryRepository->get_where_post($url);
        return view('post.detail')->with('post',$getData)->with('categories',$categories);
    }
    public function create()
    {
        $categories =  $this->categoryRepository->getAll();
        return view('post.create')->with('categories', $categories);
    }
    public function insert(Request $request)
{
    if($request->file('image')!=null){
        $image = $request->file('image');
        $imageSaveAsName = time().rand(99,99999)."-".$image->getClientOriginalName();
        $upload_path = '../public/post/';
        $image_url = $imageSaveAsName;
        $image->move($upload_path, $imageSaveAsName);
        $request->image=$image_url;
    }
    $id= $this->postRepository->insert($request);
    foreach($request->categories as $value){
        $this->categoryRepository->insert_post_cat($id,$value);
    }
	return redirect('post/list');
}
    public function edit($url)
    {
        $categories =  $this->categoryRepository->getAll();
        $post_categories[] =  $this->categoryRepository->get_where_post($url);
        $getData = $this->postRepository->getPost($url);
        $writer_id=$this->postRepository->getPost_writer_id($url);
        $user= new User ;
        if ($user->mySelf()->can('edit post') or ( $writer_id==Auth::user()->id))
        return view('post.edit')->with('getpostById',$getData)->with('categories',$categories)->with('post_categories',$post_categories); else echo "You don't have permission !";
    }
public function update(Request $request)
{  
    $get_old= $this->postRepository->getPostById($request->id);

    if($request->file('image')!=null){
        if(File::exists(public_path('/post/'.$get_old[0]->photo_path))) {
            File::delete(public_path('/post/'.$get_old[0]->photo_path));
            }
        $image = $request->file('image');
        $imageSaveAsName = time() .rand(99,99999)."-".$image->getClientOriginalName();
        $upload_path = '../public/post/';
        $image_url = $imageSaveAsName;
        $image->move($upload_path, $imageSaveAsName);
        $request->image=$image_url;
    }
    if($request->file('image')==null){
        $request->image=$request->image_old;
    }
    $this->postRepository->update($request);
    $this->categoryRepository->update_post_cat($request->id,$request->categories);
	return redirect('post/list');
    
}
public function destroy(Request $request)
{
    if ($request->ajax()) {
	$this->postRepository->delete($request->url);
    $listpost= $this->postRepository->getAll(5);
    $data= view('post.data', compact('listpost'))->render();
	return response($data);
}
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
    //         $data =  Post::orderBy('title','desc')->get();
    //         // $data= $this->postRepository->getAll(3);
    //         // return Response($data);
    //         echo $data;
    //                     // return response()->json($data);
    //         // return view('post.data', compact('data'))->render();
    //     }
    // }
}
