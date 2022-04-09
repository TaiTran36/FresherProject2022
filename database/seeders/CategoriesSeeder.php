<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('categories')->insert([
            'categories' =>"Travel"

        ]);
        DB::table('categories')->insert([
            'categories' =>"Business",
        ]);
        DB::table('categories')->insert([
            'categories' =>"Science",
        ]);
        DB::table('categories')->insert([
            'categories' =>"Health",
        ]);
        DB::table('categories')->insert([
            'categories' =>"Lifestyle",
        ]);
        DB::table('categories')->insert([
        'categories' =>"Sport",
    ]);


        

    }
}