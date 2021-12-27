@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mb-4">
        <div class="col col-2 ">

        </div>

        <div class="col col-7">
            <p class="text-center" style="font-size: x-large">Solicitudes Aceptada</p>
        </div>
        <div class="col col-7">
            <p class="text-center" style="font-size: x-large">Solicitudes Rechazadas</p>
        </div>
        <div class="col col-7">
            <p class="text-center" style="font-size: x-large">Solicitudes Aceptada Con Observaciones</p>
        </div>
        <div class="col col-7">
            <p class="text-center" style="font-size: x-large">Solicitudes Anuladas</p>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Estado solicitudes
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="/resolver-solicitud">Pendientes</a>
              <a class="dropdown-item" href="/resolver-solicitud">Aceptada</a>
              <a class="dropdown-item" href="/resolver-solicitud">Anulada</a>
              <a class="dropdown-item" href="/resolver-solicitud">Rechazada</a>
              <a class="dropdown-item" href="/resolver-solicitud">Aceptada con observaciones</a>
            </div>
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
            @forelse ($alumnos as $alumno)
                @forelse ($alumno->solicitudesActivas as $solicitud )
            <tr>
                <td class="border-primary" style="font-size:16px">{{$solicitud->getOriginal()['pivot_updated_at'] }}</td>
                <td class="border-primary" style="font-size:16px">{{$solicitud->getOriginal()['pivot_id'] }}</td>
                <td class="border-primary" style="font-size:16px">{{$alumno->rut }}</td>
                <td class="border-primary" style="font-size:16px">{{$alumno->name }}</td>
                <td class="border-primary" style="font-size:16px">{{$solicitud->tipo}}</td>
                <td class="border-primary" style="font-size:16px"><a class="btn btn-warnirg btn-block" title="editar" href={{
                    route('resolver-solicitud.edit',$solicitud->getOriginal() ['pivot_id']) }}> <i class="fas fa-eye"></i> Ver</a></td>
            <tr>
                @empty
                @endforelse
            @empty
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection
