@section('title', 'Home - Simple Todolist')
@extends('layouts.todo')
@section('content')
<div class="container m-5">
    <h2 class="text-center my-3">Menampilkan semua Todolist</h2>
    <div class="row gap-3 d-flex flex-row align-items-start justify-content-center">
        <div class="col-5 border rounded shadow-sm d-flex flex-column align-items-center justify-content-center">
            <h2 class="text-center my-3">Buat Todo</h2>
            <hr style="width: 80%">
            <div id="app">
                    <create-todo/>
            </div>
        </div>
        <div class="col-5 border rounded shadow-sm d-flex flex-column align-items-center justify-content-center">
            <h2 class="text-center my-3">Semua Todo</h2>
            <hr style="width: 80%">
            <div id="app">
                    <show-todos/>
            </div>
        </div>
    </div>
</div>
@endsection