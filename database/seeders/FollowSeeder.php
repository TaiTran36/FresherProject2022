<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countUser = User::count();
        
        for ($i = 0; $i < 50; $i++) {
            $ed_er = array_rand(range(1, $countUser), 2);

            Follow::create([
                'followed_id' => $ed_er[0], 
                'follower_id' => $ed_er[1],
            ]);
        }
    }
}
