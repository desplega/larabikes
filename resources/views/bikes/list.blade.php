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
        <h2>Listado de motos</h2>

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

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
            <tr><td colspan="4">Mostrando {{ sizeof($bikes) }} de {{ $total }}</td></tr>
        </table>

        <div class="btn-group" role="group" label="Links">
            <a href="{{ url('/') }}" class="btn btn-primary mr-2">Inicio</a>
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
