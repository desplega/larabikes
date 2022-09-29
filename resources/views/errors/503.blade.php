@extends('layouts.master')

@section('titulo', 'Error 503')

@section('contenido')
    <div class="m-10">
        <div class="fs-1 content text-center">
            ERROR 503: En mantenimiento
        </div>
        <figure class="text-center">
            <img class="w-50 rounded mx-auto d-block" alt="En mantenimiento" src="{{ asset('images/errors/503.png') }}">
        </figure>
        <div class="fs-4 title mb-5 text-center">
            {{ $exception->getMessage() }}
        </div>
    </div>
@endsection