<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class TodoController extends Controller
{
    public function index()
    {
        return view('todo.index');
    }

    public function createTodo()
    {
        
    }

    public function logout(Request $request)
    {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Cookie::expire('user');
            return redirect('/login')->with('status', 'Sesi anda telah habis! Silahkan login kembali');
    }
}
