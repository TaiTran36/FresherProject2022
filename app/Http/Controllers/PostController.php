<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\PostRepositories;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(PostRepositories $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function index()
    {
        $getData_all= $this->postRepository->getPostAndWriter();
        $getData= $this->postRepository->pagination(5);
        return view('post.list')->with('listpost',$getData_all)->with('listpost_pagination',$getData);
    }
    public function details($id)
    {
        $getData = $this->postRepository->details($id);
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
    public function edit($id)
    {
        $getData = $this->postRepository->getPost($id);
        $writer_id=$this->postRepository->getPost_writer_id($id);
        $user= new User ;
        if ($user->mySelf()->can('edit post') or ( $writer_id==Auth::user()->id))
        return view('post.edit')->with('getpostById',$getData); 
        else return redirect('post/list')->with('thongbao','Bạn không có quyền sửa');
    }
public function update(Request $request)
{
    $this->postRepository->update($request);
	return redirect('post/list');
}
public function destroy($id)
{
    $writer_id=$this->postRepository->getPost_writer_id($id);
    $user= new User ;
    if ($user->mySelf()->can('edit post') or ( $writer_id==Auth::user()->id))
    {
	$this->postRepository->delete($id);
	return redirect('post/list')->with('thongbao','Xóa thành công ');}
    else return redirect('post/list')->with('thongbao','Bạn không có quyền xóa');
    }
}
