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

            ['name' => 'list salons','guard_name'=> 'web'],
            ['name' => 'add salon','guard_name'=> 'web'],
            ['name' => 'edit salon','guard_name'=> 'web'],
            ['name' => 'delete salon','guard_name'=> 'web'],

            ['name' => 'list services','guard_name'=> 'web'],
            ['name' => 'add service','guard_name'=> 'web'],
            ['name' => 'edit service','guard_name'=> 'web'],
            ['name' => 'delete service','guard_name'=> 'web'],

            ['name' => 'list settings','guard_name'=> 'web'],
            ['name' => 'edit settings','guard_name'=> 'web'],

            ['name' => 'list reservations','guard_name'=> 'web'],
            ['name' => 'add reservation','guard_name'=> 'web'],
            ['name' => 'edit reservation','guard_name'=> 'web'],
            ['name' => 'delete reservation','guard_name'=> 'web'],

            ['name' => 'list promotions','guard_name'=> 'web'],
            ['name' => 'add promotion','guard_name'=> 'web'],
            ['name' => 'edit promotion','guard_name'=> 'web'],
            ['name' => 'delete promotion','guard_name'=> 'web'],

        ]);
    }
}
