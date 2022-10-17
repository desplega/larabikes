@extends('layouts.master')

@section('titulo', 'Listado de motos')

@section('contenido')
    <div class="row">
        <div class="col-6 text-start">{{ $bikes->links() }}</div>
        @auth
            <div class="col-6 text-end">
                <p>Nueva moto <a href="{{ route('bikes.create') }}" class="btn btn-success ml-2">+</a></p>
            </div>
        @endauth
    </div>

    <form method="GET" action="{{ route('bikes.search') }}" class="col-6 row">
        <input name="marca" type="text" class="col form-control m-2" placeholder="Marca" maxlength="16"
            value="{{ $marca ?? '' }}">
        <input name="modelo" type="text" class="col form-control m-2" placeholder="Modelo" maxlength="16"
            value="{{ $modelo ?? '' }}">
        <button type="submit" class="col btn btn-primary m-2">Buscar</button>
        <a href="{{ route('bikes.index') }}" class="col btn btn-secondary m-2" role="button">Borrar</a>
    </form>

    <x-listing :bikes="$bikes"></x-listing>

@endsection
