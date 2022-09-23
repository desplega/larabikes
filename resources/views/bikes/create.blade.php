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
                <a class="nav-link" href="{{ url('/') }}">Inicio</a>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link" href="{{ route('bikes.index') }}">Garaje</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('bikes.create') }}">Nueva moto</a>
            </li>
        </ul>
    </nav>

    <!-- PARTE CENTRAL -->
    <h1 class="my-2">Gestor de motos Larabikes</h1>

    <main>
        <h2>Nueva moto</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="my-2 border p-5" method="POST" action="{{ route('bikes.store') }}">
            {{ csrf_field() }}
            <div class="form-group row">
                <label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
                <input name="marca" type="text" class="up form-control col-sm-10" id="inputMarca"
                    placeholder="Marca" maxlength="255" required="required" value="{{ old('marca') }}">
            </div>
            <div class="form-group row">
                <label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
                <input name="modelo" type="text" class="up form-control col-sm-10" id="inputModelo"
                    placeholder="Modelo" maxlength="255" required="required" value="{{ old('modelo') }}">
            </div>
            <div class="form-grou row">
                <label for="inputkms" class="col-sm-2 col-form-label">Kms</label>
                <input name="kms" type="number" class="form-control col-sm-4" id="inputkms" required="required"
                    value="{{ old('kms') }}">
            </div>
            <div class="form-group row">
                <label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
                <input name="precio" type="number" class="up form-control col-sm-4" id="inputPrecio" maxlength="11"
                    requried="required" min="0" step="0.01" value="{{ old('precio') }}">
            </div>
            <div class="form-group row">
                <div class="form-check mt-3">
                    <input name="matriculada" value="1" class="form-check-input" type="checkbox"
                        {{ empty(old('matriculada')) ? '' : 'checked' }}>
                    <label class="form-check-label">Matriculada</label>
                </div>
            </div>
            <div class="form-group row">
                <button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
                <button type="reset" class="btn btn-secondary m-2">Borrar</button>
            </div>
        </form>

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
