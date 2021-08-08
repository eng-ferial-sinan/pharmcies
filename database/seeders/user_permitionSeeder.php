<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\permission;
use App\Models\user_permission;
class user_permitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =User::first();
        $permissions =permission::all();

        foreach($permissions as $perm)
        { 
            $user_permission=new user_permission;
            $user_permission->user_id=$user->id;
            $user_permission->permission_id=$perm->id;
            $user_permission->save();
        }  
    }
}
