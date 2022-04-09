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
    public function getallPost()
    {
        $getData_all = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.name as writer_name')->get();
       
        
        return $getData_all;
    }
    public function all()
    {
        $getData = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.name as writer_name','users.avatar as writer_avatar')->take(5)->get();
        return $getData;
    }

    public function pagination( $pagination){
        $getData = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.name as writer_name')->paginate($pagination);
        if($key = request()->key){
            $getData = Post::orderBy('created_at' ,'DESC')->where('title','like','%' .$key. '%')->paginate(5);
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
    public function delete($url){
        DB::table('posts')->where('url', '=', $url)->delete();
    }
}
