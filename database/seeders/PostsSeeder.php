<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'title' => $faker->sentence($nbWords=6, $variableNbWords=true),
            'url'=> 'post/',
            'content'=>$faker->sentence($nbWords=6, $variableNbWords=true),  
            'writer_id'=> random_int(1,3),
        ]);

    }
}