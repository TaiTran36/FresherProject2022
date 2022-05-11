<?php
namespace App\Repositories;

use App\Mail\OrderShipped;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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
    public function getallPost()
    {
        $getData_all = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.name as writer_name')->get();
       
        
        return $getData_all;
    }
    public function all()
    {
        $getData = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.name as writer_name','users.avatar as writer_avatar')->orderBy('created_at', 'DESC')->take(5)->get();
        return $getData;
    }

    public function pagination( $pagination){
        $getData = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.name as writer_name')->paginate($pagination);
        if($key = request()->key){
            $getData = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.name as writer_name')->orderBy('created_at' ,'DESC')->where('title','like','%' .$key. '%')->orwhere('writer_id','like','%' .$key. '%')->paginate(5);
        }
            return $getData;
    }
    public function details($url){
        $getData = DB::table('posts')
        ->join('users', 'posts.writer_id', '=', 'users.id')->where('posts.url','=', $url)
        ->select('posts.*', 'users.name as writer_name','users.avatar as writer_avatar')
        ->get();
        return $getData;
    }
    
    public function insert(Request $request)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        if($request->url!=null){
            $url= str_replace('+', '-', urlencode($request->url));
        } else $url= str_replace('+', '-', urlencode(rand(10000,99999)." ".$request->title));
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
        $id = DB::table('posts')->insertGetId([
            'title' => $request->title,
            'url'=> $url,
            'content'=>$request->content,  
            'photo'=> $request->photo,
            'writer_id'=> auth()->user()->id,
            'created_at'=>$dt->toDateTimeString() 
        ]);
        return $id ;
    }
    public function GetMail(){
        $getData = DB::table('users')
        ->join('follow', 'follow.user_subscribe', '=', 'users.id')
        ->where('follow.user_author' ,'=',auth()->user()->id)
        ->select('*')
        ->get();
        return $getData;
    }
    public function getPostByID($id)
    {
        $post= Post::where('id',$id)->get();
        return $post;
    }
    public function followers($writer_id){
        return DB::table('follow')
        ->where('user_author',$writer_id)
        ->where('sendemail','=','1')
        ->join('users', 'follow.user_subscribe', '=', 'users.id')
        ->select('users.email as email','users.name as name')
        ->get();
        }
    public function getPost($url)
    {
        $post= Post::where('url',$url)->get();
        return $post;
    }
    public function get_writer_id($url)
    {
        $post= Post::where('url',$url)->value('writer_id');
        return $post;
    }
    public function update(Request $request){
        
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        if($request->url!=null){
            $url= str_replace('+', '-',urlencode(urldecode($request->url)));
        } else $url= str_replace('+', '-', urlencode(rand(10000,99999)." ".$request->title));
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
            'photo' => $request->photo,
            'updated_at'=>$dt->toDateTimeString() 
            ]);	
}
    public function update_follow(Request $request){
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        DB::table('follow')->insert([
            'user_subscribe'=> auth()->user()->id,
            'user_author'=>$request->writer_id,
            'updated_at'=>$dt->toDateTimeString() 
            ]);	
    }
    public function destroy_follow(Request $request){
        DB::table('follow')
        ->where('follow.user_subscribe' ,'=',auth()->user()->id)
        ->where('follow.user_author','=',$request->writer_id )
        ->delete();

    }
    public function tattb(Request $request){
        DB::table('follow')
        ->where('follow.user_subscribe' ,'=',auth()->user()->id)
        ->where('follow.user_author','=',$request->writer_id )
        ->update(['follow.sendemail' => '0']);

    }
    public function battb(Request $request){
        DB::table('follow')
        ->where('follow.user_subscribe' ,'=',auth()->user()->id)
        ->where('follow.user_author','=',$request->writer_id )
        ->update(['follow.sendemail' => '1']);

    }
    public function tb($id,$id2){
        $check = DB::table('follow')
        // ->join('users', 'follow.user_subscribe', '=', 'users.id')
        ->where('follow.user_subscribe','=',$id2)
        ->where('follow.user_author','=',$id)
        ->where('follow.sendemail','=', '1')->first();
        if($check!= null)
        return true;
        else return false;
    }
    public function tb2($id,$id2){
        $check = DB::table('follow')
        ->join('posts', 'follow.user_author', '=', 'posts.writer_id')
        ->where('follow.user_subscribe','=',$id2)
        ->where('posts.id','=',$id)
        ->where('follow.sendemail','=', '1')->first();
        if($check!= null)
        return true;
        else return false;
    }
    public function hassubscribe($id,$id2){
        $check = DB::table('follow')
        // ->join('users', 'follow.user_subscribe', '=', 'users.id')
        ->where('follow.user_subscribe','=',$id2)
        ->where('follow.user_author','=',$id)->first();
        if($check!= null)
        return true;
        else return false;
    }public function hadsubscribe($id,$id2){
        $check = DB::table('follow')
        ->join('posts', 'follow.user_author', '=', 'posts.writer_id')
        ->where('posts.id','=',$id)
        ->where('follow.user_subscribe','=',$id2)
        ->first();
        if($check!= null)
        return true;
        else return false;
    }
    public function countfollow($id){
        $getData=DB::table('follow')
        ->where('follow.user_author','=',$id )
        ->select('*')
        ->get();
        return $getData;

    }
    public function delete($url){
        DB::table('posts')->where('url', '=', $url)->delete();
    }
    public function getID($url){
        return DB::table('posts')->where('url','=',$url)->value('id');
    }
    
    public function getAllPostByAuthor($id,$username)
    {
        $getData = DB::table('posts')
        ->join('users', 'posts.writer_id', '=', 'users.id')
        ->where('users.name','=',$username)
        ->where('users.id','=',$id)
        ->select('posts.*', 'users.name as writer_name','users.avatar as writer_avatar')
        ->orderBy('created_at', 'DESC')
        ->get();
        return $getData;
    }
    public function getAuthor($id,$username)
    {
        $getData = DB::table('users')
        ->where('users.name','=',$username)
        ->where('users.id','=',$id)
        ->select('*')
        ->get();
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
    public function comments($url){
        return Post::join('comments', 'posts.id', '=', 'comments.post_id')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->where('posts.url', '=', $url)
        ->select('comments.*','users.avatar as user_avatar','users.name as user_name')
        ->orderBy('created_at','DESC')
        ->get();
    }
    public function destroy_like_dislike($id){
        DB::table('likes')->where('post_id','=',$id)->where('user_id','=',auth()->user()->id)->delete();
    }
    public function addLike($id){
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        DB::table('likes')->insert([
            'post_id' => $id,
            'user_id'=> auth()->user()->id,
            'like'=> "1",
            'dislike'=>'0',
            'created_at'=>$dt->toDateTimeString()  
        ]);
    }
    public function addDislike($id){
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        DB::table('likes')->insert([
            'post_id' => $id,
            'user_id'=> auth()->user()->id,
            'like'=> "0",
            'dislike'=>'1',
            'created_at'=>$dt->toDateTimeString()  
        ]);
    }
    public function likes($id){
        return DB::table('likes')->where('post_id','=',$id)->where('like','=','1') ->count();
    }
    public function dislikes($id){
        return DB::table('likes')->where('post_id','=',$id)->where('dislike','=','1') ->count();
    }
}
