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
        $id=$request->searchID;
        $JefeCarrera=Auth::user()->carrera_id;
        if ($request->searchID==null) {
            $usuarios = User::where('carrera_id', $JefeCarrera)->where('id', '!=', $JefeCarrera)->with('solicitudes')->get();
            return view('/Filtrar-solicitud.index')->with('usuarios', $usuarios);
        }elseif ($request->searchID  != 'null') {
            $usuarios = User::where('carrera_id', $JefeCarrera)->where('id', '!=', $JefeCarrera)->firstOrFail();
            dd($usuarios);
            return view('/Filtrar-solicitud.index')->with('solicitud', $usuarios);
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
