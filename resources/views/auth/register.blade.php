@section('title', 'Halaman Registrasi')
@extends('layouts.app')
@section('content')
<div class="container m-5">
    <div class="row d-flex flex-column align-items-center justify-content-center">
        <div class="col-5 border rounded shadow-sm d-flex flex-column align-items-center justify-content-center">
            <h2 class="text-center my-3">Registrasi User</h2>
            <hr style="width: 80%">
            <div id="app">
                    <register/>
            </div>
        </div>
    </div>
</div>
@endsection