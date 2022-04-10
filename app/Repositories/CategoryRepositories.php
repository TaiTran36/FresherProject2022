<?php
namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
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
public function getAllPostFromCat()
{
    $getData = DB::table('posts')
    ->join('post_category', 'posts.id', '=', 'post_category.post_id')
    ->join('categories', 'categories.id', '=', 'post_category.category_id')
    ->join('users', 'posts.writer_id', '=', 'users.id')
    ->select('posts.*','categories.name as category', 'users.name as writer_name','users.avatar as writer_avatar')
    ->get();    
    return $getData;
}
public function getAllCatFromPost()
{
    $getData = DB::table('categories')
    ->join('post_category', 'categories.id', '=', 'post_category.category_id')
    ->join('posts', 'posts.id', '=', 'post_category.post_id')
    ->select('categories.*','posts.id as post_id')
    ->get();    
    return $getData;
}
public function get_where_post($url)
{
    $getData = DB::table('post_category')
    ->join('posts', 'posts.id', '=', 'post_category.post_id')
    ->join('categories', 'categories.id', '=', 'post_category.category_id')
    ->where('posts.url','=', $url)
    ->select('categories.name as category')
    ->get();
    // $getData = DB::table('categories')->get();
    return $getData;
}
public function insert_post_cat($post, $category)
{
    DB::table('post_category')->insert([
        'post_id' => $post,
        'category_id'=> $category,
    ]);
}
public function update_post_cat($post, $categories)
{
    DB::table('post_category')->where('post_id',"=", $post)->delete();
    foreach($categories as $category){
    DB::table('post_category')->insert([
        'post_id' => $post,
        'category_id'=> $category,
    ]); }
}
}
