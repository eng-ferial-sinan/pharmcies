<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_permission extends Model
{
    use HasFactory;
    public static function getUserRole()
    {
	    $role = Auth::user()->role;
        $roles = DB::table('roles')->where('id', '=', $role)->get()->first();
        return $roles->role;
    }
    
    public static function getUserRoleId()
    {
        $role = Auth::user()->role;
        return $role;
    }
    public static function getUserPermission($name)
    {
        $ret = false;
        $role = Auth::user()->role;
        $permission = DB::table('permissions')->where('value', '=', $name)->get()->first();
        if ($role == 1)
            $ret = $permission->role1;
        if ($role == 2)
            $ret = $permission->role2;
        if ($role == 3)
            $ret = $permission->role3;
        if ($role == 4)
            $ret = $permission->role4;
        return $ret;
    }

}
