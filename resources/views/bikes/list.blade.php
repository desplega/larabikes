@extends('layouts.master')

@section('titulo', 'Listado de motos')

@section('contenido')
    <div class="row">
        <div class="col-6 text-start">{{ $bikes->links() }}</div>
        <div class="col-6 text-end">
            <p>Nueva moto <a href="{{ route('bikes.create') }}" class="btn btn-success ml-2">+</a></p>
        </div>
    </div>

    <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Operaciones</th>
        </tr>
        @foreach ($bikes as $bike)
            <tr>
                <td>{{ $bike->id }}</td>
                <td>{{ $bike->marca }}</td>
                <td>{{ $bike->modelo }}</td>
                <td class="text-center">
                    <a class="text-decoration-none" href="{{ route('bikes.show', $bike->id) }}">
                        <img height="20" width="20" src="{{ asset('images/buttons/show.png') }}"
                            alt="Ver detaller" title="Ver detalles">
                    </a>

                    <a class="text-decoration-none" href="{{ route('bikes.edit', $bike->id) }}">
                        <img height="20" width="20" src="{{ asset('images/buttons/edit.png') }}"
                            alt="Modificar" title="Modificar">
                    </a>

                    <a class="text-decoration-none" href="{{ route('bikes.delete', $bike->id) }}">
                        <img height="20" width="20" src="{{ asset('images/buttons/delete.png') }}"
                            alt="Borrar" title="Borrar">
                    </a>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">Mostrando {{ sizeof($bikes) }} de {{ $total }}</td>
        </tr>
    </table>
@endsection

