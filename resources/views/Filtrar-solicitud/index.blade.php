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
@if (session('Error'))
    <script>
        Swal.fire({
        position: 'center',
        icon: 'error',
        title: '{{ session('Error') }}',
        showConfirmButton: false,
        timer: 1500
        })
    </script>
@endif

<div class="container">

    <div class="row mb-4">
        <div class="col col-2 ">
        </div>
        <div class="col col-7">
            <p class="text-center" style="font-size: x-large">Solicitudes disponibles</p>
        </div>
        <div class="px-4 ml-3">
            <div class="card border-primary ">
                <div class="card-body">
                    <form action="">
                        <label for="form-control-label" >TIPO SOLICITUD</label>
                            <select class="form-control mb-3" name="searchTipo" id="searchTipo">
                                <option value={{ null }}>Seleccione..</option>
                                <option value="1">Solicitud de Sobrecupo</option>
                                <option value="2">Solicitud Cambio de Paralelo</option>
                                <option value="3">Solicitud Eliminación de Asignatura</option>
                                <option value="4">Solicitud Inscripción de Asignatura</option>
                                <option value="5">Solicitud Ayudantía</option>
                                <option value="6">Solicitud Facilidades Académicas</option>
                            </select>
                                <div id="groupButton" class="col-lg-12">
                                    <div class="text-center">
                                        <button id="boton" class="btn btn-primary">Buscar por tipo</button>
                                    </div>
                                </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="px-4 ml-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <div class="col col-2 ml-5">
                            <form method="GET" action="{{ route('Filtrar-solicitud.index') }}">
                                <label for="form-control-label" >Numero Solicitud</label>
                                <input class="border-primary mr-sm-2 mb-2" type="text" name="searchID" id="searchID"
                                placeholder="Buscar por numero">
                                <button class="btn btn-primary mb-2">Buscar</button>
                            </form>
                        </div>
                    </div>
                </div>
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
                <th class="border-primary" style="width: 10% ; font-size:18px" scope="col">Anular</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($usuarios as $usuario)
                @forelse ($usuario->solicitudes as $solicitud )
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
                @if ($solicitud->getOriginal() ['pivot_estado'] === 0)
                    <td class="border-primary"><a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="editar" href={{
                            route('solicitud.edit',$solicitud->getOriginal() ['pivot_id']) }}>Editar</a></td>
                @else
                    <td class="border-primary"><a class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="editar">Editar</a></td>
                @endif

                    @if ($solicitud->getOriginal() ['pivot_estado'] === 0)
                    <td class="border-primary"><a class="btn btn-warning" href={{ route('changeStatusSolicitud', ['id' => $solicitud->getOriginal() ['pivot_id']]) }}>Anular</a></td>
                @else
                    <td class="border-primary"><a class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="anular">Anular</a></td>
                @endif

                </tr>
                @empty
                @endforelse
                @empty
                @endforelse


        </tbody>
    </table>

</div>

@endsection
