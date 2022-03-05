<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasPermissions;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insertOrIgnore([
            ['name' => 'add user','guard_name'=> 'web'],
            ['name' => 'edit user','guard_name'=> 'web'],
            ['name' => 'delete user','guard_name'=> 'web'],
            ['name' => 'list users','guard_name'=> 'web'],
            
            ['name' => 'add role','guard_name'=> 'web'],
            ['name' => 'edit role','guard_name'=> 'web'],
            ['name' => 'delete role','guard_name'=> 'web'],
            ['name' => 'list roles','guard_name'=> 'web'],

            ['name' => 'list report','guard_name'=> 'web'],

            ['name' => 'list plans','guard_name'=> 'web'],
            ['name' => 'add plan','guard_name'=> 'web'],
            ['name' => 'edit plan','guard_name'=> 'web'],
            ['name' => 'delete plan','guard_name'=> 'web'],

            ['name' => 'list settings','guard_name'=> 'web'],
            ['name' => 'edit settings','guard_name'=> 'web'],

            ['name' => 'list subscriptions','guard_name'=> 'web'],
            ['name' => 'add subscription','guard_name'=> 'web'],
            ['name' => 'edit subscription','guard_name'=> 'web'],
            ['name' => 'delete subscription','guard_name'=> 'web'],


        ]);
    }
}
