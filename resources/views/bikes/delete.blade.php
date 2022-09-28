@extends('layouts.master')

@section('titulo', "Confirmación de borrado de la moto $bike->marca $bike->modelo")

@section('contenido')
    <form method="POST" class="my-2 border p-5" action="{{ route('bikes.destroy', $bike->id) }}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">

        <label for="confirmdelete">Confirmar el borrado de {{ "$bike->marca $bike->modelo" }}:</label>
        <input type="submit" alt="Borrar" title="Borrar" class="btn btn-danger m-4" value="Borrar"
            id="confirmdelete">
    </form>
@endsection

@section('enlaces')
    @parent
    <a href="{{ route('bikes.index') }}" class="btn btn-primary m-2">Garaje</a>
    <a href="{{ route('bikes.show', $bike->id) }}" class="btn btn-primary m-2">
        Regresar a detalles de la moto
    </a>
@endsection
