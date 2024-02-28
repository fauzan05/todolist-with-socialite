<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'postRegister']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
Route::middleware(['auth', 'refresh.token'])->group(function() {
    Route::get('/', [TodoController::class, 'index'])->name('home');
    Route::get('/logout', [TodoController::class, 'logout']);
    Route::get('/auth/google/refresh', [GoogleController::class, 'refreshToken']);
    Route::get('/categories', [CategoryController::class, 'getCategories']);
    Route::get('/todos', [TodoController::class, 'getTodos']);
    Route::post('/todos', [TodoController::class, 'createTodo']);
    Route::post('/todos/delete/{idTodo}', [TodoController::class, 'deleteTodo'])->where('idTodo', '[0-9]+');
});