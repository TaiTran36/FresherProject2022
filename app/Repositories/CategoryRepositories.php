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
    }public function get()
    {
        $getData = Category::latest()->take(5)->get();
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
}