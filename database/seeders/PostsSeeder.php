<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        $paths = array('164938681015929-cccccc.jpg', '164939046247132-aaa.png', '165087082854001-kisscc0-post-it-note-paper-musical-note-computer-icons-dow-nota-con-sombra-5b71327680f4c5.4056717315341451425282.png', '16506226235790-blank-post-it-note-1.png', '164943979149846-277103038_3183415008649907_2556738848469365750_n.jpg');
        DB::table('posts')->insert([
            'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'url' =>  str_replace('+', '-', urlencode($faker->sentence($nbWords = 3, $variableNbWords = true))),
            'content' => $faker->paragraphs($nb = 10, $asText = true),
            'writer_id' => random_int(1, 3),
            'photo_path' => $paths[array_rand($paths)],
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
        ]);
        DB::table('posts')->insert([
            'title' => "abcdef",
            'url' =>  str_replace('+', '-', urlencode($faker->sentence($nbWords = 3, $variableNbWords = true))),
            'content' => $faker->paragraphs($nb = 8, $asText = true),
            'writer_id' => random_int(1, 3),
            'photo_path' => $paths[array_rand($paths)],
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
        ]);
    }
}
