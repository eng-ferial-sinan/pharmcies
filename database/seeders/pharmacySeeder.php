<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class pharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('pharmacies')->insert([
            'name' => Str::random(10),
            'phone' => Str::random(10),
            'address' => Str::random(10),
            'lat' => Str::random(10),
            'lng' => Str::random(10),
            'order_count' => Int::random(10),
            'balance' => Str::random(10),
            'order_count' =>Str ::random(10),
            'user_id' => rand(10,50),

        ]);
    }
}
