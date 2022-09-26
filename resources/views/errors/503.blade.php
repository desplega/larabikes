@extends('layouts.master', ['page' => ''])

@section('titulo', 'Error del servidor')

@section('contenido')
    <div class="text-center">
        <img class="rounded mx-auto d-block" alt="Error de servidor" src="{{ asset('images/errors/503.png') }}">
    </div>

    <p class="fs-1 text-center">503</p>
@endsection
