@extends('layouts.app')

@section('content')

<body class="container-fluid" style="height: 100%; background-color:white">
    <div class="row">
        <div class="col-12">
            <div class="Bienvenida text-center mt-5" style="color:#ffff" >
                <h1 >
                    Bienvenido al sistema de gestión de solicitudes
                </h1>
                <img src="http://www.ucn.cl/wp-content/uploads/2018/05/Escudo-UCN-Full-Color.png" class="img-fluid mt-5" width="250px" alt="">

            </div>
            <div class="container mt-3">
                <div class="card text-center" style="height: 480px">
                    <div class="card-header" style="height: 100px; background-color:#c3ebff">
                        <h5 class="mt-3" >
                            <font face="Comic Sans MS">Sistema desarrollado para la gestión de solicitudes especiales relacionadas con: asignaturas, la carrera y otros trámites adicionales.</font>
                        </h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Desarrollado por:</h5>
                        <p class="card-text">Para soporte contactar a soporte@ucn.cl.</p>

                    </div>
                    <div class="card-footer text-muted">
                        Universidad Católica del Norte
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>




@endsection
