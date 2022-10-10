@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2 class="">Información del usuario</h2>
                    <div class="row">
                        <div class="col-6">
                            <div><b>Nombre:</b></div>
                            <div><b>Email:</b></div>
                            <div><b>Fecha de alta:</b></div>
                        </div>
                        <div class="col-6">
                            <div>{{ Auth::user()->name }}</div>
                            <div>{{ Auth::user()->email }}</div>
                            <div>{{ Auth::user()->created_at }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
