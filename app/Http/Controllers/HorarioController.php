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

        $horarios = null;

        if (intval($numeroEdificio) == 1) {
            $horarios = Horario::whereHas('aula', function ($query) use ($numeroEdificio) {
                $query->where('numero_edificio', $numeroEdificio)
                    ->where('nombre', 'LIKE', '%LAB%')
                    ->where('aula_id', '!=', 19)
                    ->where('aula_id', '!=', 64);
            })
                ->where('dia_semana', $diaLetras)
                ->whereNull('numero_puesto')
                ->orderBy('hora_inicio', 'desc')
                ->orderBy('aula_id', 'asc')
                ->get();
        } else {
            $horarios = Horario::whereHas('aula', function ($query) use ($numeroEdificio) {
                $query->where('numero_edificio', $numeroEdificio)
                    ->where('nombre', 'LIKE', '%LAB%');
            })
                ->where('dia_semana', $diaLetras)
                ->whereNull('numero_puesto')
                ->orderBy('hora_inicio', 'desc')
                ->orderBy('aula_id', 'asc')
                ->get();
        }

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
