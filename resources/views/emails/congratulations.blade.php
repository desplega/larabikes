<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <style>
        {{ include 'css/bootstrap.min.css' }}
    </style>
</head>

<body class="container p-3">
    <header class="container row bg-light p-4 my-4">
        <figure class="img-fluid col-2">
            <img width="100" src="{{ asset('images/logos/logo.png') }}" alt="logo">
        </figure>
        <h1>{{ config('app.name') }}</h1>
    </header>
    <main>
        <h2>¡Felicidades {{ $user->name }}!</h2>
        <h3>Has publicado tu primera moto en LaraBikes.</h3>
        <p>Tu nueva moto {{ $bike->marca . ' ' . $bike->modelo }} ya
            aparece en el portal de LaraBikes.</p>
        <p>Sigue así, estás colaborando para que LaraBikes se convierta
            en la primera red de usuarios de motocicletas de los CIFO.</p>
    </main>
    <footer class="page-footer font-small p-4 my-4 bg-light">
        <p>Aplicación creada como ejemplo de clase,
            desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
    </footer>
</body>

</html>
