@extends('layouts.master', ['page' => ''])

@section('titulo', 'Moto no encontrada')

@section('contenido')
    <figure class="text-center">
        <img class="rounded mx-auto d-block" alt="Moto no encontrada" src="{{ asset('images/errors/404.jpg') }}">
    </figure>

    <p class="fs-1 text-center">404</p>
@endsection
