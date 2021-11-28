<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //solicitudes de la tabla pivot de userSolicitud
        $solicitudesAlumno = Auth::user()->solicitudes;

        return view('solicitud.index')->with('solicitudes', $solicitudesAlumno);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('solicitud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch ($request->tipo) {
            case '1':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','required','min:8','max:8'],
                    'nrc' => ['required','regex:/[0-9]/','regex:/(^[1-9])/'],
                    'nombre' => ['required','regex:/[a-zA-Z]/'],
                    'detalle' => ['required']
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'NRC' => $request->nrc,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle
                ]);
                $findSolicitud=  DB::table('solicitud_user')->orderBy('id', 'desc')->first();
                $Mensaje="Se ha registrado la solicitud número ". $findSolicitud->id . " con fecha ". $findSolicitud->created_at;
                return redirect('/solicitud')->with('Crear',$Mensaje);
                break;
            case '2':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','required','min:8','max:8'],
                    'nrc' => ['required','regex:/[0-9]/','regex:/(^[1-9])/'],
                    'nombre' => ['required','regex:/[a-zA-Z]/'],
                    'detalle' => ['required']
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'NRC' => $request->nrc,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle
                ]);
                $findSolicitud=  DB::table('solicitud_user')->orderBy('id', 'desc')->first();
                $Mensaje="Se ha registrado la solicitud número ". $findSolicitud->id . " con fecha ". $findSolicitud->created_at;
                return redirect('/solicitud')->with('Crear',$Mensaje);
                break;
            case '3':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','required','min:8','max:8'],
                    'nrc' => ['required','regex:/[0-9]/','regex:/(^[1-9])/'],
                    'nombre' => ['required','regex:/[a-zA-Z]/'],
                    'detalle' => ['required']
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'NRC' => $request->nrc,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle
                ]);
                $findSolicitud=  DB::table('solicitud_user')->orderBy('id', 'desc')->first();
                $Mensaje="Se ha registrado la solicitud número ". $findSolicitud->id . " con fecha ". $findSolicitud->created_at;
                return redirect('/solicitud')->with('Crear',$Mensaje);
                break;
            case '4':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','required','min:8','max:8'],
                    'nrc' => ['required','regex:/[0-9]/','regex:/(^[1-9])/'],
                    'nombre' => ['required','regex:/[a-zA-Z]/'],
                    'detalle' => ['required']
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'NRC' => $request->nrc,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle
                ]);
                $findSolicitud=  DB::table('solicitud_user')->orderBy('id', 'desc')->first();
                $Mensaje="Se ha registrado la solicitud número ". $findSolicitud->id . " con fecha ". $findSolicitud->created_at;
                return redirect('/solicitud')->with('Crear',$Mensaje);
                break;
            case '5':

                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','required','min:8','max:8'],
                    'nombre' => ['required','regex:/[a-zA-Z]/'],
                    'detalle' => ['required'],
                    'calificacion'=>['required','numeric','between:4.0,7.0'],
                    'cantidad'=>['regex:/[0-9]*/','required']
                ]);

                $findUser = User::find($request->user);

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle,
                    'calificacion_aprob'=>$request->calificacion,
                    'cant_ayudantias'=>$request->cantidad
                ]);
                $findSolicitud=  DB::table('solicitud_user')->orderBy('id', 'desc')->first();
                $Mensaje="Se ha registrado la solicitud número ". $findSolicitud->id . " con fecha ". $findSolicitud->created_at;
                return redirect('/solicitud')->with('Crear',$Mensaje);
                break;
            case '6':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','required','min:8','max:8'],
                    'nombre' => ['required','regex:/[a-zA-Z]*/'],
                    'detalle' => ['required'],
                    'facilidad' => ['required'],
                    'profesor' => ['required','regex:/[a-zA-Z]*/'],
                    'adjunto.*' => ['mimes:pdf,jpg,jpeg,doc,docx'],
                ]);

                $findUser = User::find($request->user);

                $aux = 0;

                foreach ($request->adjunto as $file) {

                    $name = $aux.time().'-'.$findUser->name.'.pdf';
                    $file->move(public_path('\storage\docs'), $name);
                    $datos[] = $name;
                    $aux++;
                }

                $findUser->solicitudes()->attach($request->tipo, [
                    'telefono' => $request->telefono,
                    'nombre_asignatura' => $request->nombre,
                    'detalles' => $request->detalle,
                    'tipo_facilidad' => $request->facilidad,
                    'nombre_profesor' => $request->profesor,
                    'archivos' => json_encode($datos),
                ]);
                $findSolicitud=  DB::table('solicitud_user')->orderBy('id', 'desc')->first();
                $Mensaje="Se ha registrado la solicitud número ". $findSolicitud->id . " con fecha ". $findSolicitud->created_at;
                return redirect('/solicitud')->with('Crear',$Mensaje);
                break;

            default:
                return redirect('/solicitud')->with('Error',"No se pudo crear la solicitud");
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }
}
