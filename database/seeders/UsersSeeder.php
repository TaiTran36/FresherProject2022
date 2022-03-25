<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;


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
            'password' => Hash::make('12345678'),
            'name' => $faker->name,
            'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '2020',$min = '1980'),
            'nickname' =>$faker->word,
            'description'=>$faker->sentence($nbWords=6, $variableNbWords=true),  
            'avatar'=>'UK239dzgoTMShdNIh9P5ozrENBe8TaUebxOcSbeY.jpg',
            'address'=>$faker->word,
            'phone_number'=> $faker->phoneNumber,
        ]);
        DB::table('users')->insert([
            'username_login' => 'anhkatori2',
            'email' => 'aaa1@gmail.com',  
            'password' => Hash::make('12345678'),            
            'name' => $faker->name,
            'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '2020',$min = '1980'),
            'nickname' =>$faker->word,
            'description'=>$faker->sentence($nbWords=6, $variableNbWords=true),  
            'avatar'=>'UK239dzgoTMShdNIh9P5ozrENBe8TaUebxOcSbeY.jpg',
            'address'=>$faker->word,
            'phone_number'=> $faker->phoneNumber,
        ]);
        DB::table('users')->insert([
            'username_login' => 'anhkatori3',
            'email' => 'aaa2@gmail.com',  
            'password' => Hash::make('12345678'),
            'name' => $faker->name,
            'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '2020',$min = '1980'),
            'nickname' =>$faker->word,
            'description'=>$faker->sentence($nbWords=6, $variableNbWords=true),  
            'avatar'=>'UK239dzgoTMShdNIh9P5ozrENBe8TaUebxOcSbeY.jpg',
            'address'=>$faker->word,
            'phone_number'=> $faker->phoneNumber,
        ]);
        for ($i = 1; $i <= 15; $i++) {
            DB::table('users')->insert([
                'username_login' => $faker->name,
                'email' => $faker->email(),  
                'password' => Hash::make('12345678'),
                'name' => $faker->name,
                'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '2020',$min = '1980'),
                'nickname' =>$faker->word,
                'description'=>$faker->sentence($nbWords=6, $variableNbWords=true),  
                'avatar'=>'UK239dzgoTMShdNIh9P5ozrENBe8TaUebxOcSbeY.jpg',
                'address'=>$faker->word,
                'phone_number'=> $faker->phoneNumber,
            ]);
        }
    }
}