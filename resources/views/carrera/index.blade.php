@extends('layouts.app')
@if (Auth::user()->tipo_usuario == 'Administrador')
@section('content')
@if (session('success'))
    <script>
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 3000
        })
    </script>
@endif
<div class="container">
    <div class="row mb-4">
        <div class="col col-2 ">
            <form method="GET" action="{{ route('carrera.index') }}">
                <input class="border-primary mr-sm-2 mb-2" type="text" name="search" id="search" placeholder="Buscar por codigo">
                <button class="btn btn-primary mb-2">Buscar</button>
            </form>
        </div>
        <div class="col col-8">
            <h1 class="text-center">Gestión de carreras</h1>
        </div>
        <div class="col col-2">
            <a class="btn btn-primary" href="carrera/create"> Agregar Carrera</a>

        </div>
    </div>
    <table class=" table table-bordered">
        <thead>
            <tr class="table-primary">
                <th class="border-primary" style="width: 10% ;font-size:18px" scope="col">Código</th>
                <th class="border-primary" style="width: 70%;font-size:18px" scope="col">Nombre</th>
                <th class="border-primary" style="width: 20%;font-size:18px" scope="col" colspan="1">Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carreras as $carrera)
            <tr>
                <td class="border-primary" scope="row">{{$carrera->codigo}}</td>
                <td class="border-primary" style="font-size:20px">{{$carrera->nombre}}</td>
                <td class="border-primary"><a class="btn btn-primary" href="{{ route('carrera.edit',$carrera) }}">Editar</a></td>
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
@endif

@endsection
