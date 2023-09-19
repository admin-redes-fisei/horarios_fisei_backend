<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHorarioRequest;
use App\Models\Actividad;
use App\Models\Aula;
use App\Models\Docente;
use App\Models\Horario;
use App\Models\Paralelo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horarios = Docente::find(2)->horarios()->with(['aula', 'puesto', 'puesto.aula'])->get();


        return response()->json(array('horarios' => $horarios));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHorarioRequest $request)
    {
        $numero_dia = $request->numero_dia;

        $dia_semana = '';

        switch ($numero_dia) {
            case '1':
                $dia_semana = 'Lunes';
                break;
            case '2':
                $dia_semana = 'Martes';
                break;
            case '3':
                $dia_semana = 'Miércoles';
                break;
            case '4':
                $dia_semana = 'Jueves';
                break;
            case '5':
                $dia_semana = 'Viernes';
                break;
        }

        $request->merge(['dia_semana' => $dia_semana]);

        $horario = Horario::create($request->all());


        $aula = Aula::find($horario->aula_id);
        $docente = Docente::find($horario->docente_id);
        $actividad = Actividad::find($horario->actividad_id);
        $paralelo = Paralelo::find($horario->paralelo_id);

        $carrera = $actividad->carrera;

        // $nivel = "{$actividad->nivel} {$paralelo->nombre} {$carrera->nombre}";
        $aula_puesto_info = "{$aula->nombre} - {$aula->edificio} - {$aula->piso}";

        $respuesta = [
            'id' => $horario->id,
            'dia_semana' => $horario->dia_semana,
            'numero_dia' => $horario->numero_dia,
            'hora_inicio' => $horario->hora_inicio,
            'hora_fin' => $horario->hora_fin,
            'aula_puesto_info' => $aula_puesto_info,
            'aula' => $horario->numero_puesto == '' ? true : false,
            'puesto' => $horario->numero_puesto != '' ? true : false,
            'actividad' => $actividad->nombre,
            'nivel' => $actividad->nivel,
            'carrera' => $carrera->nombre,
            'paralelo' => $paralelo->nombre,
        ];

        return response()->json($respuesta);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Horario::destroy($id)) {
            return response()->json(array('Eliminado' => true));
        } else {
            return response()->json(array('Eliminado' => false));
        }
    }

    // public function horariolab(string $id, string $dia)
    // {

    //     $diaLetras = '';

    //     switch ($dia) {
    //         case '1':
    //             $diaLetras = 'Lunes';
    //             break;
    //         case '2':
    //             $diaLetras = 'Martes';
    //             break;
    //         case '3':
    //             $diaLetras = 'Miércoles';
    //             break;
    //         case '4':
    //             $diaLetras = 'Jueves';
    //             break;
    //         case '5':
    //             $diaLetras = 'Viernes';
    //             break;
    //     }

    //     $horarios = Horario::where('aula_id', $id)
    //         ->where('dia_semana', $diaLetras)
    //         ->get();


    //     $hojaslab = [];

    //     foreach ($horarios as $horario) {

    //         $actividadNivel = $horario->actividad->nivel;
    //         $carrera = $horario->actividad->carrera->nombre;
    //         $paralelo = $horario->paralelo->nombre;

    //         $docente = $horario->docente->docente;
    //         $materia = $horario->actividad->nombre;
    //         $inicio = $horario->hora_inicio;
    //         $fin = $horario->hora_fin;

    //         $nivel = "{$actividadNivel} {$paralelo} {$carrera}";

    //         $fechaActual = Carbon::now('America/Guayaquil')->format('d-m-Y');

    //         $hojasData = [
    //             'docente' => $docente,
    //             'nivel' => $nivel,
    //             'materia' => $materia,
    //             'inicio' => $inicio,
    //             'fin' => $fin,
    //             'fecha' => $fechaActual
    //         ];

    //         $hojaslab[] = $hojasData;
    //     }

    //     return response()->json(array('horarios' => $hojaslab));
    // }

    // public function horariolab(string $id, string $dia)
    // {
    //     $diaLetras = '';

    //     switch ($dia) {
    //         case '1':
    //             $diaLetras = 'Lunes';
    //             break;
    //         case '2':
    //             $diaLetras = 'Martes';
    //             break;
    //         case '3':
    //             $diaLetras = 'Miércoles';
    //             break;
    //         case '4':
    //             $diaLetras = 'Jueves';
    //             break;
    //         case '5':
    //             $diaLetras = 'Viernes';
    //             break;
    //     }

    //     // Obtén la hora actual usando Carbon
    //     $horaActual = Carbon::now('America/Guayaquil')->format('H:i');

    //     $horarios = Horario::where('aula_id', $id)
    //         ->where('dia_semana', $diaLetras)
    //         ->get();

    //     $hojaslab = [];

    //     foreach ($horarios as $horario) {
    //         // Verifica si el horario tiene un número de puesto
    //         if ($horario->numero_puesto === null) {
    //             $aulaNombre = $horario->aula->nombre;

    //             // Verifica si el nombre del aula contiene "LAB"
    //             if (strpos($aulaNombre, 'LAB') !== false) {
    //                 $actividadNivel = $horario->actividad->nivel;
    //                 $carrera = $horario->actividad->carrera->nombre;
    //                 $paralelo = $horario->paralelo->nombre;

    //                 $docente = $horario->docente->docente;
    //                 $materia = $horario->actividad->nombre;
    //                 $inicio = $horario->hora_inicio;
    //                 $fin = $horario->hora_fin;

    //                 // Verifica si la hora actual está en la primera jornada o en la jornada de tarde
    //                 if ($horaActual >= '07:00' && $horaActual <= '13:00') {
    //                     // Si es la primera jornada, agrega el horario si está dentro del rango
    //                     if ($inicio >= '07:00' && $fin <= '13:00') {
    //                         $nivel = "{$actividadNivel} {$paralelo} {$carrera}";
    //                         $fechaActual = Carbon::now('America/Guayaquil')->format('d-m-Y');
    //                         $hojasData = [
    //                             'docente' => $docente,
    //                             'nivel' => $nivel,
    //                             'materia' => $materia,
    //                             'inicio' => $inicio,
    //                             'fin' => $fin,
    //                             'fecha' => $fechaActual
    //                         ];
    //                         $hojaslab[] = $hojasData;
    //                     }
    //                 } elseif ($horaActual >= '14:00' && $horaActual <= '20:00') {
    //                     // Si es la jornada de tarde, agrega el horario si está dentro del rango
    //                     if ($inicio >= '14:00' && $fin <= '20:00') {
    //                         $nivel = "{$actividadNivel} {$paralelo} {$carrera}";
    //                         $fechaActual = Carbon::now('America/Guayaquil')->format('d-m-Y');
    //                         $hojasData = [
    //                             'docente' => $docente,
    //                             'nivel' => $nivel,
    //                             'materia' => $materia,
    //                             'inicio' => $inicio,
    //                             'fin' => $fin,
    //                             'fecha' => $fechaActual
    //                         ];
    //                         $hojaslab[] = $hojasData;
    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     return response()->json(array('horarios' => $hojaslab));
    // }

    public function horariolab(string $numeroEdificio, string $dia)
    {
        $diaLetras = '';

        switch ($dia) {
            case '1':
                $diaLetras = 'Lunes';
                break;
            case '2':
                $diaLetras = 'Martes';
                break;
            case '3':
                $diaLetras = 'Miércoles';
                break;
            case '4':
                $diaLetras = 'Jueves';
                break;
            case '5':
                $diaLetras = 'Viernes';
                break;
        }

        // Obtener los horarios del día en ese edificio, con las materias
        // y donde numero_puesto esté vacío en la tabla aulas, y el nombre de aula contenga "LAB"
        $horarios = Horario::whereHas('aula', function ($query) use ($numeroEdificio) {
            $query->where('numero_edificio', $numeroEdificio)
                ->where('nombre', 'LIKE', '%LAB%');
        })
            ->where('dia_semana', $diaLetras)
            ->whereNull('numero_puesto')
            ->get();


        $hojaslab = [];

        foreach ($horarios as $horario) {
            $laboratorio = $horario->aula->nombre;
            $actividadNivel = $horario->actividad->nivel;
            $carrera = $horario->actividad->carrera->nombre;
            $paralelo = $horario->paralelo->nombre;
            $docente = $horario->docente->docente;
            $materia = $horario->actividad->nombre;
            $inicio = $horario->hora_inicio;
            $fin = $horario->hora_fin;
            $nivel = "{$actividadNivel} {$paralelo} ";
            $fechaActual = Carbon::now('America/Guayaquil')->format('d-m-Y');

            $hojasData = [
                'laboratorio' => $laboratorio,
                'docente' => $docente,
                'nivel' => $nivel,
                'carrera' => $carrera,
                'materia' => $materia,
                'inicio' => $inicio,
                'fin' => $fin,
                'fecha' => $fechaActual
            ];

            $hojaslab[] = $hojasData;
        }

        return response()->json(array('horarios' => $hojaslab));
    }
}
