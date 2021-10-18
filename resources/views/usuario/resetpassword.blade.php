@extends('layouts.app')

@section('content')
@if (Auth::user()->tipo_usuario == 'Administrador')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-5">
                <h2>{{ __('Reset Password') }}</h2>
            </div>
            <div class="card border-primary">


                <div class="card-body">
                    <form id="Formulario" method="POST" action="{{ route('ResetPassword') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="rut" class="col-md-4 col-form-label text-md-right">RUT: </label>
                            <div class="col-md-6">
                                <input id="rut" type="text" class="border-primary form-control @error('rut') is-invalid @enderror" name="rut" value="" required autofocus>
                                @error('rut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="boton" type="submit" class="btn btn-outline-secondary">
                                    Restablecer contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
