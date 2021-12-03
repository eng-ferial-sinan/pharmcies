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

        $role1->givePermissionTo('add category');
        $role1->givePermissionTo('edit category');
        $role1->givePermissionTo('delete category');
        $role1->givePermissionTo('list categories');

        $role1->givePermissionTo('add product');
        $role1->givePermissionTo('edit product');
        $role1->givePermissionTo('delete product');
        $role1->givePermissionTo('list products');

        $role1->givePermissionTo('list orders');
        $role1->givePermissionTo('add order');
        $role1->givePermissionTo('edit order');
        $role1->givePermissionTo('delete order');
       
        $role1->givePermissionTo('list slides');
        $role1->givePermissionTo('add slide');
        $role1->givePermissionTo('edit slide');
        $role1->givePermissionTo('delete slide');



        $role2 = Role::findOrCreate('عميل', 'web');
        $role2->givePermissionTo('list orders');
        $role2->givePermissionTo('add order');
        $role2->givePermissionTo('edit order');
        $role2->givePermissionTo('delete order');

        $role2 = Role::findOrCreate('سائق', 'web');
        $role2->givePermissionTo('list orders');

    }
}
