<?php
use App\Http\Controllers\BuscarEstudianteController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\UsersImportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DisabledUserController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\DisabledSolicitudController;
use App\Http\Controllers\ResolverSolicitudController;

use App\Models\Solicitud;
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
Route::resource('solicitud', SolicitudController::class);
Route::resource('resolver-solicitud', ResolverSolicitudController::class);
Auth::routes();
Route::resource('usuario', UsuarioController::class,['middleware' => 'auth']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/changePassword', [App\Http\Controllers\ChangePasswordController::class, 'changePassword'])->name('changePassword');
Route::get('/cambiarContrasenia',[App\Http\Controllers\ChangePasswordController::class, 'cambiarContrasenia'])->name('cambiarContrasenia');
Route::get('/ResetContrasenia',[App\Http\Controllers\ChangePasswordController::class, 'ResetContrasenia'])->name('ResetContrasenia');
Route::post('/ResetPassword', [App\Http\Controllers\ChangePasswordController::class, 'ResetPassword'])->name('ResetPassword');
Route::get('/status-user-change', [DisabledUserController::class, 'disabledUser'])->name('changeStatus');
Route::get('/status-solicitud-change', [DisabledSolicitudController::class, 'disabledSolicitud'])->name('changeStatusSolicitud');
Route::get('users/import', [UsersImportController::class, 'show']);
Route::post('users/import', [UsersImportController::class, 'store']);
Route::get('buscar-estudiante', function(){return view('buscar-estudiante.index');})->name('buscarEstudiante');
Route::post('alumno',[BuscarEstudianteController::class, 'devolverEstudiante'])->name('postBuscarEstudiante');
Route::get('alumno/{id}', [BuscarEstudianteController::class,'mostrarEstudiante'])->name('mostrarEstudiante');
Route::get('alumno/{alumno_id}/solicitud/{id}', [BuscarEstudianteController::class, 'verDatosSolicitud'])->name('verSolicitudAlumno');

