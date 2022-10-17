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

    <x-header />

    @php($page = Route::currentRouteName())
    @section('navegacion')
        <nav>
            <ul class="nav nav-pills my-3">
                <li class="nav-item mr-2">
                    <a class="nav-link {{ $page == 'portada' ? 'active' : '' }}" href="{{ route('portada') }}">Inicio</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link {{ in_array($page, ['bikes.index', 'bikes.show', 'bikes.edit', 'bikes.delete', 'bikes.search']) ? 'active' : '' }}"
                        href="{{ route('bikes.index') }}">Garaje</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link {{ $page == 'contacto' ? 'active' : '' }}"
                        href="{{ route('contacto') }}">Contacto</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link {{ in_array($page, ['home', 'home.search']) ? 'active' : '' }}" href="{{ route('home') }}">
                        Mis Motos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'bikes.create' ? 'active' : '' }}" href="{{ route('bikes.create') }}">
                        Nueva moto
                    </a>
                </li>
                @endauth
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
                <ul style="margin-bottom: 0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
        @endif

        <p>Contamos con un catálogo de {{ $total }} motos.</p>

        @yield('contenido')

        <div class="btn-group" role="group" aria-label="Links">
            @section('enlaces')
                <a href="{{ url()->previous() }}" class="btn btn-primary m-2">Atrás</a>
                <a href="{{ route('portada') }}" class="btn btn-primary m-2">Inicio</a>
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
