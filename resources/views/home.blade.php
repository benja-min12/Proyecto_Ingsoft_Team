@extends('layouts.app')

@section('content')

@if (request()->session()->get('password') == 'updated')
    <script>
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Contraseña actualizada con exito',
        showConfirmButton: false,
        timer: 1500
        })
    </script>
@endif


<div onload="fechaActual">

</div>
    <header class=" text-center mb-5 mt-5">
        <h1>
            Bienvenido {{Auth::user()->name }}
        </h1>
    </header>


<div class="container">

    <div class="row justify-content-center">
        @if (Auth::user()->tipo_usuario == "Administrador")
        <div class="card-deck mt-5">
            <div class="card border-primary" style="max-width: 600px">
                <i class="fas fa-users fa-10x text-center"></i>
                <div class="card-body">
                    <h4 class="card-title text-center">Administrar usuarios</h4>
                    <div class="text-center">
                        <img class="img-fluid" style="height: 200px" src="{{asset('images/Usuarios.png')}}" alt="Usuarios">
                    </div>
                    <p class="text-muted">Permite o crear/editar/deshabilitar usuarios del sistema.</p>
                </div>
                <div class="card-footer">
                    <a href="/usuario" class="btn btn-block btn-primary">IR</a>
                </div>
            </div>
            <div class="card border-primary">
                <i class="fas fa-users fa-10x text-center"></i>
                <div class="card-body">
                    <h5 class="card-title text-center">Carga masiva de estudiantes</h5>
                    <div class="text-center">
                        <img class="img-fluid" style="height: 200px" src="{{asset('images/CargaMasiva.png')}}" alt="CargaMasiva">
                    </div>
                    <small class="text-muted">Permite realizar una carga masiva de estudiantes al sistema.</small>
                </div>
                <div class="card-footer">
                    <a href="users/import" class="btn btn-block btn-primary">IR</a>

                </div>
            </div>
            <div class="card border-primary">
                <i class="fas fa-graduation-cap fa-10x text-center"></i>
                <div class="card-body">
                    <h4 class="card-title text-center">Administrar Carreras</h4>
                    <div class="text-center">
                        <img style="height: 200px" src="{{asset('images/Carreras.png')}}" alt="Carreras">
                    </div>
                    <p class="text-muted">Permite crear y/o editar carreras en el sistema.</p>
                </div>
                <div class="card-footer">
                    <a href="/carrera" class="btn btn-block btn-primary">IR</a>
                </div>
            </div>
        </div>
        @elseif (Auth::user()->tipo_usuario == "Jefe Carrera")

        <div class="card-deck">

            <div class="card border-primary">
                <i class="fas fa-search fa-10x text-center"></i>
                <div class="card-body">
                    <h4 class="card-title text-center">Buscar estudiante</h4>
                    <div class="text-center">
                        <img style="height: 200px" src="{{asset('images/BucarUsuario.png')}}" alt="Carreras">
                    </div>
                    <small class="text-muted">Permite buscar un estudiante mediante su RUT.</small>
                </div>
                <div class="card-footer border-primary">
                    <a href="/buscar-estudiante " class="btn btn-block btn-primary">IR</a>
                </div>
            </div>
            <div class="card border-primary">
                <i class="fas fa-check-double fa-10x text-center"></i>
                <div class="card-body">
                    <h4 class="card-title text-center">Resolver solicitudes</h4>
                    <small class="text-muted">Permite visualizar todas las solicitudes recibidas con estado "Pendiente".</small>
                </div>
                <div class="card-footer border-primary">
                    <a href="" class="btn btn-block btn-primary">IR</a>
                </div>
            </div>

            <div class="card border-primary">
                <i class="fas fa-info fa-10x text-center"></i>
                <div class="card-body">
                    <h4 class="card-title text-center">Estadísticas del sistema</h4>
                    <small class="text-muted">Permite visualizar mediante gráficos las distintas solicitudes del sistema.</small>
                </div>
                <div class="card-footer">
<<<<<<< HEAD
                    <a href="/estadisticas" class="btn btn-block btn-primary">IR</a>
=======
                    <a href="/Filtrar-solicitud" class="btn btn-block btn-primary">IR</a>
>>>>>>> d70c91ec0cb1848e62f65aaaac39d2f0b748a9cf
                </div>
            </div>
        </div>
        @elseif (Auth::user()->tipo_usuario == "Alumno")
        <div class="card-deck">
            <div class="card border-primary">
                <i class="fas fa-tasks fa-10x text-center"></i>
                <div class="card-body">
                    <h4 class="card-title text-center">Gestión de solicitudes</h4>
                    <div class="text-center">
                        <img style="height: 200px" src="{{asset('images/Solicitud.png')}}" alt="Carreras">
                    </div>
                    <small class="text-muted">Permite o crear/editar o anular solicitudes especiales.</small>

                </div>

                <div class="card-footer border-primary">
                    <a href="/solicitud" class="btn btn-block btn-primary">IR</a>
                </div>

            </div>
        </div>
        @endif
    </div>
</div>


@endsection

