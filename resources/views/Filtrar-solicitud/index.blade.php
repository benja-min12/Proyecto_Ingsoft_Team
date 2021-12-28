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
    <div class="text-center">
        <p class="text-center" style="font-size: x-large">Solicitudes disponibles</p>
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="card border-primary " style="width:50%">
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
        <div>
            <div class="col mb-3">
                <div class="card border-primary" style='width:60%'>
                    <div class="card-body">
                        <form method="GET" action="{{ route('Filtrar-solicitud.index') }}">
                            <label for="form-control-label" >Número Solicitud</label>
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
                <th class="border-primary" style="width: 20% ; font-size:18px" scope="col">Fecha Solicitud</th>
                <th class="border-primary" style="width: 10% ; font-size:16px" scope="col">Número Solicitud</th>
                <th class="border-primary" style="width: 20% ; font-size:18px" scope="col">Tipo Solicitud</th>
                <th class="border-primary" style="width: 10% ; font-size:18px" scope="col">Rut estudiante</th>
                <th class="border-primary" style="width: 10% ; font-size:18px" scope="col">Nombre estudiante</th>
                <th class="border-primary" style="width: 10% ; font-size:18px" scope="col">Correo estudiante</th>
                <th class="border-primary" style="width: 10% ; font-size:18px" scope="col">Teléfono</th>
                <th class="border-primary" style="width: 50% ; font-size:20px" scope="col">Ver detalles</th>
                <th class="border-primary" style="width: 10% ; font-size:18px" scope="col">Resolver</th>

            </tr>
        </thead>
        <tbody>

            @forelse ($usuarios as $usuario)
                @forelse ($usuario->solicitudes as $solicitud )
                <tr>
                    <th class="border-primary" style="font-size:20px" scope="row">{{ $solicitud->getOriginal()['pivot_updated_at'] }}</th>
                    <td class="border-primary text-center"  style="font-size:20px">{{ $solicitud->getOriginal()['pivot_id'] }}</td>
                    <td class="border-primary"  style="font-size:20px">{{$solicitud->tipo}}</td>
                    <td class="border-primary"  style="font-size:20px">{{$usuario->rut}}</td>
                    <td class="border-primary"  style="font-size:20px">{{$usuario->name}}</td>
                    <td class="border-primary"  style="font-size:20px">{{$usuario->email}}</td>
                    <td class="border-primary"  style="font-size:20px">{{$solicitud->getOriginal()['pivot_telefono']}}</td>
                    @if ($solicitud->id == 1 || $solicitud->id == 2 || $solicitud->id == 3 || $solicitud->id == 4)
                        <td class="border-primary">
                            <div class="dropdown" style="width: 200px ">
                                <button class="btn btn-primary dropdown-toggle" style="width: 200px " type="button" id="menu1" data-toggle="dropdown">Detalles
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li role="presentation">NRC asignatura: {{$solicitud->getOriginal()['pivot_NRC']}}</li>
                                    <li role="presentation">Nombre Asignatura: {{$solicitud->getOriginal()['pivot_nombre_asignatura']}}</li>
                                    <li role="presentation">Detalles solicitud: {{$solicitud->getOriginal()['pivot_detalles']}}</li>
                                </ul>
                            </div>
                        </td>
                    @endif
                    @if ($solicitud->id == 6)
                    <td class="border-primary">
                        <div class="dropdown" style="width: 200px ">
                            <button class="btn btn-primary dropdown-toggle" style="width: 200px " type="button" id="menu1" data-toggle="dropdown">Detalles
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li role="presentation">Nombre Asignatura: {{$solicitud->getOriginal()['pivot_nombre_asignatura']}}</li>
                                <li role="presentation">Tipo facilidad : {{$solicitud->getOriginal()['pivot_tipo_facilidad']}}</li>
                                <li role="presentation">Nombre profesor: {{$solicitud->getOriginal()['pivot_nombre_profesor']}}</li>
                                <li role="presentation">Archivos Adjuntos:</li>
                                @if ($solicitud->getOriginal()['pivot_archivos'])
                                @foreach (json_decode($solicitud->getOriginal()['pivot_archivos']) as $file)
                                    <a href="{{asset('storage/docs/'.$file)}}">Archivo</a>
                                @endforeach
                                <li role="presentation">Detalles solicitud: {{$solicitud->getOriginal()['pivot_detalles']}}</li>
                                @endif
                            </ul>
                        </div>
                    </td>

                    @endif
                    @if ($solicitud->id == 5)
                    <td class="border-primary" >
                        <div class="dropdown" style="width: 200px ">
                            <button class="btn btn-primary dropdown-toggle" style="width: 200px " type="button" id="menu1" data-toggle="dropdown">Detalles
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li role="presentation">Nombre Asignatura: {{$solicitud->getOriginal()['pivot_nombre_asignatura']}}</li>
                                <li role="presentation">Calificación : {{$solicitud->getOriginal()['pivot_calificacion_aprob']}}</li>
                                <li role="presentation">Cantidad ayudantías: {{$solicitud->getOriginal()['pivot_cant_ayudantias']}}</li>
                                <li role="presentation">Motivos: {{$solicitud->getOriginal()['pivot_detalles']}}</li>
                            </ul>
                        </div>
                    </td>
                @endif
                <td class="border-primary"><a class="btn btn-warning" href={{ route('resolver-solicitud.edit',$solicitud->getOriginal() ['pivot_id']) }}>Resolver</a></td>

                </tr>
                @empty
                @endforelse
                @empty
                @endforelse
                @if ($cantSolicitudes==0)
                    <tr>
                        <td colspan="9" class="text-center">No hay solicitudes por resolver</td>
                    </tr>
                @endif
        </tbody>
    </table>

</div>

@endsection
