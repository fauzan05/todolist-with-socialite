<?php

namespace App\Http\Controllers\Auth;

use App\Enum\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        $parameters = ['access_type' => 'offline', "prompt" => "consent select_account"];
        return Socialite::driver('google')->with($parameters)->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        // dd($googleUser);
        $user = User::updateOrCreate([
            'google_id' => $googleUser->getId()
        ], [
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'role' => UserRoleEnum::USER
        ]);

        Token::updateOrCreate([
            'user_id' => $user->id
        ], [
            'access_token' => $googleUser->token,
            'refresh_token' => $googleUser->refreshToken,
            'expires_in' => $googleUser->expiresIn
        ]);

        Auth::login($user);
        Cookie::queue('user', $user->getId, $user->expiresIn * 72);
        return redirect()->intended('/');
    }

    public function refreshToken()
    {
        $user = auth()->user();
        $refreshToken = Socialite::driver('google')->refreshToken($user->token->refresh_token);
        Token::updateOrCreate([
            'user_id' => $user->id
        ], [
            'access_token' => $refreshToken->token,
            'refresh_token' => $refreshToken->refreshToken,
            'expires_in' => $refreshToken->expiresIn
        ]);
        Auth::login($user);
        Cookie::queue('user', $user->getId, $user->expiresIn * 72);
        return redirect()->intended('/');
    }
}
