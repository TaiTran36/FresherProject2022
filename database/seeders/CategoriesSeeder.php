<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => "Travel",
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
        ]);
        DB::table('categories')->insert([
            'name' => "Food",
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
        ]);
        DB::table('categories')->insert([
            'name' => "Business",
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
        ]);
        DB::table('categories')->insert([
            'name' => "Technology",
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
        ]);
        DB::table('categories')->insert([
            'name' => "Education",
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
        ]);
        DB::table('categories')->insert([
            'name' => "Lifestyle",
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
        ]);
        DB::table('categories')->insert([
            'name' => "Sport",
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
        ]);
        DB::table('categories')->insert([
            'name' => "Political",
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
        ]);
        DB::table('categories')->insert([
            'name' => "Others",
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
        ]);
        for ($i = 1; $i <= 60; $i++) {
            DB::table('post_category')->insert([
                'post_id' => $i,
                'category_id' => random_int(1, 3)
            ]);
        }
        for ($i = 1; $i <= 30; $i++) {
            DB::table('post_category')->insert([
                'post_id' => $i,
                'category_id' => random_int(4, 7)
            ]);
        }
        for ($i = 1; $i <= 20; $i++) {
            DB::table('post_category')->insert([
                'post_id' => $i,
                'category_id' => random_int(8, 9)
            ]);
        }
    }
}
