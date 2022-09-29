@extends('layouts.master')

@section('titulo', 'Modo de mantenimiento')

@section('contenido')
    <br><br>
    <p class="fs-1">En mantenimiento...</p>

    <figure class="text-center">
        <img class="rounded mx-auto d-block" alt="Modo de mantenimiento" src="{{ asset('images/errors/503.png') }}">
    </figure>

    <p class="fs-1 text-center">503</p>
@endsection
