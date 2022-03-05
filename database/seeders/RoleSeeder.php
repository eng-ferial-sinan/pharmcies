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

        $role1->givePermissionTo('add plan');
        $role1->givePermissionTo('edit plan');
        $role1->givePermissionTo('delete plan');
        $role1->givePermissionTo('list plans');

        $role1->givePermissionTo('list subscriptions');
        $role1->givePermissionTo('add subscription');
        $role1->givePermissionTo('edit subscription');
        $role1->givePermissionTo('delete subscription');
      
        $role2 = Role::findOrCreate('عميل', 'web');
        $role2->givePermissionTo('list subscriptions');
        $role2->givePermissionTo('add subscription');
        $role2->givePermissionTo('edit subscription');
        $role2->givePermissionTo('delete subscription');

    

    }
}
