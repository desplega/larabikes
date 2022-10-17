@extends('layouts.master')

@section('titulo', "Detalles de la moto $bike->marca $bike->modelo")

@section('contenido')
    <table class="table table-striped table-bordered ">
        <tr>
            <td>ID</td>
            <td>{{ $bike->id }}</td>
        </tr>
        <tr>
            <td>Marca</td>
            <td>{{ $bike->marca }}</td>
        </tr>
        <tr>
            <td>Modelo</td>
            <td>{{ $bike->modelo }}</td>
        </tr>
        <tr>
            <td>Kms</td>
            <td>{{ $bike->kms }}</td>
        </tr>
        <tr>
            <td>Precio</td>
            <td>{{ $bike->precio }}</td>
        </tr>
        <tr>
            <td>Propietario</td>
            <td>{{ $bike->user ? $bike->user->name : 'Sin propietario' }}</td>
        </tr>
        <tr>
            <td>Matriculada</td>
            <td>{{ $bike->matriculada ? 'Sí' : 'No' }}</td>
        </tr>
        @if ($bike->matriculada)
        <tr>
            <td>Matrícula</td>
            <td>{{ $bike->matricula }}</td>
        </tr>
        @endif
        @if ($bike->color)
            <tr>
                <td>Color</td>
                <td
                    style="background-color: {{ $bike->color }}; {{ App\Http\Controllers\BikeController::whiteText($bike->color) }}">
                    {{ $bike->color }}
                </td>
            </tr>
        @endif
        <tr>
            <td>Imagen</td>
            <td class="text-start">
                <img class="rounded" style="max-width: 400px" alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                    title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                    src="{{ asset('storage/' . config('filesystems.bikesImageDir')) . '/' . ($bike->imagen ?? 'default.png') }}">
            </td>
        </tr>
    </table>

    @auth
        <div class="text-end my-3">
            <div class="btn-group mx-2">
                @if (Auth::user()->can('update', $bike))
                    <a class="mx-2" href="{{ route('bikes.edit', $bike->id) }}">
                        <img height="25" width="25" src="{{ asset('images/buttons/update.png') }}" alt="Modificar"
                            title="Modificar">
                    </a>
                @endif
                @if (Auth::user()->can('delete', $bike))
                    <a class="mx-2" href="{{ route('bikes.delete', $bike->id) }}">
                        <img height="25" width="25" src="{{ asset('images/buttons/delete.png') }}" alt="Borrar"
                            title="Borrar">
                    </a>
                @endif
            </div>
        </div>
    @endauth
@endsection

@section('enlaces')
    @parent
    <a href="{{ route('bikes.index') }}" class="btn btn-primary m-2">Garaje</a>
@endsection
