@extends('layouts.master')

@section('titulo', "Actualización de la moto $bike->marca $bike->modelo")

@section('contenido')
    <p>Hasta ahora has actualizado {{ $updated_counter }} motos</p>
    <form class="my-2 border p-5" method="POST" action="{{ route('bikes.update', $bike->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">

        <div class="form-group row">
            <label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
            <input name="marca" value="{{ old('marca', $bike->marca) }}" type="text" class="up form-control col-sm-10"
                id="inputMarca" placeholder="Marca" maxlength="255" required="required">
        </div>
        <div class="form-group row">
            <label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
            <input name="modelo" value="{{ old('modelo', $bike->modelo) }}" type="text" class="up form-control col-sm-10"
                id="inputModelo" placeholder="Modelo" maxlength="255" required="required">
        </div>
        <div class="form-group row">
            <label for="inputkms" class="col-sm-2 col-form-label">Kms</label>
            <input name="kms" value="{{ old('kms', $bike->kms) }}" type="number" class="up form-control col-sm-4" id="inputkms"
                placeholder="Precio" required="required">
        </div>
        <div class="form-group row">
            <label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
            <input name="precio" value="{{ old('precio', $bike->precio) }}" type="number" class="up form-control col-sm-4"
                id="inputPrecio" placeholder="Precio" min="0" step="0.01" required="required">
        </div>
        <div class="form-group row mt-3">
            <div class="col-sm-9">
                <p class="col-form-label">
                    {{ $bike->imagen ? 'Sustituir' : 'Añadir' }} imagen
                </p>
                <input name="imagen" type="file" class="form-control-file" id="inputImagen">

                @if ($bike->imagen)
                    <div class="form-check my-3">
                        <input name="eliminarimagen" type="checkbox" class="form-check-input" id="inputEliminar">
                        <label for="inputEliminar" class="form-check-label">Eliminar imagen</label>
                    </div>
                    <script>
                        inputEliminar.onchange = function() {
                            inputImagen.value = '';
                            inputImagen.disabled = this.checked;
                        }
                    </script>
                @endif
            </div>
            <div class="col-sm-3">
                <p class="col-form-label">Imagen actual</p>
                <img class="rounded img-thumbnail my-3" alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                    title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                    src="{{ asset('storage/' . config('filesystems.bikesImageDir')) . '/' . ($bike->imagen ?? 'default.png') }}">
            </div>
        </div>
        <div class="form-group row my-3">
            <div class="form-check col-sm-6">
                <input name="matriculada" type="checkbox" class="form-check-input" id="chkMatriculada"
                    {{ old('matriculada', $bike->matriculada) ? 'checked' : '' }} value="1">
                <label for="chkMatriculada" class="form-check-label">Matriculada</label>
            </div>
            <div class="form-check col-sm-6">
                <label for="inputMatricula" class="col-sm-2 form-label">Matrícula</label>
                <input name="matricula" type="text" class="up form-control" id="inputMatricula" maxlength="7"
                    value="{{ old('matricula', $bike->matricula) }}">
            </div>
        </div>
        <script>
            inputMatricula.disabled = !chkMatriculada.checked;
            chkMatriculada.onchange = function() {
                inputMatricula.disabled = !chkMatriculada.checked;
            }
        </script>
        <div class="form-group row">
            <div class="form-check col-sm-6">
                <input type="checkbox" class="form-check-input" id="chkColor" value="1" {{ old('color', $bike->color) ? 'checked' : '' }}>
                <label for="chkColor" class="form-check-label">Indicar el color</label>
            </div>
            <div class="form-check col-sm-6">
                <label for="inputColor" class="col-sm-2 form-label">Color</label>
                <input name="color" type="color" class="form-control form-control-color"
                    style="height: fit-content;" id="inputColor" value="{{ old('color', $bike->color) ?? '#FFFFFF' }}">
            </div>
        </div>
        <script>
            inputColor.disabled = !chkColor.checked;
            chkColor.onchange = function() {
                inputColor.disabled = !chkColor.checked;
            }
        </script>
        <div class="form-group row">
            <button type="submit" class="btn btn-success mt-5 m-2">Guardar</button>
            <button type="reset" class="btn btn-secondary m-2">Restablecer</button>
        </div>
    </form>

    <div class="text-end my-3">
        <div class="btn-group mx-2">
            <a class="mx-2" href="{{ route('bikes.show', $bike->id) }}">
                <img height="25" width="25" src="{{ asset('images/buttons/show.png') }}" alt="Detalles"
                    title="Detalles">
            </a>
            <a class="mx-2" href="{{ route('bikes.delete', $bike->id) }}">
                <img height="25" width="25" src="{{ asset('images/buttons/delete.png') }}" alt="Borrar"
                    title="Borrar">
            </a>
        </div>
    </div>
@endsection

@section('enlaces')
    @parent
    <a href="{{ route('bikes.index') }}" class="btn btn-primary m-2">Garaje</a>
@endsection
