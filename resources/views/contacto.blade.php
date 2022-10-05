@extends('layouts.master')

@section('titulo', 'Contactar con LaraBikes')

@section('contenido')
    <div class="container row">
        <form class="col-7 my-2 border p-4" enctype="multipart/form-data"
            method="POST" action="{{ route('contacto.email') }}">
            @csrf
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <input name="email" type="email" class="up form-control" id="inputEmail" placeholder="Email"
                    maxlength="255" required="required" value="{{ old('email') }}">
            </div>
            <div class="form-group row">
                <label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
                <input name="nombre" type="text" class="up form-control" id="inputNombre" placeholder="Nombre"
                    maxlength="255" required="required" value="{{ old('nombre') }}">
            </div>
            <div class="form-group row">
                <label for="inputAsunto" class="col-sm-2 col-form-label">Asunto</label>
                <input name="asunto" type="text" class="up form-control" id="inputAsunto" placeholder="Asunto"
                    maxlength="255" required="required" value="{{ old('asunto') }}">
            </div>
            <div class="form-group row">
                <label for="inputMensaje" class="col-sm-2 col-form-label">Mensaje</label>
                <textarea name="mensaje" id="inputMensaje" maxtlength="2048" class="up form-control" required="required">{{ old('mensaje') }}</textarea>
            </div>
            <div class="form-group row my-4">
                <label for="inputFichero" class="form-label">Fichero (pdf):</label>
                <input name="fichero" type="file" id="inputFichero" class="form-control-file" accept="application/pdf">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success mr-2 mt-4">Enviar</button>
                <button type="reset" class="btn btn-secondary mr-2 mt-4">Borrar</button>
            </div>
        </form>

        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2985.6478007144265!2d2.055835615840669!3d41.55522247924903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a493650ae03931%3A0xee4ac6c8e8372532!2sCIFO%20Sabadell!5e0!3m2!1sen!2ses!4v1664975967644!5m2!1sen!2ses"
            style="min-width:300px;min-height:300px;" allowfullscreen="" loading="lazy"
            class="col-5 my-2 border p-3"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
@endsection

@section('enlaces')
    @parent
    <a hred="{{ route('bikes.index') }}" class="btn btn-primary m-2">Garaje</a>
@endsection
