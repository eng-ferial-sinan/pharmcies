<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\permission;

class permistionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'medicine-list',
            'medicine-create',
            'medicine-edit',
            'medicine-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'Pharmacy-list',
            'Pharmacy-create',
            'Pharmacy-edit',
            'Pharmacy-delete',
            'order-list',
            'order-create',
            'order-edit',
            'order-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'report-list',
            'report-create',
            'report-edit',
            'report-delete',
         ];
    
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
    }

