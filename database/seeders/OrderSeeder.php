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
        $user_id=DB::table('users')->insertGetId([
            'name' => 'الشفاء',
            'email' => 'shefa@gmail.com',
            'phone' => '775224512',
            'password' => Hash::make('123456'),
            'address' => 'صنعاء',
            'user_type' => 'صيدلية',
            'created_at' =>now(),
            'updated_at' => now(),
        ]);
        $user_id2=DB::table('users')->insertGetId([
            'name' => 'محمد احمد',
            'email' => 'mohmmed@gmail.com',
            'phone' => '775524512',
            'password' => Hash::make('123456'),
            'address' => 'صنعاء',
            'user_type' => 'مندوب',
            'created_at' =>now(),
            'updated_at' => now(),
        ]);
       $pharmacy_id= DB::table('pharmacies')->insertGetId([
            'name' => 'عالم الصيدلة',
            'phone' => '775552212',
            'address' => Str::random(10),
            'lat' => '15.690000000000000',
            'lng' => '44.670000000000000',
            'order_count' => 0,
            'balance' => 0,
            'user_id' => $user_id,
            'created_at' =>now(),
            'updated_at' => now(),

        ]);

        $id=DB::table('categories')->insertGetId([
            'name' => 'ادوية القلب',
            'created_at' =>now(),
            'updated_at' => now(),
        ]);

       $medicine_id= DB::table('medicines')->insertGetId([
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

       $order_id= DB::table('orders')->insertGetId([
            'status_id' => 1,
            'total_pice' => rand(10,50),
            'pharmacy_id' => $pharmacy_id,
            'user_id' => $user_id2,
            'created_at' =>now(),
            'updated_at' => now(),
        ]);

        DB::table('details')->insert([
            'medicine' => Str::random(10),
            'medicine_id' => $medicine_id,
            'price' => rand(10,50),
            'count' => rand(10,50),
            'sum' => rand(10,50),
            'order_id' => $order_id,
            'created_at' =>now(),
            'updated_at' => now(),
            

        ]);
    }
}
