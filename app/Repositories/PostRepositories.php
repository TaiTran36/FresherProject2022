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

    public function getAll( $pagination)
{
    $getData = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.username_login as writer_username_login')->paginate($pagination);
    return $getData;
}

public function details($url){
    $getData = DB::table('posts')
    ->join('users', 'posts.writer_id', '=', 'users.id')->where('posts.url','=', $url)
    ->select('posts.*', 'users.username_login as writer_username_login')
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
    DB::table('posts')->insert([
        'title' => $request->title,
        'url'=> $url,
        'content'=>$request->content,  
        'writer_id'=> auth()->user()->id,
        'created_at'=>$dt->toDateTimeString() 
    ]);
}
public function getPost($url)
{
    $post= Post::where('url',$url)->get();
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
    if($tail>0){
    $temp="";
    $check=1;
    while ($check>0){
        $tail=$tail+1;
        $temp=$url.'-'.$tail;
        $check=$this->getPost($temp)->count();
    }
    $url.='-'.$tail;}
    DB::table('posts')->where('id', $request->id)->update([
        'title' => $request->title,
        'url'=> $url,
        'content'=>$request->content,
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
}
