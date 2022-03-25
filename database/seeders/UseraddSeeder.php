<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UseraddSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
    public function run()
    {
        $faker = Faker::create('vi_VN');  

DB::table('users')->insert([
            'name' => $faker->name,
            'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '2020',$min = '1980'),
            'nickname' =>$faker->word,
            'username'=>$faker->word,
            'email' => $faker->unique()->email,
            'description'=>$faker->sentence($nbWords=6, $variableNbWords=true),  
            'avatar' => $faker->image('public/storage/images',640,480, null, false),
            'password' => $faker->password,
            'address'=>$faker->word,
            'phone_number'=> $faker->phoneNumber,
        ]);
    }
}