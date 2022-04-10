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
            'name' =>"Travel"
        ]);
        DB::table('categories')->insert([
            'name' =>"Food"
        ]);
        DB::table('categories')->insert([
            'name' =>"Business"
        ]);
        DB::table('categories')->insert([
            'name' =>"Technology"
        ]);
        DB::table('categories')->insert([
            'name' =>"Education"
        ]);
        DB::table('categories')->insert([
            'name' =>"Lifestyle"
        ]);
        DB::table('categories')->insert([
            'name' =>"Sport"
        ]);
        DB::table('categories')->insert([
            'name' =>"Political"
        ]);
        DB::table('categories')->insert([
            'name' =>"Others"
        ]);
        for ($i = 1; $i <= 20; $i++) {
            DB::table('post_category')->insert([
                'post_id' =>$i,
                'category_id'=>random_int(1,3)
            ]);
         }
         for ($i = 1; $i <= 20; $i++) {
            DB::table('post_category')->insert([
                'post_id' =>$i,
                'category_id'=>random_int(4,7)
            ]);
         }
         for ($i = 1; $i <= 4; $i++) {
         DB::table('post_category')->insert([
            'post_id' =>random_int(1,20),
            'category_id'=>random_int(8,9)
        ]);
     }}
    }
