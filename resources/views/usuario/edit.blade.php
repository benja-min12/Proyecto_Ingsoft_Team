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
                <h2 class="text-center">EDITAR USUARIO</h2>
            </div>

            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <div class="card border-primary">
                        <div class="card-body">
                            <form method="POST" action={{ route('usuario.update', [$usuario]) }}>
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label">Nombre</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $usuario->name }}" required>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Email</label>
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $usuario->email }}" required>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">RUT</label>
                                    <input id="rut" type="text" readonly class="form-control"name="rut" value="{{ $usuario->rut }}" >

                                    @error('rut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="form-control-label" >Tipo usuario</label>
                                    <input id="tipo"type="text"readonly class="form-control"name="tipo" value="{{ $usuario->tipo_usuario }}" >
                                </div>

                                <div class="form-group">
                                    <label for="form-control-label" >Carrera</label>
                                    <select class="form-control" name="carrera" id="carrera" >
                                        <option value={{$usuario->carrera_id}}>Seleccione carrera</option>
                                        @foreach ($carreras as $carrera)
                                        <option value={{$carrera->id}}>{{$carrera->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12 py-3">
                                    <div class="col-lg-12 text-center">
                                        <button type="submit" class="btn btn-outline-secondary">{{ __('Actualizar') }}</button>
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
        const carreraSelect = document.getElementById('carrera');
        rolSelect.value = {!! json_encode($usuario->rol) !!}
        carreraSelect.value = {!! json_encode($usuario->carrera_id)!!}
        if (rolSelect.value === "Jefe Carrera") {
            carreraSelect.value = null;
            carreraSelect.disabled = true;
        }else{
            carreraSelect.disabled = false;
        }
    </script>

    @else
    @php
    header("Location: /home" );
    exit();
    @endphp
    @endif

    @endsection
