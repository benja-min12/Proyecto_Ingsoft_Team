<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DisabledUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function disabledUser (Request $request){
        $usuario = User::where('id', $request->id)->get()->first();
        if ($usuario->status === 0) {
            $usuario->status = 1;
            $usuario->save();
            return redirect('/usuario');
        }else {
            $usuario->status = 0;
            $usuario->save();
            return redirect('/usuario');
        }

    }
}
