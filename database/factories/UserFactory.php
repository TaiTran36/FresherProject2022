<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;
    public function definition()
    {
        $paths = array('164938474623407-cccccc.jpg', '164996109240887-blank-post-it-note-1.png', '164822553533163-Untitled.png');
        $faker = Faker::create('vi_VN');
        return [
            'username_login' => $faker->unique()->name,
            'email' => $faker->unique()->email(),
            'password' => Hash::make('12345678'),
            'name' => "abcdef",
            'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '2020', $min = '1980'),
            'nickname' => $faker->word,
            'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'avatar' => $paths[array_rand($paths)],
            'address' => $faker->word,
            'phone_number' => $faker->phoneNumber,
        ];
    }
}
