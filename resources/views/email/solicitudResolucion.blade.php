<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolución de Solicitud</title>
</head>

<body>
    @if ($info->pivot->estado == 1)
    <div class="card-header border-primary" style="height: 100px">
        <h5 class="mt-3">
            <p>Estimado Alumno,</p>
            <p>Le informamos que la solicitud enviada, de número {{$info->pivot->id}} y de tipo {{$info->tipo}} ha sido aceptada.</p>
            <p>Por favor no responder a este correo.</p>
            Atte. Jefe de la Carrera.
        </h5>
    </div>
    @endif
    @if ($info->pivot->estado == 2)
    <div class="card-header border-primary" style="height: 100px">
        <h5 class="mt-3">
            <p>Estimado Alumno,</p>
            <p>Le informamos que la solicitud enviada, de número {{$info->pivot->id}} y de tipo {{$info->tipo}} ha sido aceptada con observaciones.</p>
            <p>Con las siguientes observaciones:</p>
            <div>
                {{$observacion}}
            <div>
            <p>Por favor no responder a este correo.</p>
            Atte. Jefe de la Carrera.

        </h5>
    </div>
    @endif

    @if ($info->pivot->estado == 3 )
    <div class="card-header border-primary" style="height: 100px">
        <h5 class="mt-3">
            <p>Estimado Alumno,</p>
            <p>Le informamos que la solicitud enviada, de número {{$info->pivot->id}} y de tipo {{$info->tipo}} ha sido rechazada.</p>
            <p>Con las siguientes observaciones:</p>
            <div>
                {{$observacion}}
            <div>
            <p>Por favor no responder a este correo.</p>
            Atte. Jefe de la Carrera.
        </h5>
    </div>
    @endif
</body>
