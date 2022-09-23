<!DOCTYPE htlm>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplicación de gestión de motos Larabikes">

    <title>{{ config('app.name') }} - PORTADA</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body class="container p-3">
    <!-- PARTE SUPERIOR (menú) -->
    <nav>
        <ul class="nav nav-pills my-3">
            <li class="nav-item mr-2">
                <a class="nav-link active" href="{{ url('/') }}">Inicio</a>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link" href="{{ route('bikes.index') }}">Garaje</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('bikes.create') }}">Nueva moto</a>
            </li>
        </ul>
    </nav>

    <!-- PARTE CENTRAL -->
    <h1 class="my-2">Gestor de motos Larabikes</h1>

    <main>
        <h2>Detalles de la moto {{ "$bike->marca $bike->modelo" }}</h2>

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

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
                <td>Precio</td>
                <td>{{ $bike->precio }}</td>
            </tr>
            <tr>
                <td>Kms</td>
                <td>{{ $bike->kms }}</td>
            </tr>
            <tr>
                <td>Matriculada</td>
                <td>{{ $bike->matriculada ? 'Sí' : 'No' }}</td>
            </tr>
        </table>

        <div class="text-end my-3">
            <div class="btn-group mx-2">
                <a class="mx-2" href="{{ route('bikes.edit', $bike->id) }}">
                    <img height="25" width="25" src="{{ asset('images/buttons/update.png') }}" alt="Modificar"
                        title="Modificar">
                </a>
                <a class="mx-2" href="{{ route('bikes.delete', $bike->id) }}">
                    <img height="25" width="25" src="{{ asset('images/buttons/delete.png') }}" alt="Borrar"
                        title="Borrar">
                </a>
            </div>
        </div>

        <div class="btn-group" role="group" aria-label="Links">
            <a href="{{ url('/') }}" class="btn btn-primary m-2">Inicio</a>
            <a href="{{ route('bikes.index') }}" class="btn btn-primary m-2">Garaje</a>
        </div>
    </main>

    <!-- PARTE INFERIOR -->
    <footer class="page-footer font-small p-4 bg-light">
        <p>
            Aplicación creada en el curso de Laravel @CIFO Sabadell. Desarrollada
            haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.
        </p>
    </footer>
</body>

</html>
