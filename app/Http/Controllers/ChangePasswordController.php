<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\User;
use App\Rules\ValidadorRut;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Psy\debug;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword(Request $request)
    {
        //dd($request);
        $findUser = User::where('id', $request->id);

        $request->validate([
            'password' => ['confirmed', 'min:6', 'required'],
        ]);
        $findUser->update(['password' => Hash::make($request->password)]);
        return redirect(route('home'))->with('password', 'updated');
    }

    public function cambiarContrasenia()
    {
        $user = Auth::user();
        return view('auth.passwords.reset', ['user' => $user]);
    }
    public function ResetContrasenia()
    {
        $users = User::all();
        return view('usuario.resetpassword')->with('users', $users);
    }
    public function ResetPassword(Request $request)
    {
        $request->validate([
            'rut' => ['required', 'string', new ValidadorRut()],
        ]);

        $findUser = User::where('rut', $request->rut)->first();

        if($findUser==null){
            return redirect(route('usuario.index'))->with('error','rut no se encuentra en el registro');
        }
        if ($findUser->tipo_usuario == 'Administrador') {
            $defaultPassword = substr($request->rut, 0, 6);
            $findUser->update(['password' => Hash::make($defaultPassword)]);

            Auth::logout();
            return redirect(route('login'));
        } else {
            $defaultPassword = substr($request->rut, 0, 6);
            $findUser->update(['password' => Hash::make($defaultPassword)]);
            return redirect(route('usuario.index'))->with('resetPassword','contraseña restablecida correctamente');
        }
    }
}
