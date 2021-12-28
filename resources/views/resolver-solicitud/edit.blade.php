@extends('layouts.app')

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
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-8 login-box">
            <div class="col-lg-12 login-key">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="text-center mb-5">
                <h2>RESOLVER SOLICITUD</h2>
            </div>
            <div class="card border-primary">
                <div class="card-body">
                    <div class="col-lg-12 login-form">
                        <div class="col-lg-12 login-form">
                            <form id="formulario" method="POST" action="{{ route('resolver-solicitud.update',$solicitud) }}"
                            enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="form-control-label">FECHA DE SOLICITUD</label>
                                    <input value={{$solicitud->getOriginal()['pivot_updated_at']}} id="fecha_solicitud" type="text" readonly class="form-control" name="fecha_solicitud" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">NÚMERO DE LA SOLICITUD</label>
                                    <input value={{$solicitud->getOriginal()['pivot_id']}} id="id_solicitud" type="text" readonly class="form-control" name="id_solicitud" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">RUT DEL ESTUDIANTE</label>
                                    <input value={{$alumno->rut}} id="rut" type="text" readonly class="form-control" name="rut" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">NOMBRE DEL ESTUDIANTE</label>
                                    <input value={{$alumno->name}} id="nombre" type="text" readonly class="form-control" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">CORREO DEL ESTUDIANTE</label>
                                    <input value={{$alumno->email}} id="nombre" type="text" readonly class="form-control" name="nombre" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">TIPO SOLICITUD</label>
                                    <input value={{$solicitud->tipo}} id="tipo" type="text" readonly class="form-control @error('tipo') is-invalid @enderror"
                                        name="tipo" required autofocus>
                                    @error('tipo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" hidden >
                                    <label class="form-control-label">TIPO SOLICITUD</label>
                                    <input value={{$solicitud->id}} id="id" type="text" readonly class="form-control @error('tipo') is-invalid @enderror"
                                        name="id" required autofocus>
                                    @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" id="groupTelefono" hidden>
                                    <label class="form-control-label">TELÉFONO CONTACTO</label>
                                    <input id="telefono" type="text" readonly
                                        class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                        value="{{$solicitud->getOriginal()['pivot_telefono']}}" autocomplete="telefono" autofocus>

                                    @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" id="groupNrc" hidden>
                                    <label class="form-control-label">NRC ASIGNATURA</label>
                                    <input id="nrc" type="text" readonly class="form-control @error('nrc') is-invalid @enderror"
                                        name="nrc" value="{{$solicitud->getOriginal()['pivot_NRC'] }}" autocomplete="nrc" autofocus>

                                    @error('nrc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" id="groupNombre" hidden>
                                    <label class="form-control-label">NOMBRE ASIGNATURA</label>
                                    <input id="nombre" type="text" readonly class="form-control @error('nombre') is-invalid @enderror"
                                        name="nombre" value="{{$solicitud->getOriginal()['pivot_nombre_asignatura']}}" autocomplete="nombre" autofocus>

                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" id="groupCalificacion" hidden>
                                    <label class="form-control-label">CALIFICACIÓN DE APROBACIÓN</label>
                                    <input id="calificacion" type="text"
                                        readonly class="form-control @error('calificacion') is-invalid @enderror" name="calificacion"
                                        value="{{$solicitud->getOriginal()['pivot_calificacion_aprob']}}" autocomplete="calificacion" placeholder="Ej. 6.8"
                                        autofocus>

                                    @error('calificacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" id="groupCantidad" hidden>
                                    <label class="form-control-label">CANTIDAD DE AYUDANTÍAS REALIZADAS</label>
                                    <input id="cantidad" type="text"
                                        readonly class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"
                                        value="{{$solicitud->getOriginal()['pivot_cant_ayudantias']}}"
                                        placeholder="Ej. 2, ingrese 0 en caso no haber realizado antes ayudantias"
                                        autocomplete="cantidad" autofocus>

                                    @error('cantidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" id="groupTipoFacilidad" hidden>
                                    <label class="form-control-label" style="color: black">TIPO DE FACILIDAD</label>
                                    <input id="facilidad" type="text"
                                    readonly class="form-control @error('facilidad') is-invalid @enderror" name="facilidad"
                                    value="{{$solicitud->getOriginal()['pivot_tipo_facilidad']}}"autofocus>

                                </div>

                                <div class="form-group" id="groupProfesor" hidden>
                                    <label class="form-control-label">NOMBRE PROFESOR</label>
                                    <input id="profesor" type="text"
                                        readonly class="form-control @error('profesor') is-invalid @enderror" name="profesor"
                                        value="{{$solicitud->getOriginal()['pivot_nombre_profesor']}}" autocomplete="profesor" autofocus>

                                    @error('profesor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" id="groupAdjunto" hidden>
                                    <label class="form-control-label">ARCHIVOS ADJUNTADOS</label>
                                    @if ($solicitud->getOriginal()['pivot_archivos'])
                                        @foreach (json_decode($solicitud->getOriginal()['pivot_archivos']) as $file)
                                            <a href="{{asset('storage/docs/'.$file)}}">Archivo</a>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group" id="groupDetalles" hidden>
                                    <label class="form-control-label">DETALLES DE LA SOLICITUD</label>
                                    <textarea input id="detalle" type="text"
                                        readonly class="form-control @error('detalle') is-invalid @enderror" name="detalle" >{{$solicitud->getOriginal()['pivot_detalles']}}</textarea>

                                    @error('detalle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label text-center"  >RESOLVER SOLICITUD</label>
                                    <select class="form-control" name="resolverSolicitud" id="resolverSolicitud">
                                        <option value={{$solicitud->getOriginal()['pivot_estado']}}{{$solicitud->getOriginal()['pivot_estado']}}>Seleccione..</option>
                                        <option value="1">Aceptar solicitud</option>
                                        <option value="2">Aceptar con observaciones</option>
                                        <option value="3">Rechazar la solicitud</option>
                                    </select>
                                    <div class="form-group" id="groupObservacionSolicitud" hidden>
                                        <label id="labelobservacionSolicitud" class="form-control-label">OBSERVACIÓN DE SOLICITUD</label>
                                        <textarea id="observacionSolicitud" type="text"
                                            class="form-control @error('observacionSolicitud') is-invalid @enderror" name="observacionSolicitud"
                                            value="{{ old('observacionSolicitud') }}" autocomplete="observacionSolicitud" autofocus></textarea>

                                        @error('observacionSolicitud')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 py-3" id="groupButton" hidden>
                                        <div class="col-lg-12 text-center">
                                            <button id="button" class="btn btn-primary">{{ __('Resolver') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-2"></div>
                </div>
            </div>
                </div>
            </div>







            <script type="text/javascript">
                const form = document.getElementById('formulario');
                const tipoSolicitud = document.getElementById('id');
                const inputTelefono = document.getElementById('groupTelefono');
                const inputNrc = document.getElementById('groupNrc');
                const inputNombre = document.getElementById('groupNombre');
                const inputDetalles = document.getElementById('groupDetalles');
                const inputCalificacion = document.getElementById('groupCalificacion');
                const inputCantidad = document.getElementById('groupCantidad');
                const inputTipoFacilidad = document.getElementById('groupTipoFacilidad');
                const inputProfesor = document.getElementById('groupProfesor');
                const inputAdjunto = document.getElementById('groupAdjunto');
                    switch (tipoSolicitud.value) {
                        case "1":
                            inputTelefono.hidden = false;
                            inputNrc.hidden = false;
                            inputNombre.hidden = false;
                            inputDetalles.hidden = false;
                            inputCalificacion.hidden = true;
                            inputCantidad.hidden = true;
                            inputTipoFacilidad.hidden = true;
                            inputProfesor.hidden = true;
                            inputAdjunto.hidden = true;

                            break;
                        case "2":
                            inputTelefono.hidden = false;
                            inputNrc.hidden = false;
                            inputNombre.hidden = false;
                            inputDetalles.hidden = false;
                            inputCalificacion.hidden = true;
                            inputCantidad.hidden = true;
                            inputTipoFacilidad.hidden = true;
                            inputProfesor.hidden = true;
                            inputAdjunto.hidden = true;

                            break;
                        case "3":
                            inputTelefono.hidden = false;
                            inputNrc.hidden = false;
                            inputNombre.hidden = false;
                            inputDetalles.hidden = false;
                            inputCalificacion.hidden = true;
                            inputCantidad.hidden = true;
                            inputTipoFacilidad.hidden = true;
                            inputProfesor.hidden = true;
                            inputAdjunto.hidden = true;

                            break;
                        case "4":
                            inputTelefono.hidden = false;
                            inputNrc.hidden = false;
                            inputNombre.hidden = false;
                            inputDetalles.hidden = false;
                            inputCalificacion.hidden = true;
                            inputCantidad.hidden = true;
                            inputTipoFacilidad.hidden = true;
                            inputProfesor.hidden = true;
                            inputAdjunto.hidden = true;
                            break;
                        case "5":
                            inputTelefono.hidden = false;
                            inputNrc.hidden = true;
                            inputNombre.hidden = false;
                            inputDetalles.hidden = false;
                            inputCalificacion.hidden = false;
                            inputCantidad.hidden = false;
                            inputTipoFacilidad.hidden = true;
                            inputProfesor.hidden = true;
                            inputAdjunto.hidden = true;
                            button.hidden = false
                            break;
                        case "6":
                            inputTelefono.hidden = false;
                            inputNrc.hidden = true;
                            inputNombre.hidden = false;
                            inputDetalles.hidden = false;
                            inputCalificacion.hidden = true;
                            inputCantidad.hidden = true;
                            inputTipoFacilidad.hidden = false;
                            inputProfesor.hidden = false;
                            inputAdjunto.hidden = false;
                            break;
                        default:
                            inputTelefono.hidden = true;
                            inputNrc.hidden = true;
                            inputNombre.hidden = true;
                            inputDetalles.hidden = true;
                            inputCalificacion.hidden = true;
                            inputCantidad.hidden = true;
                            inputTipoFacilidad.hidden = true;
                            inputProfesor.hidden = true;
                            inputAdjunto.hidden = true;
                            break;
                    }
                button.addEventListener('click', function(e){
                e.preventDefault();
                Swal.fire({
                    title: '¿Estas seguro de resolver la solicitud?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#48A24C',
                    cancelButtonColor: '#C4312C',
                    confirmButtonText: 'Si, resolver',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        sessionStorage.setItem('selectAccion', selectAccion.value);
                    }
                })
                });
            </script>

            <script type="text/javascript">

                const selectAccion = document.getElementById('resolverSolicitud');
                const Observaciones = document.getElementById('groupObservacionSolicitud');
                const button = document.getElementById('groupButton');

                selectAccion.addEventListener('change', () => {
                    switch (selectAccion.value) {
                        case "1":
                            Observaciones.hidden = true;
                            button.hidden = false;
                            break;
                        case "2":
                            Observaciones.hidden = false;
                            button.hidden = false;
                            break;
                        case "3":
                            Observaciones.hidden = false;
                            button.hidden = false;
                            break;
                        default:
                            Observaciones.hidden = true;
                            button.hidden = true;
                            break;
                    }
                });
                switch (sessionStorage.getItem('selectAccion')) {
                        case "1":
                            Observaciones.hidden = true;
                            button.hidden = false;
                            break;
                        case "2":
                            Observaciones.hidden = false;
                            button.hidden = false;
                            break;
                        case "3":
                            Observaciones.hidden = false;
                            button.hidden = false;
                            break;
                        default:
                            Observaciones.hidden = true;
                            button.hidden = true;
                            break;
                    }
            </script>
@endsection

