@extends('layouts.master')

@section('titulo', 'Nueva moto')

@section('contenido')
    <form class="my-2 border p-5" method="POST" action="{{ route('bikes.store') }}">
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
        <div class="form-group row">
            <div class="form-check mt-3">
                <input id="checkboxMatriculada" name="matriculada" value="1" class="form-check-input" type="checkbox"
                    {{ empty(old('matriculada')) ? '' : 'checked' }}>
                <label for="checkboxMatriculada" class="form-check-label">Matriculada</label>
            </div>
        </div>
        <div class="form-group row">
            <button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
            <button type="reset" class="btn btn-secondary m-2">Borrar</button>
        </div>
        <p>Actualmente hay un total de {{ $total }} motos en el garaje.</p>
    </form>
@endsection

@section('enlaces')
    @parent
    <a href="{{ route('bikes.index') }}" class="btn btn-primary m-2">Garaje</a>
@endsection
