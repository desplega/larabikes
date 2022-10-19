@extends('layouts.master')

@section('titulo', "Confirmación de borrado de la moto $bike->marca $bike->modelo")

@section('contenido')
    <form method="POST" class="my-2 border p-5" action="{{ URL::signedRoute('bikes.purge') }}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">

        <figure>
            <figcaption>Imagen actual:</figcaption>
            <img class="rounded" style="max-width: 400px" alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                src="{{ asset('storage/' . config('filesystems.bikesImageDir')) . '/' . ($bike->imagen ?? 'default.png') }}">
        </figure>

        <input name="bike_id" type="hidden" value="{{ $bike->id }}">
        <label for="confirmdelete">Confirmar el borrado DEFINITIVO de {{ "$bike->marca $bike->modelo" }}:</label>
        <input type="submit" alt="Borrar" title="Borrar" class="btn btn-danger m-4" value="Borrar" id="confirmdelete">
    </form>
@endsection

@section('enlaces')
    @parent
    <a href="{{ route('bikes.index') }}" class="btn btn-primary m-2">Garaje</a>
    <a href="{{ route('bikes.show', $bike->id) }}" class="btn btn-primary m-2">
        Regresar a detalles de la moto
    </a>
@endsection
