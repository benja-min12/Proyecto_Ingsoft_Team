@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-8 login-box">
            <div class="col-lg-12 login-key">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="col-lg-12 login-title">
                <h2 class="text-center">DATOS ALUMNO</h2>
            </div>
            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <div class="card border-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class=" col-md-2"></div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row-12">
                                                <div class="col-lg-12 login-key">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mx-auto">
                                            <table class="table table-bordered table-sm">
                                                <tbody >
                                                    <tr>
                                                        <th class="table-primary border-primary">Nombre:</th>
                                                        <td class="border-primary">{{ $user->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-primary border-primary">Rut:</th>
                                                        <td class="border-primary">{{ $user->rut }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-primary border-primary">Carrera:</th>
                                                        <td class="border-primary">{{ $user->carrera()->first()->nombre }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-primary border-primary">Email:</th>
                                                        <td class="border-primary">{{ $user->email }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-2"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mx-auto">
                                    <div class="col-12">
                                        <div class="login-title text-center"><h3>SOLICITUDES</h3> </div>
                                        <table class="table table-bordered table-hover table-sm">
                                            <thead class="table-primary">
                                                <th class="border-primary" scope="col">Número</th>
                                                <th class="border-primary" scope="col">Fecha</th>
                                                <th class="border-primary" scope="col">Tipo</th>
                                                <th class="border-primary" scope="col">Ver</th>
                                            </thead>
                                            <tbody>
                                                @forelse ($user->solicitudes as $solicitud)
                                                <tr>
                                                    <td class="border-primary">{{$solicitud->getOriginal()['pivot_id']}}</td>
                                                    <td class="border-primary">{{$solicitud->getOriginal()['pivot_updated_at']}}</td>
                                                    <td class="border-primary">{{$solicitud->getOriginal()['tipo']}}</td>
                                                    <td class="border-primary"><a class="btn btn-primary" href={{ route('verSolicitudAlumno',
                                                            ['id'=>$solicitud->getOriginal()['pivot_id'], 'alumno_id' => $user->id])
                                                            }}>Ver</a></td>

                                                </tr>
                                                @empty
                                                <tr>
                                                    <td class="border-primary" colspan="4">
                                                        <p>Sin Solicitudes</p>
                                                    </td>
                                                </tr>

                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>

                                <div class="col-lg-3 col-md-2"></div>
                        </div>

                    </div>














                </div>
            </div>
        </div>
    </div>


</div>




    @endsection
