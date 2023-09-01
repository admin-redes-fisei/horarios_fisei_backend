<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\CaracteristicaController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\SugerenciaController;
use App\Http\Controllers\TituloController;
use App\Http\Controllers\UserController;
use App\Models\Puesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('docentes', DocenteController::class)->only('index', 'store', 'update', 'destroy')->only('index')->middleware('verify.token');
Route::get('docentes/{id}', [DocenteController::class, 'horario_docente'])->middleware('verify.token');
Route::resource('titulos', TituloController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('carreras', CarreraController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('actividades', ActividadController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('periodos', PeriodoController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('aulas', AulaController::class)->only('index', 'store', 'update', 'destroy')->only('index')->middleware('verify.token');
Route::get('aulas/{id}', [AulaController::class, 'horario_aula'])->middleware('verify.token');
Route::resource('software', SoftwareController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('caracteristicas', CaracteristicaController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('sugerencias', SugerenciaController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('puestos', PuestoController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('horarios', HorarioController::class)->only('index', 'store', 'update', 'destroy');
Route::post('createUser', [UserController::class, 'create']);
// Route::post('controller', [Controller::class, 'index']);

