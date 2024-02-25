<?php

namespace App\Http\Controllers\Auth;

use App\Enum\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $user = User::updateOrCreate([
            'google_id' => $user->getId()
        ], [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'google_id' => $user->getId(),
            'role' => UserRoleEnum::USER
        ]);
        Auth::login($user);
        Cookie::queue('user', $user->getId, $user->expiresIn);
        return redirect()->intended('/');
    }
}
