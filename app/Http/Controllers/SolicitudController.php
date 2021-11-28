<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\ElseIf_;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Storage;
use PhpParser\Builder\Use_;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $solicitudesAlumno = Auth::user()->solicitudes;
        return view('solicitud.index')->with('solicitudes',$solicitudesAlumno);
        /*$category = Solicitud::with('solicituds')->where('id',1)->find(1);

        if ($request->search == null) {
            //$solicitudesAlumno = Solicitud::simplePaginate(7);
            $solicitudesAlumno = Auth::user()->solicitudes;
            return view('solicitud.index')->with('solicitudes',$solicitudesAlumno);
        }

        else{
            $user = Auth::user();
            $solicitudesAlumno = Auth::wherePivot('id', $request->search)->simplePaginate(1);
            return view('solicitud.index')->with('solicitudes',$solicitudesAlumno);
            foreach ($solicitudesAlumno as $solicitud){
                if ($solicitud->getOriginal()['pivot_id'] == $request->search){
                    $solicitudGuardada = $solicitud;
                    return view('solicitud.index')->with('solicitudes',$solicitudGuardada);
                }

        }



        }

        /*if ($request->search == null) {
            //$solicitudesAlumno = Solicitud::simplePaginate(7);
            $solicitudesAlumno = Auth::user()->solicitudes;
            return view('solicitud.index')->with('solicitudes',$solicitudesAlumno);
        }
        else {
            $solicitudesAlumno = Auth::were('name', $request->search)->simplePaginate(1);
            return view('solicitud.index')->with('solicitudes',$solicitudesAlumno);
        }
        /*$solicitudesAlumno = Auth::user()->solicitudes;
        return view('solicitud.index')->with('solicitudes', $solicitudesAlumno);*/
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
                    'telefono' => ['regex:/[0-9]*/','required'],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
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
                    'telefono' => ['regex:/[0-9]*/','required'],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
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
                    'telefono' => ['regex:/[0-9]*/','required'],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
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
                    'telefono' => ['regex:/[0-9]*/','required'],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
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
                    'telefono' => ['regex:/[0-9]*/','required'],
                    'nombre' => ['required'],
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
                    'telefono' => ['regex:/[0-9]*/','required'],
                    'nombre' => ['required'],
                    'detalle' => ['required'],
                    'facilidad' => ['required'],
                    'profesor' => ['required'],
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
    public function edit(int $id)
    {
        //echo($id);
        $solicitudesAlumno = Auth::user()->solicitudes;
        foreach ($solicitudesAlumno as $solicitud){
            if ($solicitud->getOriginal()['pivot_id'] == $id){
                $solicitudGuardada = $solicitud;
            }

        }
        return view('solicitud.edit')->with('solicitud',$solicitudGuardada);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Solicitud $solicitud)
    {
        $solicitudesAlumno = Auth::user()->solicitudes;
        foreach ($solicitudesAlumno as $solicitud){

            if ($solicitud->getOriginal()['pivot_id'] == $request->id_solicitud){
                //echo($request->id);
                if($request->id == '1' or $request->id == '2' or $request->id == '3' or $request->id == '4'){

                    $request->validate([
                        'telefono' => ['regex:/[0-9]*/','required'],
                        'nrc' => ['required'],
                        'nombre' => ['required'],
                        'detalle' => ['required']
                    ]);

                    $solicitud->pivot->telefono = $request->telefono;
                    $solicitud->pivot->NRC = $request->nrc;
                    $solicitud->pivot->nombre_asignatura = $request->nombre;
                    $solicitud->pivot->detalles = $request->detalle;
                    $solicitud->pivot->save();

                }
                if($request->id == '5'){

                    $request->validate([
                        'telefono' => ['regex:/[0-9]*/','required'],
                        'nombre' => ['required'],
                        'detalle' => ['required'],
                        'calificacion'=>['required','numeric','between:4.0,7.0'],
                        'cantidad'=>['regex:/[0-9]*/','required']
                    ]);

                    $solicitud->pivot->telefono = $request->telefono;
                    $solicitud->pivot->nombre_asignatura = $request->nombre;
                    $solicitud->pivot->detalles = $request->detalle;
                    $solicitud->pivot->calificacion_aprob = $request->calificacion;
                    $solicitud->pivot->cant_ayudantias= $request->cantidad;
                    $solicitud->pivot->save();

                }
                if($request->id == '6'){

                    $findUser = Auth::user()->name;

                    $aux=0;



                    foreach (json_decode($solicitud->pivot->archivos) as $file){
                        //dd($file);
                        unlink(public_path('storage/docs/').$file);
                        Storage::delete(public_path('storage/docs/').$file);
                        dd($file);
                        dd($solicitud->pivot->nombre_asignatura);
                        //dd($solicitud->pivot->archivos);

                    }

                    /*foreach ($request->adjunto as $file) {

                        $name = $aux.time().'-'.$findUser->name.'.pdf';
                        $file->move(public_path('\storage\docs'), $name);
                        $datos[] = $name;
                        $aux++;
                    }*/


                    $solicitud->pivot->telefono = $request->telefono;
                    $solicitud->pivot->nombre_asignatura = $request->nombre;
                    $solicitud->pivot->detalles = $request->detalle;
                    $solicitud->pivot->tipo_facilidad = $request->facilidad;
                    $solicitud->pivot->nombre_profesor = $request->profesor;
                    $solicitud->pivot->archivos;

                    $solicitud->pivot->save();

                }

            }

        }

        return redirect('/solicitud')->with('success','Solicitud editada correctamente');
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
    public function anular(Request $request)
    {
        $solicitudesAlumno = Auth::user()->solicitudes;
        foreach ($solicitudesAlumno as $solicitud){
            if ($solicitud->getOriginal()['pivot_id'] == $request->id_solicitud){

                $solicitud->pivot->estado = 4;

            }
        }
        return view('solicitud.index');
    }
}
