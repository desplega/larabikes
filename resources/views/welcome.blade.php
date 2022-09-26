@extends('layouts.master', ['page' => 'inicio'])

@section('contenido')
        <h2>Bienvenido a Larabikes</h2>
        <p>Implementación de un <b>CRUD</b> de motos.</p>

        <figure class="row mt-2 mb-2 col-10 offet-1">
            <img class="d-block w-100" alt="Moto" src="{{ asset('images/bikes/moto.jpg') }}">
        </figure>
@endsection

@section('enlaces')
@endsection