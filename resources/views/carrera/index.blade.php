@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col col-2">
            <form method="GET" action="{{ route('carrera.index') }}">
                <input class="mb-2" type="text" name="search" id="search" placeholder="Buscar por codigo">
                <button class="btn btn-outline-primary mb-2">Buscar</button>
            </form>
        </div>
        <div class="col col-8">
            <h1 class="text-center" style="font-size: x-large">Gestión de carreras</h1>
        </div>
        <div class="col col-2">
            <a class="btn btn-outline-primary" href="carrera/create"> Carrera +</a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 10%" scope="col">Código</th>
                <th style="width: 70%" scope="col">Nombre</th>
                <th style="width: 20%" scope="col" colspan="1">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carreras as $carrera)
            <tr>
                <td scope="row">{{$carrera->codigo}}</td>
                <td style="font-size: 20px">{{$carrera->nombre}}</td>
                <td><a class="btn btn-outline-secondary" href="{{ route('carrera.edit',$carrera) }}">Editar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if ($carreras->links())
        <div class="d-flex justify-content-center">
            {!! $carreras->links() !!}
        </div>
    @endif

</div>

@endsection
