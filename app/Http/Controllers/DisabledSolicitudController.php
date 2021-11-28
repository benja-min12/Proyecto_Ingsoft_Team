<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisabledSolicitudController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function disabledSolicitud (Request $request){

        $solicitudesAlumno = Auth::user()->solicitudes;
        foreach ($solicitudesAlumno as $solicitud){

            if ($solicitud->getOriginal()['pivot_id'] == $request->id){

                $solicitud->pivot->estado = 4;
                $solicitud->pivot->save();
                return redirect('/solicitud');

            }
        }

        /*$solicitud = Solicitud::where('id', $request->id)->get()->first();
        if ($solicitud->status === 0) {
            $solicitud->status = 1;
            $solicitud->save();
            return redirect('/solicitud');
        } else {
            $solicitud->status = 0;
            $solicitud->save();
            return redirect('/solicitud');
        }*/
    }
}
