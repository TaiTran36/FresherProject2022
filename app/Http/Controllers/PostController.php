<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Access\Authorizable;
class PostController extends Controller
{
    public function index()
    {
        $getData_all = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.name as writer')->get();
        $getData = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.name as writer')->paginate(5);
        return view('post.list')->with('listpost',$getData_all)->with('listpost_pagination',$getData);
    }
    public function details($id)
    {
        $getData = DB::table('posts')
        ->join('users', 'posts.writer_id', '=', 'users.id')->where('posts.id','=', $id)
        ->get();
        return view('post.detail')->with('post',$getData);
    }
    public function create()
    {
        return view('post.create');
    }
    public function insert(Request $request)
{
	date_default_timezone_set("Asia/Ho_Chi_Minh");	
    DB::table('posts')->insert([
        'title' => $request->title,
        'url'=> $request->url,
        'content'=>$request->content,  
        'writer_id'=> auth()->user()->id,
    ]);

	return redirect('post');
}
    public function edit($id)
    {
        $getData = Post::where('id',$id)->get();
        $writer_id=Post::where('id',$id)->value('writer_id');
        $user= new User ;
        if ($user->mySelf()->can('edit post') or ( $writer_id==Auth::user()->id))
        return view('post.edit')->with('getpostById',$getData); else echo "You don't have permission !";
    }
public function update(Request $request)
{
	date_default_timezone_set("Asia/Ho_Chi_Minh");	
 
	DB::table('posts')->where('id', $request->id)->update([
        'title' => $request->title,
        'url'=> $request->url,
        'content'=>$request->content
    	]);
	
	return redirect('post');
}
public function destroy($id)
{
    $writer_id=Post::where('id',$id)->value('writer_id');
    $user= new User ;
    if ($user->mySelf()->can('edit post') or ( $writer_id==Auth::user()->id))
    {
	$deleteData = DB::table('posts')->where('id', '=', $id)->delete();
	return redirect('post');}
    else echo "You don't have permission !";
}
}
