@extends('layouts.master')

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (null === Auth::user()->email_verified_at)
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                            </form>
                        </div>
                    @endif
                @endif
                <div class="card mb-3">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2 class="">Información del usuario</h2>
                        <div class="row">
                            <div class="col-6">
                                <div><b>Nombre:</b></div>
                                <div><b>Email:</b></div>
                                <div><b>Fecha de alta:</b></div>
                                <div><b>Fecha de nacimiento:</b></div>
                            </div>
                            <div class="col-6">
                                <div>{{ Auth::user()->name }}</div>
                                <div>{{ Auth::user()->email }}</div>
                                <div>{{ Custom::formatDate('es', Auth::user()->created_at) }}</div>
                                <div>{{ Custom::formatDate('es', Auth::user()->birth_date) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h4>Listado de motos</h4>
        <form method="GET" action="{{ route('home.search') }}" class="col-6 row">
            <input name="marca" type="text" class="col form-control m-2" placeholder="Marca" maxlength="16"
                value="{{ $marca ?? '' }}">
            <input name="modelo" type="text" class="col form-control m-2" placeholder="Modelo" maxlength="16"
                value="{{ $modelo ?? '' }}">
            <button type="submit" class="col btn btn-primary m-2">Buscar</button>
            <a href="{{ route('home') }}" class="col btn btn-secondary m-2" role="button">Borrar</a>
        </form>
        <x-listing :bikes="$bikes"></x-listing>

        @if (count($deletedBikes))
            <h4>Listado de motos borradas</h4>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Matrícula</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($deletedBikes as $bike)
                    <tr>
                        <td>{{ $bike->id }}</td>
                        <td class="text-center" style="max-width: 80px">
                            <img class="rounded" style="max-width: 80%"
                                alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                                title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                                src="{{ asset('storage/' . config('filesystems.bikesImageDir')) . '/' . ($bike->imagen ?? 'default.png') }}">
                        </td>

                        <td>{{ $bike->marca }}</td>
                        <td>{{ $bike->modelo }}</td>
                        <td>{{ $bike->matricula }}</td>
                        <td class="text-center">
                            <a href="{{ route('bikes.restore', $bike->id) }}">
                                <button class="btn btn-success">Restaurar</button>
                            </a>
                        </td>
                        <td class="text-center">
                            <form method="POST" action="{{ route('bikes.purge') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">

                                <input name="bike_id" type="hidden" value="{{ $bike->id }}">
                                <input type="submit" alt="Borrar" title="Eliminar" class="btn btn-danger"
                                    value="Eliminar">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection
