<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function pharmacy()
    {
        return $this->hasOne('App\Models\Pharmacy');
    }

    public static function hasPermission($name)
    {
        $ret = false;
        $user = Auth::user();
        $permission = permission::where('name', '=', $name)->first();
        $user_permission = user_permission::where('permission_id',$permission->id)->where('user_id',$user->id)->first();

       if($user_permission)
       $ret = true;

        return $ret;
    }
    public function apiTokens()
    {
    	return $this->hasOne(usertoken::class);
    }

    public function generateToken()
    {
        $token = bin2hex(random_bytes(16));
        while (usertoken::where('token', $token)->count() > 0) {
            $token = bin2hex(random_bytes(16));
        }
        usertoken::where('user_id', $this->id)->delete();
        return usertoken::create([
            'token' => $token,
            'user_id' => $this->id
        ]);
    }
}
