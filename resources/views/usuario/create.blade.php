@extends('layouts.app')

@section('content')

@if (Auth::user()->tipo_usuario == 'Administrador')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-8 login-box">
            <div class="col-lg-12 login-key">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="col-lg-12 login-title">
                <h2>CREAR USUARIO</h2>
            </div>

            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <div class="card border-primary">
                        <div class="card-body">
                            <form method="POST" action="{{ route('usuario.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label">Nombre</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Email</label>
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">RUT</label>
                                    <input id="rut" type="text" class="form-control @error('rut') is-invalid @enderror"
                                        name="rut" value="{{ old('rut') }}" required autocomplete="rut">

                                    @error('rut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="form-control-label">Tipo usuario</label>
                                    <select class="form-control @error('tipo_usuario') is-invalid @enderror" name="tipo_usuario" id="tipo_usuario"required>
                                        <option value={{null}}>Seleccione tipo de usuario</option>
                                        <option value="Jefe Carrera">Jefe de Carrera</option>
                                        <option value="Alumno">Alumno</option>
                                    </select>
                                    @error('tipo_usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="form-control-label" >Carrera</label>
                                    <select class="form-control @error('carrera') is-invalid @enderror" name="carrera" id="carrera"required >
                                        <option value={{null}}>Seleccione carrera</option>
                                        @foreach ($carreras as $carrera)
                                        <option value={{$carrera->id}}>{{$carrera->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-12 py-3">
                                    <div class="col-lg-12 text-center">
                                        <button type="submit" class="btn btn-outline-secondary">{{ __('Register') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
    </div>
    <script>
        const rolSelect = document.getElementById('rol');
        const carreraSelect = document.getElementById('carrera')
        //variable de carreras desde el controlador de carreras
        const listaCarreras = {!! json_encode($carreras) !!}
        if (listaCarreras.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                confirmButtonColor: '#48A24C',
                text: 'No puede crear usuarios sin tener carreras en el sistema!',
                footer: 'Para crear carreras has&nbsp;<a href="/carrera/create">click aca</a>'
            }).then((result) => {
                window.location.href = '/usuario'
            })
        }
    </script>

    @else
    @php
    header("Location: /home" );
    exit();
    @endphp
    @endif

    @endsection
