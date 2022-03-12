<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $faker = Faker::create('vi_VN');  
        DB::table('users')->insert([
            'username_login' => 'anhkatori',
            'email' => 'aaa@gmail.com',  
            'password' => '$2y$10$CzaWuzJY7ZryxtFaXUIj0uqrg10oKCaEzrgGJz9XaEt5.bp8q2XDy',
            'name' => $faker->name,
            'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '2020',$min = '1980'),
            'nickname' =>$faker->word,
            'description'=>$faker->sentence($nbWords=6, $variableNbWords=true),  
            'avatar'=>'../storage/app/public/profile_images/164709726077563-profile.jpg',
            'address'=>$faker->word,
            'phone_number'=> $faker->phoneNumber,
        ]);
        DB::table('users')->insert([
            'username_login' => 'anhkatori2',
            'email' => 'aaa1@gmail.com',  
            'password' => '$2y$10$CzaWuzJY7ZryxtFaXUIj0uqrg10oKCaEzrgGJz9XaEt5.bp8q2XDy',
            'name' => $faker->name,
            'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '2020',$min = '1980'),
            'nickname' =>$faker->word,
            'description'=>$faker->sentence($nbWords=6, $variableNbWords=true),  
            'avatar'=>'../storage/app/public/profile_images/164709726077563-profile.jpg',
            'address'=>$faker->word,
            'phone_number'=> $faker->phoneNumber,
        ]);
        DB::table('users')->insert([
            'username_login' => 'anhkatori3',
            'email' => 'aaa2@gmail.com',  
            'password' => '$2y$10$CzaWuzJY7ZryxtFaXUIj0uqrg10oKCaEzrgGJz9XaEt5.bp8q2XDy',
            'name' => $faker->name,
            'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '2020',$min = '1980'),
            'nickname' =>$faker->word,
            'description'=>$faker->sentence($nbWords=6, $variableNbWords=true),  
            'avatar'=>'../storage/app/public/profile_images/164709726077563-profile.jpg',
            'address'=>$faker->word,
            'phone_number'=> $faker->phoneNumber,
        ]);
    }
}