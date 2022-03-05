<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token=$request->header('token');
        $user=User::where('token',$token)->first();
        if($user)
        {
            if($user->hasRole('عميل'))
            {
                Auth::loginUsingId($user->id);
                return $next($request);
            }else
            {
        return response(['status' => false ,'message'=>'الحساب ليس حساب عميل'],403);

            }
       }
        return response(['status' => false ,'message'=>'الحساب غير موجود'],403);

    }
}
