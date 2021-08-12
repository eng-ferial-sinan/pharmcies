<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'name' => 'ادوية الكلى',
            'created_at' =>now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'الادوية المزمنة',
            'created_at' =>now(),
            'updated_at' => now(),
        ]);
    }
}
