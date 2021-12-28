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
        $cantSolicitudes=0;
        $jefeCarrera = Auth::user()->carrera_id;
        if (!$request->resolverSolicitud) {
            $idEstado = 0;
        }else{
            $idEstado = $request->resolverSolicitud;
        }

        //dd($idEstado);
        //$usuarios =User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with(array('solicitudes' => function ($query) use ($idEstado) {
            //$query->wherePivot('estado', '==', $idEstado)->orderBy('create_at', 'desc');
        //}))->get();
            //$user= User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with('solicitudesActivas')->get();
            //$user= User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with('solicitudesActivas')->orderBy('updated_at', 'desc')->get();
        $user =User::where('carrera_id', $jefeCarrera)->where('id', '!=', Auth::user()->id)->with(array('solicitudes' => function ($query) use ($idEstado) {
            $query->wherePivot('estado',$idEstado);
            }))->get();

        foreach ($user as $usuario) {
            foreach ($usuario->solicitudes as $solicitud) {
                $cantSolicitudes++;
            }
        }
        return view('resolver-solicitud.index')->with('alumnos', $user)->with('cantSolicitudes', $cantSolicitudes);
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

        //dd($request->observacionSolicitud);
        if($request->resolverSolicitud == '2' || $request->resolverSolicitud == '3'){
            $request->validate([
                'observacionSolicitud' => ['required'],
            ]);
        }
        foreach ($user as $usuario){
            foreach ($usuario->solicitudesActivas as $solicitud){
                if ($solicitud->getOriginal()['pivot_id'] == $request->id_solicitud) {
                    $solicitud->pivot->estado = $request->resolverSolicitud;
                    $solicitud->pivot->save();
                    if($request->resolverSolicitud == '2' || $request->resolverSolicitud == '3'){
                        $observacion = $request->observacionSolicitud;
                    }
                    else{
                        $observacion = null;
                    }
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
        return redirect('/resolver-solicitud')->with('Resuelta','Solicitud resuelta correctamente');
    }
}
