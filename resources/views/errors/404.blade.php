@extends('layouts.master')

@section('titulo', 'Error 404')

@section('contenido')
    <div class="m-10">
        <div class="fs-1 content text-center">
            ERROR 404: No encontrado
        </div>
        <figure class="text-center">
            <img class="w-50 rounded mx-auto d-block" alt="No encontrado" src="{{ asset('images/errors/404.jpg') }}">
        </figure>
        <div class="fs-4 title mb-5 text-center">
            {{ $exception->getMessage() }}
        </div>
    </div>
@endsection
