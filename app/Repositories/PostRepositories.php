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
    public function getPostAndWriter()
    {
        $getData_all = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.username_login as writer_username_login')->get();
        return $getData_all;
    }

    public function pagination( $pagination)
{
    $getData = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.username_login as writer_username_login')->paginate($pagination);
    return $getData;
}
public function details($id){
    $getData = DB::table('posts')
    ->join('users', 'posts.writer_id', '=', 'users.id')->where('posts.id','=', $id)
    ->select('posts.*', 'users.username_login as writer_username_login')
    ->get();
    return $getData;
}
public function insert(Request $request)
{
	$dt = Carbon::now('Asia/Ho_Chi_Minh');
    DB::table('posts')->insert([
        'title' => $request->title,
        'url'=> str_replace('+', '-', urlencode($request->url)),
        'content'=>$request->content,  
        'writer_id'=> auth()->user()->id,
        'created_at'=>$dt->toDateTimeString() 
    ]);
}
public function getPost($id)
{
    $post= Post::where('id',$id)->get();
    return $post;
}
public function getPost_writer_id($id)
{
    $post= Post::where('id',$id)->value('writer_id');
    return $post;
}
public function update(Request $request){
    
	$dt = Carbon::now('Asia/Ho_Chi_Minh');
 
	DB::table('posts')->where('id', $request->id)->update([
        'title' => $request->title,
        'url'=> str_replace('+', '-',urlencode(urldecode($request->url))),
        'content'=>$request->content,
        'updated_at'=>$dt->toDateTimeString() 
    	]);	
}
public function delete($id){
    DB::table('posts')->where('id', '=', $id)->delete();
}
}
