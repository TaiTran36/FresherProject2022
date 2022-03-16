<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('vi_VN');  
        DB::table('admins')->insert([
            'name' => $faker->name,
            'email' => 'vinh@gmail.com',  
            'password' => '$2y$10$CzaWuzJY7ZryxtFaXUIj0uqrg10oKCaEzrgGJz9XaEt5.bp8q2XDy',
        ]);
    }
}
