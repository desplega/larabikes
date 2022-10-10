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

    <div class="p-3 bg-light text-dark container">
        <div class="row">
            <div class="col-6">
                <figure class="inline">
                    <img width="100" src="{{ asset('images/logos/logo.png') }}" alt="Logo">
                </figure>
                <div class="inline">{{ config('app.name') }}</div>
            </div>
            <div class="col-6 text-right">
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item mr-2">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item mr-2">
                                <a class="nav-link ml-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        @if (Route::has('home'))
                            <li class="nav-item mr-2">
                                <a class="nav-link" href="{{ route('home') }}">{{ Auth::user()->name }}
                                    ({{ Auth::user()->email }})</a>
                            </li>
                        @endif

                        @if (Route::has('logout'))
                            <li class="nav-item mr-2">
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endif
                    @endguest
                </ul>
            </div>
        </div>
    </div>

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
                    <a class="nav-link {{ $page == 'home' ? 'active' : '' }}" href="{{ route('bikes.create') }}">
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
