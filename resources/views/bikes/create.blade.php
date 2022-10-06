@extends('layouts.master')

@section('titulo', 'Nueva moto')

@section('contenido')
    <form class="my-2 border p-5" method="POST" action="{{ route('bikes.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
            <input name="marca" type="text" class="up form-control col-sm-10" id="inputMarca" placeholder="Marca"
                maxlength="255" required="required" value="{{ old('marca') }}">
        </div>
        <div class="form-group row">
            <label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
            <input name="modelo" type="text" class="up form-control col-sm-10" id="inputModelo" placeholder="Modelo"
                maxlength="255" required="required" value="{{ old('modelo') }}">
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
        <div class="form-group row mt-3">
            <label for="inputImagen" class="col-sm-2 col-form-label">Imagen</label>
            <input name="imagen" type="file" class="form-control-file col-sm-10" id="inputImagen">
        </div>
        <div class="form-group row my-3">
            <div class="form-check col-sm-6">
                <input name="matriculada" type="checkbox" value="1" class="form-check-input"
                    id="chkMatriculada" {{ empty(old('matriculada')) ? "" : "checked" }}>
                <label for="chkMatriculada" class="form-check-label">Matriculada</label>
            </div>
            <div class="form-check col-sm-6">
                <label for="inputMatricula" class="col-sm-2 form-label">Matrícula</label>
                <input name="matricula" type="text" class="up form-control"
                    id="inputMatricula" maxlength="7" value="{{ old('matricula') }}">
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
                <input type="checkbox" class="form-check-input" id="chkColor">
                <label for="chkColor" class="form-check-label">Indicar el color</label>
            </div>
            <div class="form-check col-sm-6">
                <label for="inputColor" class="col-sm-2 form-label">Color</label>
                <input name="color" type="color" class="form-control form-control-color"
                    style="height: fit-content;" id="inputColor" value="{{ old('color') ?? '#FFFFFF' }}">
            </div>
        </div>
        <script>
            inputColor.disabled = !chkColor.checked;
            chkColor.onchange = function() {
                inputColor.disabled = !chkColor.checked;
            }
        </script>
        <div class="form-group row">
            <button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
            <button type="reset" class="btn btn-secondary m-2">Borrar</button>
        </div>
    </form>
@endsection

@section('enlaces')
    @parent
    <a href="{{ route('bikes.index') }}" class="btn btn-primary m-2">Garaje</a>
@endsection
