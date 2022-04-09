<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\PostRepositories;
use App\Repositories\CategoryRepositories;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class PostController extends Controller
{
    public function __construct(PostRepositories $postRepository, CategoryRepositories $CategoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->CategoryRepositories = $CategoryRepository;       
    }
    public function index()
    {
        $getData_all= $this->postRepository->getallPost();
        $getData= $this->postRepository->pagination(5);
        return view('post.list')->with('listpost',$getData_all)->with('listpost_pagination',$getData);
    }
    public function details($url)
    {
        $getData = $this->postRepository->details($url);
        $categories[] =  $this->CategoryRepositories->get_post_cate($url);
        return view('post.detail')->with('post',$getData)->with('categories',$categories);
    }
    public function detail_post($url){
        $getData = $this->postRepository->details($url);
        $categories[] =  $this->CategoryRepositories->get_post_cate($url);
        return view('post.detail_post')->with('post',$getData)->with('categories',$categories);
    }
    public function create()
    {
        $categories = $this->CategoryRepositories->getAll();
        return view('post.create')->with('categories', $categories);
    }
    
    public function insert(Request $request)
{
    if($request->file('photo')!=null){
        $image = $request->file('photo');
        $imageSaveAsName = time().rand(99,99999)."-".$image->getClientOriginalName();
        $upload_path = '../public/post/';
        $image_url = $imageSaveAsName;
        $image->move($upload_path, $imageSaveAsName);
        $request->photo=$image_url;
    }
    $id= $this->postRepository->insert($request);
    foreach($request->categories as $value){
        $this->CategoryRepositories->insert_post_cate($id,$value);
    }
	return redirect('post/list');
}
    public function edit($url)
    {
        $categories =  $this->CategoryRepositories->getAll();
        $post_categories[] =  $this->CategoryRepositories->get_post_cate($url);
        $getData = $this->postRepository->getPost($url);
        $writer_id=$this->postRepository->get_writer_id($url);
        $user= new User ;
        if ($user->mySelf()->can('edit post') or ( $writer_id==Auth::user()->id))
        return view('post.edit')->with('getpostById',$getData)->with('categories',$categories)->with('post_categories',$post_categories);
        else return redirect('post/list')->with('thongbao','Bạn không có quyền sửa');
    }
    
    public function update(Request $request)
    {
    $get_old_avatar_file = DB::table('posts')->select('photo')->where('url',$request->url)->get();
    if(File::exists(public_path($get_old_avatar_file[0]->photo))) {
    File::delete(public_path($get_old_avatar_file[0]->photo));
    }
    if($request->file('photo')!=null){
        $postImage = $request->file('photo');
        $postImageSaveAsName = time() .rand(99,99999)."-".$postImage->getClientOriginalName();
        $upload_path = '../public/post';
        $post_image_url = $postImageSaveAsName;
        $postImage->move($upload_path, $postImageSaveAsName);
        $request->photo = $post_image_url;
    }
        $this->postRepository->update($request);
        $this->CategoryRepositories->update_post_cate($request->id,$request->categories);
        return redirect('post/list');
    }
    public function destroy($url)
    {
        $writer_id=$this->postRepository->get_writer_id($url);
        $user= new User ;
        if ($user->mySelf()->can('edit post') or ( $writer_id==Auth::user()->id))
        {
        $this->postRepository->delete($url);
        return redirect('post/list')->with('thongbao','Xóa thành công ');}
        else return redirect('post/list')->with('thongbao','Bạn không có quyền xóa');
    }
}
