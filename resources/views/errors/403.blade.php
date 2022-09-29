@extends('layouts.master')

@section('titulo', 'Error 403')

@section('contenido')
    <div class="m-10">
        <div class="fs-1 content text-center">
            ERROR 403: Prohibido
        </div>
        <figure class="text-center">
            <img class="w-50 rounded mx-auto d-block" alt="Acceso denegado" src="{{ asset('images/errors/403.jpg') }}">
        </figure>
        <div class="fs-4 title mb-5 text-center">
            {{ $exception->getMessage() }}
        </div>
    </div>
@endsection
