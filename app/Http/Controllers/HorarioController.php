<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Docente;
use App\Models\Horario;
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
    public function store(Request $request)
    {
        

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
        //
    }

    public function horariolab(string $id, string $dia)
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

        $horarios = Horario::where('aula_id', $id)
            ->where('dia_semana', $diaLetras)
            ->get();


        $hojaslab = [];

        foreach ($horarios as $horario) {

            $actividadNivel = $horario->actividad->nivel;
            $carrera = $horario->actividad->carrera->nombre;
            $paralelo = $horario->paralelo->nombre;

            $docente = $horario->docente->docente;
            $materia = $horario->actividad->nombre;
            $inicio = $horario->hora_inicio;
            $fin = $horario->hora_fin;

            $nivel = "{$actividadNivel} {$paralelo} {$carrera}";

            $fechaActual = Carbon::now()->format('d-m-Y');

            $hojasData = [
                'docente' => $docente,
                'nivel' => $nivel,
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
