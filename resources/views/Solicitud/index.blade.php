@extends('layouts.app')

@section('content')

@if (session('Crear'))
    <script>
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: '{{ session('Crear') }}',
        showConfirmButton: false,
        timer: 1500
        })
    </script>
@endif

<div class="container">
    <div class="row mb-4">
        <div class="col col-3">
            <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('carrera.index') }}">
                <input class="form-control mr-sm-2 border-primary mb-2" name="search" id="search" type="search"
                    placeholder="Buscar por código" aria-label="Search">
                    <button class="btn btn-primary mb-1">Buscar</button>
            </form>
        </div>
        <div class="col col-7">
            <p class="text-center" style="font-size: x-large">Mis Solicitudes</p>
        </div>
        <div class="col col-2">
            <a class="btn btn-primary btn-block" href="solicitud/create"> <i class="fas fa-plus"></i> Nueva
                Solicitud +</a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
                <th class="border-primary" style="width: 15% ; font-size:18px" scope="col">Fecha Solicitud</th>
                <th class="border-primary" style="width: 10% ; font-size:16px" scope="col">Numero Solicitud</th>
                <th class="border-primary" style="width: 20% ; font-size:18px" scope="col">Tipo Solicitud</th>
                <th class="border-primary" style="width: 10% ; font-size:18px" scope="col">Estado</th>
                <th class="border-primary" style="width: 10% ; font-size:18px" scope="col">Editar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($solicitudes as $solicitud)
            <tr>
                <th class="border-primary" scope="row">{{ $solicitud->getOriginal()['pivot_updated_at'] }}</th>
                <td class="border-primary text-center"  style="font-size:20px">{{ $solicitud->getOriginal()['pivot_id'] }}</td>
                <td class="border-primary"  style="font-size:20px">{{$solicitud->tipo}}</td>
                @switch($solicitud->getOriginal()['pivot_estado'])
                @case(0)
                <td class="border-primary ">
                    <div class="alert alert-warning d-flex align-items-center border-warning" role="alert">
                        <img class="mr-3" style="height: 20px" src="{{asset('images/pendiente.png')}}" alt="pendiente">
                        Pendiente
                    </div>
                </td>
                @break
                @case(1)
                <td class="border-primary">
                    <div class="alert alert-success d-flex align-items-center border-success" role="alert">
                        <img class="mr-3" style="height: 20px" src="{{asset('images/aceptar.png')}}" alt="aceptado">
                        Aceptada
                    </div>
                </td>
                @break
                @case(2)
                <td class="border-primary">
                    <div class="alert alert-success d-flex align-items-center border-success" role="alert">
                        <img class="mr-3" style="height: 20px" src="{{asset('images/Observacion.png')}}" alt="aceptado_observacion">
                        Aceptada con observaciones
                    </div>
                </td>
                @break
                @case(3)
                <td class="border-primary">
                    <div class="alert alert-danger d-flex align-items-center border-danger" role="alert">
                        <img class="mr-3" style="height: 20px" src="{{asset('images/Rechazada.png')}}" alt="Rechazada">
                        Rechazada
                    </div>
                </td>
                @break
                @case(4)
                <td class="border-primary">
                    <div class="alert alert-secondary d-flex align-items-center border-secondary" role="alert">
                        <img class="mr-3" style="height: 20px" src="{{asset('images/alert.png')}}" alt="Anulado">
                        Anulada
                    </div>
                </td>
                @break

                @default

                @endswitch
                <td class="border-primary"><a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="editar" href={{
                        route('solicitud.edit', [$solicitud]) }}>Editar/Anular</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    <p>No hay solicitudes ingresadas</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
