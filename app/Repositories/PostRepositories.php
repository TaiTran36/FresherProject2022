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
        $getData = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.username_login as writer_username_login', 'users.name as writer_name', 'users.avatar as writer_avatar')->get();
        return $getData;
    }

    public function getAll($pagination)
    {
        $getData = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.username_login as writer_username_login')->orderBy('created_at', 'desc')->paginate($pagination);
        return $getData;
    }
    public function getID($url)
    {
        return DB::table('posts')->where('url', '=', $url)->value('id');
    }

    public function details($url)
    {
        $getData = DB::table('posts')
            ->join('users', 'posts.writer_id', '=', 'users.id')->where('posts.url', '=', $url)
            ->select('posts.*', 'users.username_login as writer_username_login', 'users.name as writer_name', 'users.avatar as writer_avatar')
            ->get();
        return $getData;
    }
    public function insert(Request $request)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        //chekc xem url có trống ko, nếu trống thì tự render ra. Nếu trùng thì tự append biến số 
        if ($request->url != null) {
            $url = str_replace('+', '-', urlencode($this->convert_name($request->url)));
        } else $url = str_replace('+', '-', urlencode(rand(10000, 99999) . " " . $this->convert_name($request->title) . " " . Carbon::parse($dt->toDateTimeString())->format('Y-m-d h-i-s')));
        $tail = $this->getPost($url)->count();
        if ($tail > 0) {
            $temp = "";
            $check = 1;
            while ($check > 0) {
                $tail = $tail + 1;
                $temp = $url . '-' . $tail;
                $check = $this->getPost($temp)->count();
            }
            $url .= '-' . $tail;
        }
        //

        $id = DB::table('posts')->insertGetId([
            'title' => $request->title,
            'url' => $url,
            'content' => $request->content,
            'photo_path' => $request->image,
            'writer_id' => auth()->user()->id,
            'created_at' => $dt->toDateTimeString()
        ]);
        return $id;
    }
    public function getPost($url)
    {
        $post = Post::where('url', $url)->get();
        return $post;
    }

    public function getPostByID($id)
    {
        $post = Post::where('id', $id)->get();
        return $post;
    }
    public function getPost_writer_id($url)
    {
        $post = Post::where('url', $url)->value('writer_id');
        return $post;
    }
    public function update(Request $request)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->url != null) {
            $url = str_replace('+', '-', urlencode(urldecode($this->convert_name($request->url))));
        } else $url = str_replace('+', '-', urlencode(rand(10000, 99999) . " " . $this->convert_name($request->title) . " " . Carbon::parse($dt->toDateTimeString())->format('Y-m-d h-i-s')));
        $tail = $this->getPost($url)->count();
        $old_url = DB::table('posts')->where('id', $request->id)->value('url');
        if ($url != $old_url) {
            if ($tail > 0) {
                $temp = "";
                $check = 1;
                while ($check > 0) {
                    $tail = $tail + 1;
                    $temp = $url . '-' . $tail;
                    $check = $this->getPost($temp)->count();
                }
                $url .= '-' . $tail;
            }
        }
        DB::table('posts')->where('id', $request->id)->update([
            'title' => $request->title,
            'url' => $url,
            'content' => $request->content,
            'photo_path' => $request->image,
            'updated_at' => $dt->toDateTimeString()
        ]);
    }
    public function search($title,$number)
    {
        $listpost = Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.*', 'users.username_login as writer_username_login')->where('title', 'LIKE', '%' . $title . '%')->paginate($number);
        return $listpost;
    }
    public function client_search($title)
    {
        $listpost = Post::join('users', 'posts.writer_id', '=', 'users.id')
            ->join('post_category', 'posts.id', '=', 'post_category.post_id')
            ->join('categories', 'categories.id', '=', 'post_category.category_id')
            ->select('posts.*', 'categories.name as category_name', 'users.username_login as writer_username', 'users.name as writer_name', 'users.avatar as writer_avatar')
            ->where('title', 'LIKE', '%' . $title . '%')
            ->paginate(5);
        return $listpost;
    }
    public function delete($url)
    {
        DB::table('posts')->where('url', $url)->delete();
    }
    public function client_getAllPost()
    {
        $getData = DB::table('posts')
            ->join('post_category', 'posts.id', '=', 'post_category.post_id')
            ->join('categories', 'categories.id', '=', 'post_category.category_id')
            ->join('users', 'posts.writer_id', '=', 'users.id')
            ->select('posts.*', 'categories.name as category', 'users.username_login as writer_username', 'users.name as writer_name', 'users.avatar as writer_avatar')
            // ->take(5)
            ->orderBy('created_at', 'DESC')
            ->get();
        return $getData;
    }
    public function getAllPostByAuthor($username)
    {
        $getData = DB::table('posts')
            ->join('users', 'posts.writer_id', '=', 'users.id')
            ->where('users.username_login', '=', $username)
            ->select('posts.*', 'users.username_login as writer_username', 'users.name as writer_name', 'users.avatar as writer_avatar')
            // ->take(5)
            ->orderBy('created_at', 'DESC')->paginate(5);
        // ->get();
        return $getData;
    }
    public function getAuthor($username)
    {
        $getData = DB::table('users')
            ->where('users.username_login', '=', $username)
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
            ->select('posts.*', 'categories.name as category', 'users.username_login as writer_username', 'users.name as writer_name', 'users.avatar as writer_avatar')
            ->orderBy('created_at', 'DESC')
            ->groupBy('id')
            ->paginate(5);
        return $getData;
    }
    public function add_comment(Request $request)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        DB::table('comments')->insert([
            'user_id' => auth()->user()->id,
            'post_id' => $request->post_id,
            'comment_text' => $request->comment,
            'created_at' => $dt->toDateTimeString()
        ]);
    }
    public function update_comment(Request $request)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        DB::table('comments')->where('id', $request->comment_id)->update([
            'comment_text' => $request->comment,
            'updated_at' => $dt->toDateTimeString()
        ]);
    }
    public function delete_comment($id)
    {
        DB::table('comments')->where('id', '=', $id)->delete();
    }
    public function comments($url)
    {
        return Post::join('comments', 'posts.id', '=', 'comments.post_id')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('posts.url', '=', $url)
            ->select('comments.*', 'users.id as writer_id', 'users.avatar as user_avatar', 'users.username_login as writer_username', 'users.name as user_name')
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
    }
    public function getComment($id)
    {
        return DB::table('comments')->where('id', $id)->value('comment_text');
    }


    public function destroy_like_dislike($id)
    {
        DB::table('like_dislikes')->where('post_id', '=', $id)->where('user_id', '=', auth()->user()->id)->delete();
    }
    public function addLike($id)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        DB::table('like_dislikes')->insert([
            'post_id' => $id,
            'user_id' => auth()->user()->id,
            'like' => "1",
            'dislike' => '0',
            'created_at' => $dt->toDateTimeString()
        ]);
    }

    public function addDislike($id)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        DB::table('like_dislikes')->insert([
            'post_id' => $id,
            'user_id' => auth()->user()->id,
            'like' => "0",
            'dislike' => '1',
            'created_at' => $dt->toDateTimeString()
        ]);
    }
    public function likes($id)
    {
        return DB::table('like_dislikes')->where('post_id', '=', $id)->where('like', '=', '1')->count();
    }
    public function liked($id, $user_id)
    {
        return DB::table('like_dislikes')->where('post_id', '=', $id)->where('like', '=', '1')->where('user_id', '=', $user_id)->count();
    }
    public function dislikes($id)
    {
        return DB::table('like_dislikes')->where('post_id', '=', $id)->where('dislike', '=', '1')->count();
    }
    public function disliked($id, $user_id)
    {
        return DB::table('like_dislikes')->where('post_id', '=', $id)->where('dislike', '=', '1')->where('user_id', '=', $user_id)->count();
    }
    function convert_name($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
        $str = preg_replace("/( )/", '-', $str);
        return $str;
    }
}
