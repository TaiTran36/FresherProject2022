<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
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
    public function getAll_paginate($i)
    {
        $getData = DB::table('categories')->paginate($i);
        return $getData;
    }
    public function getByName($name)
    {
        $getData = DB::table('categories')
            ->where('name', '=', $name)
            ->get();
        return $getData;
    }
    public function getAllPostFromCat($name)
    {
        $getData = DB::table('posts')
            ->join('post_category', 'posts.id', '=', 'post_category.post_id')
            ->join('categories', 'categories.id', '=', 'post_category.category_id')
            ->join('users', 'posts.writer_id', '=', 'users.id')
            ->where('categories.name', '=', $name)
            ->select('posts.*', 'categories.name as category', 'users.username_login as writer_username', 'users.name as writer_name', 'users.avatar as writer_avatar')
            // ->take(5)
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
        return $getData;
    }
    public function getAllCatFromPost()
    {
        $getData = DB::table('categories')
            ->join('post_category', 'categories.id', '=', 'post_category.category_id')
            ->join('posts', 'posts.id', '=', 'post_category.post_id')
            ->select('categories.*', 'posts.id as post_id')
            ->get();
        return $getData;
    }
    public function getActiveCats()
    {
        $getData = DB::table('post_category')
            ->select('category_id')->get();
        return $getData;
    }
    public function get_where_post($url)
    {
        $getData = DB::table('post_category')
            ->join('posts', 'posts.id', '=', 'post_category.post_id')
            ->join('categories', 'categories.id', '=', 'post_category.category_id')
            ->where('posts.url', '=', $url)
            ->select('categories.name as category')
            ->get();
        // $getData = DB::table('categories')->get();
        return $getData;
    }
    public function insert($name)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        DB::table('categories')->insert([
            'name' => $name,
            'created_at' => $dt->toDateTimeString()
        ]);
    }
    public function update($id, $name)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        DB::table('categories')->where('id', "=", $id)->update([
            'name' => $name,
            'updated_at' => $dt->toDateTimeString()
        ]);
    }
    public function insert_post_cat($post, $category)
    {
        DB::table('post_category')->insert([
            'post_id' => $post,
            'category_id' => $category,
        ]);
    }
    public function update_post_cat($post, $categories)
    {
        DB::table('post_category')->where('post_id', "=", $post)->delete();
        foreach ($categories as $category) {
            DB::table('post_category')->insert([
                'post_id' => $post,
                'category_id' => $category,
            ]);
        }
    }
    public function search($name)
    {
        $listcat = DB::table('categories')->where('name', 'LIKE', '%' . $name . '%')->paginate(5);
        return $listcat;
    }
    public function delete($id)
    {
        DB::table('categories')->where('id', $id)->delete();
    }
    public function check($name)
    {
        if (DB::table('categories')->where('name', $name)->exists()) {
            return false;
        } else return true;
    }
}
