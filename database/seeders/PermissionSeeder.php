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

            ['name' => 'list settings','guard_name'=> 'web'],
            ['name' => 'edit settings','guard_name'=> 'web'],
            ['name' => 'show settings','guard_name'=> 'web'],

            ['name' => 'list categories','guard_name'=> 'web'],
            ['name' => 'add category','guard_name'=> 'web'],
            ['name' => 'edit category','guard_name'=> 'web'],
            ['name' => 'delete category','guard_name'=> 'web'],

            ['name' => 'list products','guard_name'=> 'web'],
            ['name' => 'add product','guard_name'=> 'web'],
            ['name' => 'edit product','guard_name'=> 'web'],
            ['name' => 'delete product','guard_name'=> 'web'],

            ['name' => 'list drivers','guard_name'=> 'web'],
            ['name' => 'add driver','guard_name'=> 'web'],
            ['name' => 'edit driver','guard_name'=> 'web'],
            ['name' => 'delete driver','guard_name'=> 'web'],
            ['name' => 'change status','guard_name'=> 'web'],

            ['name' => 'list settings','guard_name'=> 'web'],
            ['name' => 'edit settings','guard_name'=> 'web'],

            ['name' => 'list orders','guard_name'=> 'web'],
            ['name' => 'add order','guard_name'=> 'web'],
            ['name' => 'edit order','guard_name'=> 'web'],
            ['name' => 'delete order','guard_name'=> 'web'],


        ]);
    }
}
