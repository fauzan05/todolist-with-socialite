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
        $this->middleware('refresh.token');
    }
    public function index()
    {
        return view('todo.index');
    }

    public function createTodo(Request $request)
    {
        $todo = Todo::create([
            'content' => trim($request->content),
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id
        ])->load('category');
        
        return response()->json(['data' => $todo], 200);
    }

    public function getTodos()
    {
        $todos = Todo::with(['category'])->orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $todos], 200);
    }

    public function deleteTodo(int $id)
    {
        $todo = Todo::find($id)->delete();
        return response()->json(['data' => $todo], 200);
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
