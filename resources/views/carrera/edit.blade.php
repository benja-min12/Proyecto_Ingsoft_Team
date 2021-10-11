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
                <h2 class="text-center">EDITAR CARRERA</h2>
            </div>

            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <form method="POST" action="{{ route('carrera.update', [$carrera]) }}">

                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
    </div>
@endsection
