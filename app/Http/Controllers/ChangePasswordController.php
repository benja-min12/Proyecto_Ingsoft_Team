<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword (Request $request){
        //dd($request);
        $findUser = User::where('id', $request->id);

        $request->validate([
            'password' => ['confirmed', 'min:6', 'required'],
        ]);
        $findUser->update(['password' => Hash::make($request->password)]);
        return redirect(route('home'))->with('password', 'updated');
    }

    public function cambiarContrasenia(){
        $user = Auth::user();
        return view('auth.passwords.reset',['user' => $user]);
    }
}
