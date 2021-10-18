@extends('layouts.app')

@section('content')
@if (session()->has('resetPassword'))
    <script>
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: '{{ session()->get('resetPassword') }}',
        showConfirmButton: false,
        timer: 1500
        })
    </script>
@endif
@if (session()->has('edit'))
    <script>
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: '{{ session()->get('edit') }}',
        showConfirmButton: false,
        timer: 1500
        })
    </script>
@endif
@if (session()->has('error'))
    <script>
        Swal.fire({
        position: 'center',
        icon: 'error',
        title: '{{ session()->get('error') }}',
        showConfirmButton: false,
        timer: 1500
        })
    </script>
@endif
@if (Auth::user()->tipo_usuario == 'Administrador')
<div class="container">
    <div class="row mb-3">
        <div class="col col-2">
            <form method="GET" action="{{ route('usuario.index') }}">
                <input class="mb-2" type="text" name="search" id="search" placeholder="Buscar por Rut">
                <button class="btn btn-outline-secondary mb-2">Buscar</button>
            </form>
        </div>
        <div class="col col-8">
            <h1 class="text-center" >Gestión de Usuarios</h1>
        </div>
        <div class="col col-2">
            <a class="btn btn-outline-secondary mb-4" href={{ route('usuario.create') }}> <i class="fas fa-plus"></i> Crear usuario</a>
            <a class="btn btn-outline-secondary mb-2" href={{ route('ResetContrasenia') }}> Reiniciar contraseña</a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
                <th class="border-primary" style="width: 10%" scope="col">Rut</th>
                <th class="border-primary" style="width: 25%" scope="col">Nombre</th>
                <th class="border-primary" style="width: 25%" scope="col">Email</th>
                <th class="border-primary" style="width: 20%" scope="col">Rol</th>
                <th class="border-primary" style="width: 20%" scope="col">Carrera</th>
                <th class="border-primary" style="width: 20%" scope="col" colspan="3">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                <th scope="row">{{$usuario->rut}}</th>
                <td>{{$usuario->name}}</td>
                <td>{{$usuario->email}}</td>
                <td>{{$usuario->tipo_usuario}}</td>
                @if ($usuario->tipo_usuario !== 'Administrador')
                @foreach ($carreras as $carrera )
                    @if ($usuario->carrera_id===$carrera->id)
                        <td>{{$carrera->nombre}}</td>
                    @endif
                @endforeach
                @else
                <td class="text-center">-</td>
                @endif
                @if ($usuario->tipo_usuario !== 'Administrador')
                    @if ($usuario->status === 1)
                        <td><a class="btn btn-outline-warning" href={{ route('changeStatus', ['id' => $usuario]) }}>deshabilitar</a></td>
                    @else
                        <td><a class="btn btn-outline-primary" href={{ route('changeStatus', ['id' => $usuario]) }}>habilitar</a></td>
                    @endif
                    <td><a class="btn btn-outline-secondary" href={{ route('usuario.edit', [$usuario]) }}>editar</a></td>
                @else
                    <td class="text-center">-</td>
                    <td><a class="btn btn-outline-secondary" href={{ route('usuario.edit', [$usuario]) }}>editar</a></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    @if ($usuarios->links())
        <div class="d-flex justify-content-center">
            {!! $usuarios->links() !!}
        </div>
    @endif
</div>
@else
@php
header("Location: /home" );
exit();
@endphp
@endif


@endsection
