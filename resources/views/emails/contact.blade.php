<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        * {
            font-family: arial, verdana, hevetica;
        }

        header,
        main,
        footer {
            border: solid 1px #ddd;
            padding: 15px;
            margin: 10px;
        }

        header,
        footer {
            background-color: #eee;
        }

        header {
            display: flex;
        }

        header figure {
            flex: 1
        }

        header h1 {
            flex 4
        }

        .cursiva {
            font-style: italic
        }

        .logo {
            width: 50px;
        }
    </style>
</head>

<body>
    <header>
        <figure>
            <img class="logo" src="{{ asset('images/logos/logo.png') }}" alt="Logo">
        </figure>
        <h1>{{ config('app.name') }}</h1>
    </header>
    <main>
        <h2>Mensaje recibido: {{ $mensaje->asunto }}</h2>
        <p class="cursiva">De {{ $mensaje->nombre }}
            <a href="mailto:{{ $mensaje->email }}">&lt;{{ $mensaje->email }}&gt;</a>
        </p>
        <p>{{ $mensaje->mensaje }}</p>
    </main>
    <footer>
        <p>Aplicación para {{ $centro }} como ejemplo de clase.
            Desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
    </footer>
</body>

</html>
