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
        $id=DB::table('users')->insertGetId([
            'name' => 'عالم الصيدلة',
            'email' => 'alme@gmail.com',
            'phone' => '775552212',
            'password' => Hash::make('123456'),
            'address' => 'صنعاء',
            'user_type' => 'صيدلية',
            'created_at' =>now(),
            'updated_at' => now(),
        ]);
        DB::table('pharmacies')->insert([
            'name' => 'عالم الصيدلة',
            'phone' => '775552212',
            'address' => Str::random(10),
            'lat' => '15.690000000000000',
            'lng' => '44.670000000000000',
            'order_count' => 0,
            'balance' => 0,
            'user_id' => $id,
            'created_at' =>now(),
            'updated_at' => now(),

        ]);
    }
}
