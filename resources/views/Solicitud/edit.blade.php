@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-8 login-box">
            <div class="col-lg-12 login-key">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="text-center mb-5">
                <h2>EDITAR SOLICITUD</h2>
            </div>
            <div class="card border-primary">
                <div class="card-body">
                    <div class="col-lg-12 login-form">
                        <div class="col-lg-12 login-form">
                            <form method="POST" action="{{ route('solicitud.update',$solicitud) }}"
                            enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="form-control-label">ID Solicitud</label>
                                    <input value={{$solicitud->getOriginal()['pivot_id']}} id="id_solicitud" type="text" readonly class="form-control" name="id_solicitud" required>
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
                                    <input value={{$solicitud->id}} id="id" type="text" class="form-control @error('tipo') is-invalid @enderror"
                                        name="id" required autofocus>
                                    @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" id="groupTelefono" hidden>
                                    <label class="form-control-label">TELEFONO CONTACTO</label>
                                    <input id="telefono" type="text"
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
                                    <input id="nrc" type="text" class="form-control @error('nrc') is-invalid @enderror"
                                        name="nrc" value="{{$solicitud->getOriginal()['pivot_NRC'] }}" autocomplete="nrc" autofocus>

                                    @error('nrc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" id="groupNombre" hidden>
                                    <label class="form-control-label">NOMBRE ASIGNATURA</label>
                                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
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
                                        class="form-control @error('calificacion') is-invalid @enderror" name="calificacion"
                                        value="{{$solicitud->getOriginal()['pivot_calificacion_aprob']}}" autocomplete="calificacion" placeholder="Ej. 6.8"
                                        autofocus>

                                    @error('calificacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" id="groupCantidad" hidden>
                                    <label class="form-control-label">CANTIDAD DE AYUDANTIAS REALIZADAS</label>
                                    <input id="cantidad" type="text"
                                        class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"
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
                                    <label for="form-control-label" style="color: black">TIPO DE FACILIDAD</label>
                                    <select class="form-control" name="facilidad" id="facilidad">
                                        <option value="{{$solicitud->getOriginal()['pivot_tipo_facilidad']}}">Seleccione..</option>
                                        <option value="Licencia">Licencia Médica o Certificado Médico</option>
                                        <option value="Inasistencia Fuerza Mayor">Inasistencia por Fuerza Mayor</option>
                                        <option value="Representacion">Representación de la Universidad</option>
                                        <option value="Inasistencia Motivo Personal">Inasistencia a Clases por Motivos
                                            Familiares</option>
                                    </select>
                                </div>

                                <div class="form-group" id="groupProfesor" hidden>
                                    <label class="form-control-label">NOMBRE PROFESOR</label>
                                    <input id="profesor" type="text"
                                        class="form-control @error('profesor') is-invalid @enderror" name="profesor"
                                        value="{{$solicitud->getOriginal()['pivot_nombre_profesor']}}" autocomplete="profesor" autofocus>

                                    @error('profesor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" id="groupAdjunto" hidden>
                                    <label class="form-control-label">ADJUNTAR ARCHIVO</label>
                                    <input id="adjunto" type="file" class="form-control @error('adjunto') is-invalid @enderror"
                                        name="adjunto[]" multiple value="{{$solicitud->getOriginal()['pivot_archivos']}}" autocomplete="adjunto" autofocus>
                                    @error('adjunto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" id="groupDetalles" hidden>
                                    <label class="form-control-label">DETALLES DE LA SOLICITUD</label>
                                    <textarea input id="detalle" type="text"
                                        class="form-control @error('detalle') is-invalid @enderror" name="detalle" >{{$solicitud->getOriginal()['pivot_detalles']}}</textarea>

                                    @error('detalle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 py-3">
                                    <div class="col-lg-12 text-center">
                                        <button type="submit" class="btn btn-primary">{{ __('Editar') }}</button>
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
                const button = document.getElementById('groupButton');
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
                            button.hidden = false
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
                            button.hidden = false
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
                            button.hidden = false
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
                            button.hidden = false
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
                            button.hidden = false
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
                            button.hidden = true
                            break;
                    }
            </script>
@endsection

