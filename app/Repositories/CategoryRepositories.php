<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;

class CategoryRepositories
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Category::class;
    }
    public function getAll()
    {
        $getData = Category::all();
        return $getData;
    }

    public function get_post_index()
    {
        $getData = DB::table('posts')
        ->join('categories_posts', 'posts.id', '=', 'categories_posts.posts_id')
        ->join('categories', 'categories.id', '=', 'categories_posts.categories_id')
        ->join('users', 'posts.writer_id', '=', 'users.id')
        ->select('posts.*','categories.categories as category', 'users.name as writer_name','users.avatar as writer_avatar','users.id as writer_id')
        ->get();    
        return $getData;
    }
    public function get_cate_index()
    {
        $getData = DB::table('categories')
        ->join('categories_posts', 'categories.id', '=', 'categories_posts.categories_id')
        ->join('posts', 'posts.id', '=', 'categories_posts.posts_id')
        ->select('categories.*','posts.id as posts_id')
        ->get();    
        return $getData;
    }public function getPostFromCat($name)
    {
        $getData = DB::table('posts')
        ->join('categories_posts', 'posts.id', '=', 'categories_posts.posts_id')
        ->join('categories', 'categories.id', '=', 'categories_posts.categories_id')
        ->join('users', 'posts.writer_id', '=', 'users.id')
        ->where('categories.categories','=',$name)
        ->select('posts.*','categories.categories as category','users.name as writer_username', 'users.name as writer_name','users.avatar as writer_avatar')
        // ->take(5)
        ->orderBy('created_at', 'DESC')
        ->get();
        return $getData;
    }
    public function get_post_cate($url)
{
        $getData = DB::table('categories_posts')
        ->join('posts', 'posts.id', '=', 'categories_posts.posts_id')
        ->join('categories', 'categories.id', '=', 'categories_posts.categories_id')
        ->where('posts.url','=', $url)
        ->select('categories.categories as category')
        ->get();
        return $getData;
}
    public function insert_post_cate($post, $category)
    {
        DB::table('categories_posts')->insert([
            'posts_id' => $post,
            'categories_id'=> $category,
        ]);
    }
    public function update_post_cate($post, $categories)
    {
        DB::table('categories_posts')->where('posts_id',"=", $post)->delete();
        foreach($categories as $category){
        DB::table('categories_posts')->insert([
            'posts_id' => $post,
            'categories_id'=> $category,
        ]); }
    }
    public function update_comment($post, $categories)
    {
        foreach($categories as $category){
        DB::table('categories_posts')->insert([
            'posts_id' => $post,
            'categories_id'=> $category,
        ]); }
    }
}