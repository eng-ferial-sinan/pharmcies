<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class user_permitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_permissions')->insert([
            'user_id' =>rand(10,50),
            'permission_id' =>rand(10,50),
            'created_at' =>now(),
            'updated_at' => now(),
        ]);
    }
}
