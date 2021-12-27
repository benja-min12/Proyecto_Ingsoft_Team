<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolucion de Solicitud</title>
</head>

<body>
    @if ($info->pivot->estado == 1)
    <div class="card-header border-primary" style="height: 100px">
        <h5 class="mt-3">
            Su solicitud de numero {{$info->pivot->id}} de tipo {{$info->tipo}} ha sido aceptada
        </h5>
    </div>
    @endif
    @if ($info->pivot->estado == 2)
    <div class="card-header border-primary" style="height: 100px">
        <h5 class="mt-3">
            Su solicitud de numero {{$info->pivot->id}} de tipo {{$info->tipo}} ha sido aceptada con observaciones
            <div>
                {{$observacion}}
            <div>
        </h5>
    </div>
    @endif

    @if ($info->pivot->estado == 3 )
    <div class="card-header border-primary" style="height: 100px">
        <h5 class="mt-3">
            Su solicitud de numero {{$info->pivot->id}} de tipo {{$info->tipo}} ha sido rechazada
            <div>
                {{$observacion}}
            <div>
        </h5>
    </div>
    @endif
</body>

