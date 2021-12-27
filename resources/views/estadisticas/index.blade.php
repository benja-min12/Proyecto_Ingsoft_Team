@extends('layouts.app')

@section('content')
@if (session('error'))
    <script>
        Swal.fire({
        position: 'center',
        icon: 'error',
        title: '{{ session('error') }}',
        showConfirmButton: false,
        timer: 1500
        })
    </script>
@endif
<div class="container">
    <div class="row justify-content-center">
        <form method action>
            <h4 class="text-center">Ingrese un rango de fechas</h4>
            <input class="border-primary @error('Fecha1') is-invalid @enderror"type="date" name="Fecha1" id="Fecha1" value="" min="" max=""/>
            @error('Fecha1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input class="border-primary @error('Fecha2') is-invalid @enderror" type="date" name="Fecha2" id="Fecha2" value="" min="" max=""/>
            @error('Fecha2')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <button id="boton" class="btn btn-primary">Filtrar</button>
        </form>
    </div>
    <h1 style="font-size: 50px" class="text-center">Estadísticas del sistema</h1>
    <div><h3 class="text-center">Cantidad se solicitudes recibidas: {{$cantEnRango}}</h3></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card border-primary">
                    <div class="card-body">
                        <div id="chartContainerTipo" style="width: 100%; height: 250px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card border-primary"style="width: 120%;">
                    <div class="card-body">
                        <h5 class="text-center">Cantidad de solicitudes por tipo</h5>
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-primary">Sobrecupo: {{$cantTipo1}}</li>
                            <li class="list-group-item list-group-item-primary">Cambio de paralelo: {{$cantTipo2}}</li>
                            <li class="list-group-item list-group-item-primary">Eliminación de asignatura: {{$cantTipo3}}</li>
                            <li class="list-group-item list-group-item-primary">Inscripción de asignatura: {{$cantTipo4}}</li>
                            <li class="list-group-item list-group-item-primary">Ayudantía: {{$cantTipo5}}</li>
                            <li class="list-group-item list-group-item-primary">Facilidades Académicas: {{$cantTipo6}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-4  mr-5 ml-3">
                <div class="card border-primary"style="width: 120%;">
                    <div class="card-body">
                        <h5 class="text-center">Estadísticas de solicitudes por estado</h5>
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-warning"><img class="mr-3" style="height: 20px" src="{{asset('images/pendiente.png')}}" alt="pendiente">Pendientes: {{$totalPendiente}} con un porcentaje de {{$porcentajePendiente}} %</li>
                            <li class="list-group-item list-group-item-success"><img class="mr-3" style="height: 20px" src="{{asset('images/aceptar.png')}}" alt="aceptado">Aceptadas: {{$totalAceptada}} con un porcentaje de {{$porcentajeAceptada}} %</li>
                            <li class="list-group-item list-group-item-success"><img class="mr-3" style="height: 20px" src="{{asset('images/Observacion.png')}}" alt="aceptado_observacion">Aceptadas con observaciones: {{$totalAceptadaObs}} con un porcentaje de {{$porcentajeAceptadaObs}} %</li>
                            <li class="list-group-item list-group-item-danger"><img class="mr-3" style="height: 20px" src="{{asset('images/Rechazada.png')}}" alt="Rechazada">Rechazadas: {{$totalRechazada}} con un porcentaje de {{$porcentajeRechazada}} %</li>
                            <li class="list-group-item list-group-item-secondary"><img class="mr-3" style="height: 20px" src="{{asset('images/alert.png')}}" alt="Anulado">Anuladas: {{ $totalAnulada}} con un porcentaje de {{$porcentajeAnulada}} %</li>
                        </ul>
                    </div>
                </div>
                </div>

            </div>
        </div>
    </div>



</div>

<script>
    var chart = new CanvasJS.Chart("chartContainerTipo", {
    animationEnabled: true,
    theme: "light1", // "light1", "light2", "dark1", "dark2"
    title:{
    text: "Solicitudes por tipo"
    },
    axisY: {
    title: "Cantidad de solicitudes"
    },
    data: [{
    type: "column",
    showInLegend: false,
    legendMarkerColor: "grey",
    legendText: "MMbbl = one million barrels",
    dataPoints: [
    { y: JSON.parse("{{json_encode($cantTipo1)}}"), label: "Sobrecupo" },
    { y: JSON.parse("{{json_encode($cantTipo2)}}"), label: "Cambio" },
    { y: JSON.parse("{{json_encode($cantTipo3)}}"), label: "Eliminación" },
    { y: JSON.parse("{{json_encode($cantTipo4)}}"), label: "Inscripción" },
    { y: JSON.parse("{{json_encode($cantTipo5)}}"), label: "Ayudantía" },
    { y: JSON.parse("{{json_encode($cantTipo6)}}"), label: "Facilidades" },
    ]
    }]
    });
    chart.render();
</script>
<script>
    const fecha1 = document.getElementById('Fecha1');
    const fecha2 = document.getElementById('Fecha2');
    var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!
var yyyy = today.getFullYear();

if (dd < 10) {
    dd = '0' + dd;
}

if (mm < 10) {
    mm = '0' + mm;
}

today = yyyy + '-' + mm + '-' + dd;
document.getElementById("Fecha1").setAttribute("max", today);
document.getElementById("Fecha2").setAttribute("max", today);
fecha1.addEventListener('change', function() {
    document.getElementById("Fecha2").setAttribute("min", fecha1.value);
});
fecha2.addEventListener('change', function() {
    document.getElementById("Fecha1").setAttribute("max", fecha2.value);
});
</script>
@endsection
