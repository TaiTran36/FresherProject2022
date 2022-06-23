<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            RoleSeeder::class
        ]);
        for ($i = 1; $i <= 30; $i++) {
            $this->call([
                PostsSeeder::class
            ]);
        }
        for ($i = 1; $i <= 35; $i++) {
            $this->call([
                CommentsSeeder::class,
                FollowSeeder::class
            ]);
        }
        for ($i = 1; $i <= 65; $i++) {
            $this->call([
                LikeSeeder::class
            ]);
        }
        $this->call([
            CategoriesSeeder::class
        ]);
    }
}
