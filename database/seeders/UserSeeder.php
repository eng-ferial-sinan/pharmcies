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
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => Str::random(10),
            'password' => Hash::make('password'),
            'url' => Str::random(20),
            'address' => Str::random(10),
            'user_type' => rand(10,50),
            'created_at' =>now(),
            'updated_at' => now(),
        ]);
    }
}
