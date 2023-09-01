<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aulas = Aula::with(['caracteristicas', 'softwares'])->get();

        return response()->json(array('aulas' => $aulas));
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
        //
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

    public function horario_aula($id)
    {

        // $aulas = Aula::with('puestos.horarios.actividad')->get();

        // return response()->json(array('aulas' => $aulas));
        
        $aula = Aula::find($id);

        $horarios = $aula->horarios()
            ->orderBy('numero_dia', 'asc')
            ->with(['actividad'])
            ->get();


        $horarioLab = [];

        foreach ($horarios as $horario) {

            $materia = $horario->actividad;
            $carrera = $materia->carrera;
            $paralelo = $materia->paralelo;
            $docente = $horario->docente;


            $horarioData = [
                "id" => $horario->id,
                "dia_semana" => $horario->dia_semana,
                "numero_dia" => $horario->numero_dia,
                "hora_inicio" => $horario->hora_inicio,
                "hora_fin" => $horario->hora_fin,
                "aula" => $horario->aula->nombre,
                "edificio" => $horario->aula->edificio,
                "piso" => $horario->aula->piso,
                "materia" => $materia->nombre,
                "nivel" => $materia->nivel,
                "carrera" => $carrera->id,
                "paralelo" => $paralelo->nombre,
                "docente" => $docente->nombres . ' ' . $docente->apellidos,

            ];

            $horarioLab[] = $horarioData;
        }

        return response()->json(["horarios" => $horarioLab]);
    }
}
