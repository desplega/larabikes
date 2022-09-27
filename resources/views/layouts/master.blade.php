<!DOCTYPE htlm>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplicación de gestión de motos Larabikes">

    <title>{{ config('app.name') }} - @yield('titulo')</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body class="container p-3">
    <!-- PARTE SUPERIOR (menú) -->
    @env(['local', 'test'])
    <x-local :mode="App::environment()" />
    @endenv

    @section('navegacion')
        <nav>
            <ul class="nav nav-pills my-3">
                <li class="nav-item mr-2">
                    <a class="nav-link {{ $page == 'inicio' ? 'active' : '' }}" href="{{ url('/') }}">Inicio</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link {{ $page == 'garaje' ? 'active' : '' }}" href="{{ route('bikes.index') }}">Garaje</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'nueva_moto' ? 'active' : '' }}" href="{{ route('bikes.create') }}">Nueva
                        moto</a>
                </li>
            </ul>
        </nav>
    @show

    <!-- PARTE CENTRAL -->
    <h1 class="my-2">Gestor de motos Larabikes</h1>

    <main>
        <h2>@yield('titulo')</h2>

        @if (Session::has('success'))
            <x-alert type="success" message="{{ Session::get('success') }}" />
        @endif

        @if ($errors->any())
            <x-alert type="danger" message="Se ha producido un error">
                <ul>
                    @foreach (errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
        @endif

        @yield('contenido')

        <div class="btn-group" role="group" aria-label="Links">
            @section('enlaces')
                <a href="{{ url('/') }}" class="btn btn-primary m-2">Inicio</a>
            @show
        </div>
    </main>

    <!-- PARTE INFERIOR -->
    @section('pie')
        <footer class="page-footer font-small p-4 bg-light">
            <p>
                Aplicación creada en el curso de Laravel @CIFO Sabadell. Desarrollada
                haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.
            </p>
        </footer>
    @show
</body>

</html>
