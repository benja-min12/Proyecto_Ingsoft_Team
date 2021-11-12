@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-8 login-box">
            <div class="col-lg-12 login-key">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="text-center mb-5">
                <h2>EDITAR CARRERA</h2>
            </div>
            <div class="card border-primary">

                <div class="card-body">
                    <div class="col-lg-12 login-form">
                        <div class="col-lg-12 login-form">
                            <form method="POST" action="{{ route('carrera.update',$carrera) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="form-control-label">CÓDIGO</label>
                                    <input value={{$carrera->codigo}} id="codigo" type="text" readonly class="form-control" name="codigo" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">NOMBRE</label>
                                    <input value="{{$carrera->nombre}}" id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        name="nombre" required autofocus>
                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 py-3">
                                    <div class="col-lg-12 text-center">
                                        <button type="submit" class="btn btn-primary">{{ __('Editar') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-2"></div>
                </div>
            </div>
                </div>
            </div>


@endsection
