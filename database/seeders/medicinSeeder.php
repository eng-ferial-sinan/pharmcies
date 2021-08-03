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
        DB::table('medicines')->insert([
            'name' => Str::random(10),
            'category_id' => rand(10,50),
            'traite' => Str::random(10),
            'demerites' => Str::random(10),
            'relics' => Str::random(10),
            'price' => rand(10,50),
            'production_date' => Str::random(10),
            'expiry_date' => Str::random(10),
            'created_at' =>now(),
            'updated_at' => now(),
            

        ]);
    }
}
