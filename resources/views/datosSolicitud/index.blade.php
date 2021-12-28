@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-3"></div>
        <div class="col col-7">
            <p class="text-center" style="font-size: x-large">Solicitud N.º {{$solicitud->getOriginal()['pivot_id']}} </p>
            <p class="text-center" style="font-size: x-large">Tipo: {{ $solicitud->getOriginal()['tipo'] }}</p>
        </div>
    </div>
    <div hidden>
        <input id="tipo" type="text" value={{ $solicitud->getOriginal()['tipo'] }}>
    </div>

    <div class="row-12">
        <div class="col-lg-3 col-md-2"></div>
                <div class="row">
                    <table class="table table-bordered table-sm mt-5">
                        <thead>
                            <th id="telefono" class="table-primary border-primary" style="width: 10%">Teléfono:</th>
                            <th class="table-primary border-primary" style="width: 7%">Estado:</th>
                            <th  id="NRC"class="table-primary border-primary" style="width: 5%">NRC:</th>
                            <th  id="Asignatura" class="table-primary border-primary" style="width: 10%">Asignatura:</th>
                            <th  id="calificacion"class="table-primary border-primary" style="width: 5%">calificación Aprobación:</th >
                            <th  id="nombre"class="table-primary border-primary" style="width: 10%">Nombre Profesor</th>
                            <th  id="facilidad"class="table-primary border-primary" style="width: 10%">Facilidad Académica</th>
                            <th  id="archivos"class="table-primary border-primary" style="width: 15%">Archivos:</th>
                            <th  id="ayudantia"class="table-primary border-primary" style="width: 5%">Cantidad ayudantías:</th>
                            <th  id="detalles"class="table-primary border-primary" style="width: 30%">Detalles:</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-primary" id="groupTelefono">{{ $solicitud->getOriginal()['pivot_telefono'] }}</td>
                                @switch($solicitud->getOriginal()['pivot_estado'])
                                @case(0)
                                <td class="border-primary">
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
                                <td class="border-primary" id="groupNrc">{{ $solicitud->getOriginal()['pivot_NRC'] }}</td>
                                <td class="border-primary" id="groupNombre" >{{ $solicitud->getOriginal()['pivot_nombre_asignatura'] }}</td>
                                <td class="border-primary"  id="groupCalificacion" >{{$solicitud->getOriginal()['pivot_calificacion_aprob']}}</td>
                                <td class="border-primary" id="groupProfesor" >{{$solicitud->getOriginal()['pivot_nombre_profesor']}}</td>
                                <td class="border-primary" id="groupTipoFacilidad" >{{$solicitud->getOriginal()['pivot_tipo_facilidad']}}</td>
                                <td class="border-primary" id="groupAdjunto" >
                                    @if ($solicitud->getOriginal()['pivot_archivos'])
                                    @foreach (json_decode($solicitud->getOriginal()['pivot_archivos']) as $file)
                                        <a href="{{asset('storage/docs/'.$file)}}">Archivo</a>
                                    @endforeach
                                @endif
                                </td>
                                <td class="border-primary" id="groupCantidad" >{{$solicitud->getOriginal()['pivot_cant_ayudantias']}}</td>
                                <td class="border-primary" id="groupDetalles" >{{$solicitud->getOriginal()['pivot_detalles']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

    </div>
    <div class="col-lg-3 col-md-2"></div>
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-6 mt-3 login-box">
                <div class="col-12">
                    <div class="login-title"> <h4>SOLICITUDES</h4> </div>
                    <table class="table table-bordered table-hover table-sm">
                        <thead class=" table-primary">
                            <th scope="col">Nombre</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Ver</th>
                        </thead>
                        <tbody>
                            @forelse ($user->solicitudes as $solicitud)
                            <tr>
                                <td>{{$solicitud->getOriginal()['pivot_id']}}</td>
                                <td>{{$solicitud->getOriginal()['pivot_updated_at']}}</td>
                                <td>{{$solicitud->getOriginal()['tipo']}}</td>
                                <td><a class="btn btn-primary" href={{ route('verSolicitudAlumno',
                                        ['id'=>$solicitud->getOriginal()['pivot_id'], 'alumno_id' => $user->id])
                                        }}>Ver</a></td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <p>Sin Solicitudes</p>
                                </td>
                            </tr>

                            @endforelse
                        </tbody>
                    </table>
                    <div class="mx-auto ">
                        <a  href="/buscar-estudiante " class="btn btn-block btn-primary">Buscar nuevo estudiante</a>
                    </div>
                </div>

            </div>


            <div class="col-lg-3 col-md-2"></div>

    </div>

</div>
<script type="text/javascript">
    var Solicitud = document.getElementById('tipo');
    const inputNrc = document.getElementById('groupNrc');
    const nrc=document.getElementById('NRC');
    const inputNombre = document.getElementById('groupNombre');
    const Asignatura=document.getElementById('Asignatura');
    const inputDetalles = document.getElementById('groupDetalles');
    const detalles=document.getElementById('detalles');
    const inputCalificacion = document.getElementById('groupCalificacion');
    const calificacion=document.getElementById('calificacion');
    const inputCantidad = document.getElementById('groupCantidad');
    const cantidad=document.getElementById('ayudantia');
    const inputTipoFacilidad = document.getElementById('groupTipoFacilidad');
    const tipoFacilidad=document.getElementById('tipoFacilidad');
    const inputProfesor = document.getElementById('groupProfesor');
    const profesor=document.getElementById('nombre');
    const inputAdjunto = document.getElementById('groupAdjunto');
    const adjunto=document.getElementById('archivos');
    const facilidad=document.getElementById('facilidad');
    this.addEventListener('load', () => {
        if(Solicitud.value == "Cambio"||Solicitud.value == "Sobrecupo"||Solicitud.value == "Inscripción"||Solicitud.value == "Eliminación"){
            inputCalificacion.style.display = "none";
            inputCantidad.style.display = "none";
            inputProfesor.style.display = "none";
            inputAdjunto.style.display = "none";
            calificacion.style.display = "none";
            profesor.style.display = "none";
            adjunto.style.display = "none";
            cantidad.style.display = "none";
            inputTipoFacilidad.style.display = "none";
            facilidad.style.display = "none";
        }
        if(Solicitud.value == "Ayudantía"){
            nrc.style.display = "none";
            inputNrc.style.display = "none";
            profesor.style.display = "none";
            inputProfesor.style.display = "none";
            inputAdjunto.style.display = "none";
            adjunto.style.display = "none";
            inputTipoFacilidad.style.display = "none";
            facilidad.style.display = "none";
            detalles.innerHTML = "Motivos para ser ayudante";
        }
        if(Solicitud.value == "Facilidades"){
            nrc.style.display = "none";
            inputNrc.style.display = "none";
            inputCalificacion.style.display = "none";
            calificacion.style.display = "none";
            inputCantidad.style.display = "none";
            cantidad.style.display = "none";
        }

    })


</script>

@endsection
