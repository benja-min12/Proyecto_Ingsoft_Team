@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-5">
                <h2>{{ __('Reset Password') }}</h2>
            </div>
            <div class="card border-primary">


                <div class="card-body">
                    <form method="POST" action="{{ route('changePassword') }}">
                        @csrf
                        <input id="id" type="text" readonly class="form-control" name="id" value="{{ $user->id }}" required hidden>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">RUT: </label>

                            <div class="col-md-6">
                                <input id="rut" type="text" readonly class="border-primary form-control" name="rut" value="{{ $user->rut }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Nueva Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="border-primary form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar Nueva Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="border-primary form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-outline-secondary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
