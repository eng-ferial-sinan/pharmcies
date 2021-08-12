<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '774452212',
            'password' => Hash::make('123456'),
            'address' => 'صنعاء',
            'user_type' => 'مدير',
            'created_at' =>now(),
            'updated_at' => now(),
        ]);
    }
}
