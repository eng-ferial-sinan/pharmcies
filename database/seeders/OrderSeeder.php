<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('orders')->insert([
            'status_id' => rand(10,50),
            'total_pice' => rand(10,50),
            'pharmacy_id' => rand(10,50),
            'user_id' => rand(10,50),
            

        ]);
    }
}
