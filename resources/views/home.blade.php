@extends('layouts.master')

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (null === Auth::user()->email_verified_at)
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                            </form>
                        </div>
                    @endif
                @endif
                <div class="card mb-3">
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
                                <div><b>Fecha de nacimiento:</b></div>
                            </div>
                            <div class="col-6">
                                <div>{{ Auth::user()->name }}</div>
                                <div>{{ Auth::user()->email }}</div>
                                <div>{{ Custom::formatDate('es', Auth::user()->created_at) }}</div>
                                <div>{{ Custom::formatDate('es', Auth::user()->birth_date) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h4>Listado de motos</h4>
        @php
            $bikes = Auth::user()->bikes()->where('marca','ppp')->paginate(10);
        @endphp
        <x-listing :bikes="$bikes"></x-listing>

    </h4>
@endsection
