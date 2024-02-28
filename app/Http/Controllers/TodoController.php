<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class TodoController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'refresh.token']);
    }
    public function index()
    {
        return view('todo.index');
    }

    public function createTodo(Request $request)
    {
        Todo::create([
            'content' => trim($request->content),
            'user_id' => $request->user_id,
            'category_id' => $request->category_id
        ]);
        return response()->json(['message' => 'Berhasil membuat todo!'], 200);
    }

    public function getTodos()
    {
        $todos = Todo::all();
        return response()->json(['data' => $todos], 200);
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
