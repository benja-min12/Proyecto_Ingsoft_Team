@extends('layouts.app')

@section('content')

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
            <a class="btn btn-outline-secondary mb-2" href="usuario\resetpassword"> Reiniciar contraseña</a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
                <th class="border-primary" style="width: 10%" scope="col">Rut</th>
                <th class="border-primary" style="width: 25%" scope="col">Nombre</th>
                <th class="border-primary" style="width: 25%" scope="col">Email</th>
                <th class="border-primary" style="width: 20%" scope="col">Rol</th>
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
                <td><a class="btn btn-outline-secondary" href={{ route('usuario.edit', [$usuario]) }}>editar</a></td>
                @if ($usuario->tipo_usuario !== 'Administrador')
                    @if ($usuario->status === 1)
                        <td><a class="btn btn-outline-warning" href={{ route('changeStatus', ['id' => $usuario]) }}>deshabilitar</a></td>
                    @else
                        <td><a class="btn btn-outline-primary" href={{ route('changeStatus', ['id' => $usuario]) }}>habilitar</a></td>
                    @endif
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
