@extends('layouts.app')

@section('content')
@if (session('success'))
    <script>
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 1500
        })
    </script>
@endif
<div class="container">
    <div class="row mb-4">
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
    <table class=" table table-bordered">
        <thead>
            <tr class="table-primary">
                <th class="border-primary" style="width: 10%" scope="col">Código</th>
                <th class="border-primary" style="width: 70%" scope="col">Nombre</th>
                <th class="border-primary" style="width: 20%" scope="col" colspan="1">Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carreras as $carrera)
            <tr>
                <td class="border-primary" scope="row">{{$carrera->codigo}}</td>
                <td class="border-primary" style="font-size: 20px">{{$carrera->nombre}}</td>
                <td class="border-primary"><a class="btn btn-outline-secondary" href="{{ route('carrera.edit',$carrera) }}">Editar</a></td>
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
