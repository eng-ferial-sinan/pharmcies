<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class medicinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       $id=DB::table('categories')->insertGetId([
            'name' => 'ادوية القلب',
            'created_at' =>now(),
            'updated_at' => now(),
        ]);

        DB::table('medicines')->insert([
            'name' => Str::random(10),
            'category_id' => $id,
            'traite' => Str::random(10),
            'demerites' => Str::random(10),
            'relics' => Str::random(10),
            'price' => rand(10,50),
            'production_date' =>now(),
            'expiry_date' => now(),
            'created_at' =>now(),
            'updated_at' => now(),
        ]);
    }
}
