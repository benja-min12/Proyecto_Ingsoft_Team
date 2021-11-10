<?php

use App\Http\Controllers\CarreraController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DisabledUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', function (){
        $usuarioLogeado = Auth::user();
        return view('perfil')->with('user',$usuarioLogeado);
    });
});
Route::resource('carrera', CarreraController::class, ['middleware' => 'auth']);

Auth::routes();
Route::resource('usuario', UsuarioController::class,['middleware' => 'auth']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/changePassword', [App\Http\Controllers\ChangePasswordController::class, 'changePassword'])->name('changePassword');
Route::get('/cambiarContrasenia',[App\Http\Controllers\ChangePasswordController::class, 'cambiarContrasenia'])->name('cambiarContrasenia');
Route::get('/ResetContrasenia',[App\Http\Controllers\ChangePasswordController::class, 'ResetContrasenia'])->name('ResetContrasenia');
Route::post('/ResetPassword', [App\Http\Controllers\ChangePasswordController::class, 'ResetPassword'])->name('ResetPassword');
Route::get('/status-user-change', [DisabledUserController::class, 'disabledUser'])->name('changeStatus');
