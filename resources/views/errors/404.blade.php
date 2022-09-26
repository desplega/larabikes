@extends('layouts.master', ['page' => ''])

@section('titulo', 'Moto no encontrada')

@section('contenido')
    <figure class="row mt-2 mb-2 col-5 offet-1">
        <img class="d-block w-100" alt="Moto" src="{{ asset('images/errors/404.jpg') }}">
    </figure>

    <p class="fs-1 text-center">404</p>
@endsection
