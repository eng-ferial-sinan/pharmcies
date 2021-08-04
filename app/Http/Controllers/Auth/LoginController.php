<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    // public function login(Request $request){
    //     $data=$request->all();
    //     $loginType=$request->loginType?$request->loginType:"normal";
    //     $result=false;
    //     if($loginType=="social")
    //     {
    //      $User=User::where('email',$data['email'])->where('block',0)->where('hold',0)-> first();
    //      if($User)
    //      { 
    //         $result=Auth::guard('app_users')->attempt(['email'=>$data['email'],'password'=>$data['password'],'block'=>0,'hold'=>0]);

    //      } 
    //      $response=['success'=>$result ];
    //      if($result)
    //      {
    //          $User=Auth::guard('app_users')->user();
    //          $token=$User->generateToken();
    //          $response['token']=$token->token;
    //          $response['user']=$user;
    //          $response['user']['addresses']=$user->addresses;
    //      }
    //      return response()->json($response);
    //     }
    //     }
}
