<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResolucionSolicitudMail;

class ResolverSolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jefeCarrera = Auth::user()->carrera_id;



        if ($request->resolverSolicitud == 0) {
            //$user= User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with('solicitudesActivas')->get();
            $user= User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with('solicitudesActivas')->orderBy('updated_at', 'desc')->get();
            return view('resolver-solicitud.index')->with('alumnos', $user);
        }
        elseif ($request->resolverSolicitud == 1) {
            $user= User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with('solicitudesAceptadas')->get();
            return view('resolver-solicitud.index')->with('alumnos', $user);
        }
        elseif ($request->resolverSolicitud == 2) {
            $user= User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with('solicitudesAceptadasObservaciones')->get();
            return view('resolver-solicitud.index')->with('alumnos', $user);
        }
        elseif ($request->resolverSolicitud == 3) {
            $user= User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with('solicitudesRechazadas')->get();
            return view('resolver-solicitud.index')->with('alumnos', $user);
        }
        elseif ($request->resolverSolicitud == 4) {
            $user= User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with('solicitudesAnuladas')->get();
            return view('resolver-solicitud.index')->with('alumnos', $user);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexResueltas(Request $request)
    {
        $jefeCarrera = Auth::user()->carrera_id;

        if($request == 1){
            $user= User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with('solicitudesAceptadas')->get();
            return view('resolver-solicitud.index')->with('alumnos', $user);
        }
        elseif($request == 2){
            $user= User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with('solicitudesRechazadas')->get();
            return view('resolver-solicitud.index')->with('alumnos', $user);

        }
        else{
            $user= User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with('solicitudesAceptadasObservaciones')->get();
            return view('resolver-solicitud.index')->with('alumnos', $user);
        }

    }
        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $jefeCarrera = Auth::user()->carrera_id;


        $user= User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with('solicitudesActivas')->get();
        foreach ($user as $usuario){
            foreach ($usuario->solicitudesActivas as $solicitud){
                if ($solicitud->getOriginal()['pivot_id'] == $id) {
                    $solicitudGuardada = $solicitud;
                    $alumno = $usuario;
                }
            }
        }
        return view('resolver-solicitud.edit')->with('solicitud', $solicitudGuardada)->with('alumno',$alumno);

    }

    public function update(Request $request,Solicitud $solicitud)
    {
        $jefeCarrera = Auth::user()->carrera_id;
        $user= User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with('solicitudesActivas')->get();
        //dd($request->estado);
        //dd($request->observacionSolicitud);

        foreach ($user as $usuario){
            foreach ($usuario->solicitudesActivas as $solicitud){
                if ($solicitud->getOriginal()['pivot_id'] == $request->id_solicitud) {
                    $solicitud->pivot->estado = $request->resolverSolicitud;
                    $solicitud->pivot->save();
                    $observacion = $request->observacionSolicitud;

                    if ($request->estado ==1){
                        Mail::to($usuario->email)->send(new ResolucionSolicitudMail ($observacion,$solicitud));
                    }
                    else if ($request->estado ==2){
                        Mail::to($usuario->email)->send(new ResolucionSolicitudMail ($observacion,$solicitud));
                    }
                    else{
                        Mail::to($usuario->email)->send(new ResolucionSolicitudMail ($observacion,$solicitud));
                    }
                }
            }
        }

        return redirect('/resolver-solicitud')->with('success','Solicitud editada correctamente');
    }
}
