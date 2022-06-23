<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;


class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('vi_VN');
        DB::table('comments')->insert([
            'comment_text' => $faker->sentence($nb = 10, $asText = true),
            'post_id' => random_int(1, 10),
            'user_id' => random_int(11, 18),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
        ]);
        DB::table('comments')->insert([
            'comment_text' => $faker->sentence($nb = 10, $asText = true),
            'post_id' => random_int(2, 18),
            'user_id' => random_int(2, 10),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
        ]);
    }
}
