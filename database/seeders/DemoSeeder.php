<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::factory()->count(5)->create();
        User::factory()->count(30)->create();
       
        $categories=Category::all();
        foreach($categories as $category)
        {
        Product::factory()->count(5)->create([
          'category_id'=> $category->id
        ]);
        }

    }
}
