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
        $JefeCarrera = Auth::user()->carrera_id;
        if (!$request->searchID && !$request->searchTipo) {
            $usuarios = User::where('carrera_id', $JefeCarrera)->where('id', '!=', $JefeCarrera)->with('solicitudes')->get();
            return view('/Filtrar-solicitud.index')->with('usuarios', $usuarios);
        }elseif($request->searchID) {
            $usuarios = User::where('carrera_id', $JefeCarrera)->where('id', '!=', $JefeCarrera)->with(array('solicitudes' => function ($query) use ($id) {
                $query->wherePivot('id', $id);
            }))->get();
            return view('/Filtrar-solicitud.index')->with('usuarios', $usuarios);
        }elseif($request->searchTipo!=null) {
            $usuarios = User::where('carrera_id', $JefeCarrera)->where('id', '!=', $JefeCarrera)->with(array('solicitudes' => function ($query) use ($tipo) {
                $query->wherePivot('solicitud_id', $tipo);
            }))->get();
            return view('/Filtrar-solicitud.index')->with('usuarios', $usuarios);
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
