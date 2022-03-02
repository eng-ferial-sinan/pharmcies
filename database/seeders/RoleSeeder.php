<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::findOrCreate('مدير', 'web');
        $role1->givePermissionTo('add user');
        $role1->givePermissionTo('edit user');
        $role1->givePermissionTo('delete user');
        $role1->givePermissionTo('list users');
        $role1->givePermissionTo('add role');
        $role1->givePermissionTo('edit role');
        $role1->givePermissionTo('delete role');
        $role1->givePermissionTo('list roles');

        $role1->givePermissionTo('list settings');
        $role1->givePermissionTo('edit settings');

        $role1->givePermissionTo('add salon');
        $role1->givePermissionTo('edit salon');
        $role1->givePermissionTo('delete salon');
        $role1->givePermissionTo('list salons');

        $role1->givePermissionTo('add service');
        $role1->givePermissionTo('edit service');
        $role1->givePermissionTo('delete service');
        $role1->givePermissionTo('list services');

        $role1->givePermissionTo('list reservations');
        $role1->givePermissionTo('add reservation');
        $role1->givePermissionTo('edit reservation');
        $role1->givePermissionTo('delete reservation');
       
        $role1->givePermissionTo('list promotions');
        $role1->givePermissionTo('add promotion');
        $role1->givePermissionTo('edit promotion');
        $role1->givePermissionTo('delete promotion');



        $role2 = Role::findOrCreate('عميل', 'web');
        $role2->givePermissionTo('list reservations');
        $role2->givePermissionTo('add reservation');
        $role2->givePermissionTo('edit reservation');
        $role2->givePermissionTo('delete reservation');

    }
}
