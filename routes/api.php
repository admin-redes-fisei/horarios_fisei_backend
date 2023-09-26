<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\CaracteristicaController;
use App\Http\Controllers\CargarBase;
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
use Illuminate\Routing\Router;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['verify.token:Admin'])->group(function (){
    Route::resource('docentes', DocenteController::class);
    Route::resource('aulas', AulaController::class);
    Route::get('docente/{id}', [DocenteController::class, 'horario_docente']);
    Route::get('aula/{id}', [AulaController::class, 'horario_aula']);
    Route::get('carrera/{id}', [CarreraController::class, 'index']);
    Route::resource('sugerencias', SugerenciaController::class);
    Route::resource('actividades', ActividadController::class);
    Route::resource('caracteristicas', CaracteristicaController::class);
    Route::resource('softwares', SoftwareController::class);
    Route::resource('horarios', HorarioController::class);
    Route::get('horario/{id}/{dia}', [HorarioController::class, 'horariolab']);
});


Route::middleware(['verify.token:Estudiante,Admin'])->group(function (){
    Route::resource('docentes', DocenteController::class)->only('index');
    Route::resource('aulas', AulaController::class)->only('index');
    Route::get('docente/{id}', [DocenteController::class, 'horario_docente']);
    Route::get('aula/{id}', [AulaController::class, 'horario_aula']);
    Route::resource('sugerencias', SugerenciaController::class)->only('store');
});

//Route::get('horario/{id}/{dia}', [HorarioController::class, 'horariolab']);


// Route::get('horario/{id}/{dia}', [HorarioController::class, 'horariolab']);


// Route::resource('docentes', DocenteController::class);
// Route::get('docente/{id}', [DocenteController::class, 'horario_docente']);

// Route::resource('aulas', AulaController::class);
// Route::get('aula/{id}', [AulaController::class, 'horario_aula']);

// Route::resource('sugerencias', SugerenciaController::class)->only('index', 'store', 'update', 'destroy');

// Route::resource('actividades', ActividadController::class);

// Route::resource('caracteristicas', CaracteristicaController::class)->only('index', 'store', 'update', 'destroy');

// Route::resource('softwares', SoftwareController::class);

// Route::resource('horarios', HorarioController::class)->only('index', 'store', 'update', 'destroy');

Route::post('createUser', [UserController::class, 'create']);

// Route::get('carrera/{id}', [CarreraController::class, 'index']);

// Route::resource('periodos', PeriodoController::class);   
// Route::resource('software', SoftwareController::class)->only('index', 'store', 'update', 'destroy');
// Route::resource('titulos', TituloController::class);
// Route::resource('puestos', PuestoController::class)->only('index', 'store', 'update', 'destroy');
// Route::resource('carreras', CarreraController::class);
