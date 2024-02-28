@section('title', 'Home - Simple Todolist')
@extends('layouts.todo')
@section('content')
    <div class="container m-5">
        <h2 class="text-center my-3">Menampilkan semua Todolist</h2>
        <div id="app">
            <show-todos />
        </div>
    </div>
@endsection
