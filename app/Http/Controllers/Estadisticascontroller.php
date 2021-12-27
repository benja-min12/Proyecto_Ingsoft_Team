<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\User;
class Estadisticascontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $fecha1= $request->Fecha1;
        $fecha2= $request->Fecha2;
        $fecha2 = date('Y-m-d', strtotime($fecha2 . ' + 1 days'));
        $fecha1 = date('Y-m-d', strtotime($fecha1));
        $totalSolicitudes = 0;
        $totalPendiente = 0;
        $totalRechazada = 0;
        $totalAceptada = 0;
        $totalAceptadaObs = 0;
        $totalAnulada = 0;
        $cantTipo1 = 0;
        $cantTipo2 = 0;
        $cantTipo3 = 0;
        $cantTipo4 = 0;
        $cantTipo5 = 0;
        $cantTipo6 = 0;

        $usuarios1= User::where('tipo_usuario', 'Alumno')->get();
        foreach($usuarios1 as $usuario){
            foreach($usuario->solicitudes as  $solicitud){
                $totalSolicitudes++;
            }
        }
        $cantEnRango = 0;
        $usuarios = User::where('tipo_usuario', 'Alumno')->with(array('solicitudes' => function ($query) use ($fecha1, $fecha2) {
            $query->wherePivot('created_at', '>=', $fecha1)->wherePivot('created_at', '<=', $fecha2);
        }))->get();
        foreach ($usuarios as $usuario) {
            foreach ($usuario->solicitudes as  $solicitud) {
                $cantEnRango ++;
                switch ($solicitud->getOriginal()['pivot_estado']) {
                    case 0:
                        $totalPendiente++;
                        break;
                    case 1:
                        $totalAceptada++;
                        break;
                    case 2:
                        $totalAceptadaObs++;
                        break;
                    case 3:
                        $totalRechazada++;
                        break;
                    case 4:
                        $totalAnulada++;
                        break;
                    default:
                        # code...
                        break;
                }
                switch ($solicitud->getOriginal()['pivot_solicitud_id']) {
                    case 1:
                        $cantTipo1++;
                        break;
                    case 2:
                        $cantTipo2++;
                        break;
                    case 3:
                        $cantTipo3++;
                        break;
                    case 4:
                        $cantTipo4++;
                        break;
                    case 5:
                        $cantTipo5++;
                        break;
                    case 6:
                        $cantTipo6++;
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }

        //si total solicitudes es 0, no hay solicitudes en ese rango de fechas
        if($totalSolicitudes == 0)
        {
            $porcentajePendiente = 0;
            $porcentajeRechazada = 0;
            $porcentajeAceptada = 0;
            $porcentajeAceptadaObs = 0;
            $porcentajeAnulada = 0;
        }
        else
        {
            //porcentajePendiente con 1 decimal
            $porcentajePendiente = round(($totalPendiente / $totalSolicitudes) * 100, 1);
            //porcentajeRechazada con 1 decimal
            $porcentajeRechazada = round(($totalRechazada / $totalSolicitudes) * 100, 1);
            //porcentajeAceptada con 1 decimal
            $porcentajeAceptada = round(($totalAceptada / $totalSolicitudes) * 100, 1);
            //porcentajeAceptadaObs con 1 decimal
            $porcentajeAceptadaObs = round(($totalAceptadaObs / $totalSolicitudes) * 100, 1);
            //porcentajeAnulada con 1 decimal
            $porcentajeAnulada = round(($totalAnulada / $totalSolicitudes) * 100, 1);
        }


        return view('estadisticas.index')
            ->with('cantTipo1', $cantTipo1)
            ->with('cantTipo2', $cantTipo2)
            ->with('cantTipo3', $cantTipo3)
            ->with('cantTipo4', $cantTipo4)
            ->with('cantTipo5', $cantTipo5)
            ->with('cantTipo6', $cantTipo6)
            ->with('totalPendiente', $totalPendiente)
            ->with('totalRechazada', $totalRechazada)
            ->with('totalAceptada', $totalAceptada)
            ->with('totalAceptadaObs', $totalAceptadaObs)
            ->with('totalAnulada', $totalAnulada)
            ->with('totalSolicitudes', $totalSolicitudes)
            ->with('porcentajePendiente', $porcentajePendiente)
            ->with('porcentajeRechazada', $porcentajeRechazada)
            ->with('porcentajeAceptada', $porcentajeAceptada)
            ->with('porcentajeAceptadaObs', $porcentajeAceptadaObs)
            ->with('porcentajeAnulada', $porcentajeAnulada)
            ->with('cantEnRango', $cantEnRango);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
