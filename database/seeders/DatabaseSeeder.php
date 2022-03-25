<?php

namespace Database\Seeders;

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
        for ($i = 0; $i < 10; $i++){
            $this->call([
                UseraddSeeder::class
            ]); } 
            
        for ($i = 0; $i < 10; $i++){
            $this->call([
                PostsSeeder::class
            ]); } 
            $this->call([
                RoleSeeder::class
            ]); 
    }
}
