<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use AuthenticatesUsers {
        logout as performLogout;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $data['password']=Hash::make($data['password']);
        $user = User::create($data);
        $user->assignRole('عميل');
        Auth::loginUsingId($user->id);

        return redirect()->route('index')
        ->with('success','  تم انشاءالحساب بنجاح ');
    }


    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
         {
            return  redirect()->route('index')
            ->with('success','تم تسجيل الدخول ');
        }
        return redirect()->back()
        ->with('error',' البيانات خاطئة');
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);   
        return redirect()->route('index');    }

    public function update(UpdateUserRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        $user->update($data);
        return  redirect()->back()
        ->with('success','تم تعديل البيانات ');
    }

}
