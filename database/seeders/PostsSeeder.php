<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('vi_VN');  
        DB::table('posts')->insert([
            'title' => $faker->title,
            'URL' => $faker->word,
            'content' =>$faker->word,
            'user_post'=>$faker->word,
        ]);
    }
}
