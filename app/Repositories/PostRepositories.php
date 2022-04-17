<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class PostRepositories
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Post::class;
    }
    public function all()
{
    $getData = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.username_login as writer_username_login','users.name as writer_name','users.avatar as writer_avatar')->get();
    return $getData;
}

    public function getAll( $pagination)
{
    $getData = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.username_login as writer_username_login')->paginate($pagination);
    return $getData;
}
public function getID($url){
    return DB::table('posts')->where('url','=',$url)->value('id');
}

public function details($url){
    $getData = DB::table('posts')
    ->join('users', 'posts.writer_id', '=', 'users.id')->where('posts.url','=', $url)
    ->select('posts.*', 'users.username_login as writer_username_login','users.name as writer_name','users.avatar as writer_avatar')
    ->get();
    return $getData;
}
public function insert(Request $request)
{
	$dt = Carbon::now('Asia/Ho_Chi_Minh');
    //chekc xem url có trống ko, nếu trống thì tự render ra. Nếu trùng thì tự append biến số 
    if($request->url!=null){
        $url= str_replace('+', '-', urlencode($request->url));
    } else $url= str_replace('+', '-', urlencode(rand(10000,99999)." ".$request->title." ".Carbon::parse($dt->toDateTimeString() )->format('Y-m-d h-i-s')));
    $tail=$this->getPost($url)->count();
    if($tail>0){
    $temp="";
    $check=1;
    while ($check>0){
        $tail=$tail+1;
        $temp=$url.'-'.$tail;
        $check=$this->getPost($temp)->count();
    }
    $url.='-'.$tail;}
    //

    $id = DB::table('posts')->insertGetId([
        'title' => $request->title,
        'url'=> $url,
        'content'=>$request->content,  
        'photo_path'=> $request->image,
        'writer_id'=> auth()->user()->id,
        'created_at'=>$dt->toDateTimeString()  
    ]);
    return $id;
}
public function getPost($url)
{
    $post= Post::where('url',$url)->get();
    return $post;
}

public function getPostByID($id)
{
    $post= Post::where('id',$id)->get();
    return $post;
}
public function getPost_writer_id($url)
{
    $post= Post::where('url',$url)->value('writer_id');
    return $post;
}
public function update(Request $request){
	$dt = Carbon::now('Asia/Ho_Chi_Minh');
    if($request->url!=null){
        $url= str_replace('+', '-',urlencode(urldecode($request->url)));
    } else $url= str_replace('+', '-', urlencode(rand(10000,99999)." ".$request->title." ".Carbon::parse($dt->toDateTimeString() )->format('Y-m-d h-i-s')));
    $tail=$this->getPost($url)->count();
    $old_url=DB::table('posts')->where('id', $request->id)->value('url');
    if($url!=$old_url){
    if($tail>0){
    $temp="";
    $check=1;
    while ($check>0){
        $tail=$tail+1;
        $temp=$url.'-'.$tail;
        $check=$this->getPost($temp)->count();
    }
    $url.='-'.$tail;}}
    DB::table('posts')->where('id', $request->id)->update([
        'title' => $request->title,
        'url'=> $url,
        'content'=>$request->content,
        'photo_path' => $request->image,
        'updated_at'=>$dt->toDateTimeString() 
    	]);	
}
public function search($title){
    $listpost = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.username_login as writer_username_login')->where('title', 'LIKE', '%' . $title . '%')->paginate(5);
    return $listpost;
}
public function delete($url){
    DB::table('posts')->where('url', '=', $url)->delete();
}
public function client_getAllPost()
{
    $getData = DB::table('posts')
    ->join('post_category', 'posts.id', '=', 'post_category.post_id')
    ->join('categories', 'categories.id', '=', 'post_category.category_id')
    ->join('users', 'posts.writer_id', '=', 'users.id')
    ->select('posts.*','categories.name as category','users.username_login as writer_username', 'users.name as writer_name','users.avatar as writer_avatar')
    // ->take(5)
    ->orderBy('created_at', 'DESC')
    ->get();
    return $getData;
}
public function getAllPostByAuthor($username)
{
    $getData = DB::table('posts')
    ->join('users', 'posts.writer_id', '=', 'users.id')
    ->where('users.username_login','=',$username)
    ->select('posts.*','users.username_login as writer_username', 'users.name as writer_name','users.avatar as writer_avatar')
    // ->take(5)
    ->orderBy('created_at', 'DESC')
    ->get();
    return $getData;
}
public function getAuthor($username)
{
    $getData = DB::table('users')
    ->where('users.username_login','=',$username)
    ->select('*')
    ->get();
    return $getData;
}
public function client_get5NewPost()
{
    $getData = DB::table('posts')
    ->join('post_category', 'posts.id', '=', 'post_category.post_id')
    ->join('categories', 'categories.id', '=', 'post_category.category_id')
    ->join('users', 'posts.writer_id', '=', 'users.id')
    ->select('posts.*','categories.name as category','users.username_login as writer_username', 'users.name as writer_name','users.avatar as writer_avatar')
    ->orderBy('created_at', 'DESC')
    ->groupBy('id')    
    ->paginate(5);
    return $getData;
}
public function add_comment(Request $request){
    $dt = Carbon::now('Asia/Ho_Chi_Minh');
    DB::table('comments')->insert([
        'user_id' => auth()->user()->id,
        'post_id'=> $request->post_id,
        'comment_text'=>$request->comment,
        'created_at'=>$dt->toDateTimeString()  
        ]);	
}
public function update_comment(Request $request){
    $dt = Carbon::now('Asia/Ho_Chi_Minh');
    DB::table('comments')->where('id', $request->comment_id)->update([
        'comment_text'=>$request->comment,
        'updated_at'=>$dt->toDateTimeString()  
        ]);	
}
public function delete_comment($id){
    DB::table('comments')->where('id', '=', $id)->delete();
}
public function comments($url){
    return Post::join('comments', 'posts.id', '=', 'comments.post_id')
    ->join('users', 'comments.user_id', '=', 'users.id')
    ->where('posts.url', '=', $url)
    ->select('comments.*','users.id as writer_id','users.avatar as user_avatar','users.username_login as writer_username','users.name as user_name')
    ->orderBy('created_at', 'DESC')
    ->paginate(5);
}
public function getComment($id){
    return DB::table('comments')->where('id', $id)->value('comment_text');
}


public function destroy_like_dislike($id){
    DB::table('like_dislikes')->where('post_id','=',$id)->where('user_id','=',auth()->user()->id)->delete();
}
public function addLike($id){
    $dt = Carbon::now('Asia/Ho_Chi_Minh');
    DB::table('like_dislikes')->insert([
        'post_id' => $id,
        'user_id'=> auth()->user()->id,
        'like'=> "1",
        'dislike'=>'0',
        'created_at'=>$dt->toDateTimeString()  
    ]);
}
public function addDislike($id){
    $dt = Carbon::now('Asia/Ho_Chi_Minh');
    DB::table('like_dislikes')->insert([
        'post_id' => $id,
        'user_id'=> auth()->user()->id,
        'like'=> "0",
        'dislike'=>'1',
        'created_at'=>$dt->toDateTimeString()  
    ]);
}
public function likes($id){
    return DB::table('like_dislikes')->where('post_id','=',$id)->where('like','=','1') ->count();
}
public function liked($id){
    return DB::table('like_dislikes')->where('post_id','=',$id)->where('like','=','1') ->value('user_id');
}
public function dislikes($id){
    return DB::table('like_dislikes')->where('post_id','=',$id)->where('dislike','=','1') ->count();
}
public function disliked($id){
    return DB::table('like_dislikes')->where('post_id','=',$id)->where('dislike','=','1') ->value('user_id');
}
}
