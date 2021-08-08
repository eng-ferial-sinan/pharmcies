<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class detalilsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('details')->insert([
            'medicine' => Str::random(10),
            'medicine_id' => rand(10,50),
            'price' => rand(10,50),
            'count' => rand(10,50),
            'sum' => rand(10,50),
            'order_id' => rand(10,50),
            'created_at' =>now(),
            'updated_at' => now(),
            

        ]);
    }
}
