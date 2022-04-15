<?php

namespace Database\Seeders;

use App\Models\User; 
use App\Models\Post; 
use App\Models\Category; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            $content = $fake->realText(rand(250, 10000)); 
            
            $title = Str::limit($content, $limit = 50, $end = '...'); 
            
            $url = Str::replace(' ', '-', $title);
            
            $categoriesNum = array_rand([1, Category::count()], 2); 
            $categoryList = [];
            foreach($categoriesNum as $num) {
                array_push($categoryList, 
                    Category::select('category_name')->where('category_id', $num)->first()
                ); 
            }

            Post::create([
                'author' => User::where('role', 3)->select('username_login')->inRandomOrder()->first()['username_login'],
                'title' => $title,
                'url' => $url, 
                'category' => $categoryList,
                'image' => 'post-image.jpg',
                'content' => $content,
            ]);
        }
    }
}
