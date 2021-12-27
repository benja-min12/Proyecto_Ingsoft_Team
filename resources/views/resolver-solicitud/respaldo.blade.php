@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-4">
        <div class="col col-2 ">

        </div>

        <div class="col col-7">
            <p class="text-center" style="font-size: x-large">Registro de solicitudes</p>
        </div>
        <div class="col col-2 ">
            <form method="GET" action="{{ route('resolver-solicitud.index') }}">
                <select class="form-control" name="resolverSolicitud" id="resolverSolicitud">
                    <option value ="0" >Pendientes</option>
                    <option value="1">Aceptadas</option>
                    <option value="2">Aceptadas con observaciones</option>
                    <option value="3">Rechazadas</option>
                    <option value="4">Anuladas</option>
                </select>
                <button class="btn btn-primary mb-2">Buscar</button>
            </form>
        </div>
    </div>
    <div>
    <table class="table table-bordered border-primary">
        <thead>
            <tr class="table-primary">
                <th class="border-primary" style="width: 15% ; font-size:18px" scope="col">Fecha Solicitud</th>
                <th class="border-primary" style="width: 10% ; font-size:16px" scope="col">Numero Solicitud</th>
                <th class="border-primary" style="width: 10% ; font-size:18px" scope="col">Rut Estudiante</th>
                <th class="border-primary" style="width: 10% ; font-size:18px" scope="col">Nombre Estudiante</th>
                <th class="border-primary" style="width: 10% ; font-size:18px" scope="col">Tipo Solicitud</th>
                <th class="border-primary" style="width: 10% ; font-size:18px" scope="col">Ver</th>
            </tr>
        </thead>
        <tbody>
            @if (request()->resolverSolicitud == 0)
            @foreach ($alumnos as $alumno)
            @forelse ($alumno->solicitudesActivas as $solicitud)
            <tr>
                <td class="border-primary" style="font-size:16px">{{$solicitud->getOriginal()['pivot_updated_at'] }}</td>
                <td class="border-primary" style="font-size:16px">{{$solicitud->getOriginal()['pivot_id'] }}</td>
                <td class="border-primary" style="font-size:16px">{{$alumno->rut }}</td>
                <td class="border-primary" style="font-size:16px">{{$alumno->name }}</td>
                <td class="border-primary" style="font-size:16px">{{$solicitud->tipo}}</td>
                <td class="border-primary" style="font-size:16px">

                <a class="btn btn-warning btn-block" title="editar" href={{
                    route('resolver-solicitud.edit',$solicitud->getOriginal() ['pivot_id']) }}><img style="height: 20px" src="{{asset('images/pendiente.png')}}" alt="pendiente"> <i class="fas fa-eye"></i> Resolver</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay solicitudes pendientes</td>
            </tr>
            @endforelse
            @endforeach
            @endif
            @if (request()->resolverSolicitud == 1)
            @foreach ($alumnos as $alumno)
            @forelse ($alumno->solicitudesAceptadas as $solicitud)
            <tr>
                <td class="border-primary" style="font-size:16px">{{$solicitud->getOriginal()['pivot_updated_at'] }}</td>
                <td class="border-primary" style="font-size:16px">{{$solicitud->getOriginal()['pivot_id'] }}</td>
                <td class="border-primary" style="font-size:16px">{{$alumno->rut }}</td>
                <td class="border-primary" style="font-size:16px">{{$alumno->name }}</td>
                <td class="border-primary" style="font-size:16px">{{$solicitud->tipo}}</td>
                <td class="border-primary" style="font-size:16px">
                    <div class="alert alert-success d-flex align-items-center border-success" role="alert">
                        <img class="mr-3" style="height: 20px" src="{{asset('images/aceptar.png')}}" alt="aceptado">
                        Aceptada
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay solicitudes aceptadas</td>
            </tr>
            @endforelse
            @endforeach
            @endif
            @if (request()->resolverSolicitud == 2)
            @foreach ($alumnos as $alumno)
            @forelse ($alumno->solicitudesAceptadasObservaciones as $solicitud)
            <tr>
                <td class="border-primary" style="font-size:16px">{{$solicitud->getOriginal()['pivot_updated_at'] }}</td>
                <td class="border-primary" style="font-size:16px">{{$solicitud->getOriginal()['pivot_id'] }}</td>
                <td class="border-primary" style="font-size:16px">{{$alumno->rut }}</td>
                <td class="border-primary" style="font-size:16px">{{$alumno->name }}</td>
                <td class="border-primary" style="font-size:16px">{{$solicitud->tipo}}</td>
                <td class="border-primary" style="font-size:16px">
                    <div class="alert alert-success d-flex align-items-center border-success" role="alert">
                        <img class="mr-3" style="height: 20px" src="{{asset('images/Observacion.png')}}" alt="aceptado_observacion">
                        Aceptada con observaciones
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay solicitudes aceptadas con observaciones</td>
            </tr>
            @endforelse
            @endforeach
            @endif

            @if (request()->resolverSolicitud == 3)
            @foreach ($alumnos as $alumno)
            @forelse ($alumno->solicitudesRechazadas as $solicitud)
            <tr>
                <td class="border-primary" style="font-size:16px">{{$solicitud->getOriginal()['pivot_updated_at'] }}</td>
                <td class="border-primary" style="font-size:16px">{{$solicitud->getOriginal()['pivot_id'] }}</td>
                <td class="border-primary" style="font-size:16px">{{$alumno->rut }}</td>
                <td class="border-primary" style="font-size:16px">{{$alumno->name }}</td>
                <td class="border-primary" style="font-size:16px">{{$solicitud->tipo}}</td>
                <td class="border-primary" style="font-size:16px">
                    <div class="alert alert-danger d-flex align-items-center border-danger" role="alert">
                        <img class="mr-3" style="height: 20px" src="{{asset('images/Rechazada.png')}}" alt="Rechazada">
                        Rechazada
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay solicitudes rechazadas</td>
            </tr>
            @endforelse
            @endforeach
            @endif
            @if (request()->resolverSolicitud == 4)
                @forelse ($alumnos as $alumno)
                @forelse($alumno->solicitudesAnuladas as $solicitud)
                <tr>
                    <td class="border-primary" style="font-size:16px">{{$solicitud->getOriginal()['pivot_updated_at'] }}</td>
                    <td class="border-primary" style="font-size:16px">{{$solicitud->getOriginal()['pivot_id'] }}</td>
                    <td class="border-primary" style="font-size:16px">{{$alumno->rut }}</td>
                    <td class="border-primary" style="font-size:16px">{{$alumno->name }}</td>
                    <td class="border-primary" style="font-size:16px">{{$solicitud->tipo}}</td>
                    <td class="border-primary" style="font-size:16px">
                        <div class="alert alert-secondary d-flex align-items-center border-secondary" role="alert">
                            <img class="mr-3" style="height: 20px" src="{{asset('images/alert.png')}}" alt="Anulado">
                            Anulada
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No hay solicitudes anuladas</td>
                </tr>
                @endforelse
                @empty
                @endforelse
            @endif
        </tbody>
    </table>
    </div>
</div>
@endsection
