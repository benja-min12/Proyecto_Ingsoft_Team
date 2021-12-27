<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Solcitud;



class FiltrarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->searchID;
        $tipo=$request->searchTipo;
        $cantSolicitudes=0;
        $JefeCarrera = Auth::user()->carrera_id;
        if (!$request->searchID && !$request->searchTipo) {
            $usuarios = User::where('carrera_id', $JefeCarrera)->where('id', '!=', $JefeCarrera)->with(array('solicitudes' => function ($query){
                $query->where('estado', '=', 0);
            }))->get();
            foreach ($usuarios as $usuario) {
                foreach ($usuario->solicitudes as $solicitud) {
                    $cantSolicitudes++;
                }
            }
            return view('/Filtrar-solicitud.index')->with('usuarios', $usuarios)->with('cantSolicitudes', $cantSolicitudes);
        }elseif($request->searchID) {
            $usuarios = User::where('carrera_id', $JefeCarrera)->where('id', '!=', $JefeCarrera)->with(array('solicitudes' => function ($query) use ($id) {
                $query->wherePivot('id', $id)->where('estado', '=', 0);
            }))->get();
            foreach ($usuarios as $usuario) {
                foreach ($usuario->solicitudes as $solicitud) {
                    $cantSolicitudes++;
                }
            }
            return view('/Filtrar-solicitud.index')->with('usuarios', $usuarios)->with('cantSolicitudes', $cantSolicitudes);
        }elseif($request->searchTipo!=null) {
            $usuarios = User::where('carrera_id', $JefeCarrera)->where('id', '!=', $JefeCarrera)->with(array('solicitudes' => function ($query) use ($tipo) {
                $query->wherePivot('solicitud_id', $tipo)->where('estado', '=', 0);
            }))->get();
            foreach ($usuarios as $usuario) {
                foreach ($usuario->solicitudes as $solicitud) {
                    $cantSolicitudes++;
                }
            }
            return view('/Filtrar-solicitud.index')->with('usuarios', $usuarios)->with('cantSolicitudes', $cantSolicitudes);
        }

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
    public function edit(int $id)
    {


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
