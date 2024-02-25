<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Enum\UserRoleEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        User::create([
            'name' => trim($request->name),
            'email' => trim($request->email),
            'password' => Hash::make($request->password),
            'role' => UserRoleEnum::USER
        ]);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            if((boolean)$request->rememberMe) {
                Cookie::queue('user', auth()->user()->id, 525600); // setahun
            }else{
                Cookie::queue('user', auth()->user()->id, 4320); // 3 hari
            }
            return response()->json(['data' => 'Email atau Password benar!'], 200);
        }else{
            return response()->json(['error' => 'Email atau Password salah!'], 401);
        }
    }


}
