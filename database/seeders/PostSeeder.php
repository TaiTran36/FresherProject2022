<?php

namespace Database\Seeders;

use App\Models\User; 
use App\Models\Post; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = \Faker\Factory::create(); 

        for ($i = 0; $i < 15; $i++){ 
            Post::create([
                'author' => User::where('role', 3)->select('username_login')->inRandomOrder()->first()['username_login'],
                'title' => $fake->text($maxNbChars = 80),
                'content' => $fake->realText(),
            ]);
        }
    }
}
