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
            UsersSeeder::class
        ]);
        $this->call([
            RoleSeeder::class
        ]);
        for ($i = 1; $i <= 10; $i++) {
            $this->call([
                PostsSeeder::class
            ]); }
     }
}