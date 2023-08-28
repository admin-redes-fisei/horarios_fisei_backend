<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docentes = Docente::with('titulos')->get();

        $formattedData = [];

        foreach ($docentes as $docente) {
            $titles = $docente->titulos;
            $formattedTitle = '';
            $fullName = $docente->nombres . ' ' . $docente->apellidos;

            $titleIds = $titles->pluck('id')->toArray();

            if (in_array(3, $titleIds)) {
                $formattedTitle = 'Ing. ' . $fullName . ', PhD.';
            } elseif (in_array(1, $titleIds) && in_array(2, $titleIds)) {
                $formattedTitle = 'Ing. ' . $fullName . ', Mg.';
            } elseif (in_array(1, $titleIds)) {
                $formattedTitle = 'Ing. ' . $fullName;
            }

            $formattedData[] = array("id" => $docente->id, "nombre" => $formattedTitle);
        }

        return response()->json(array("docentes" => $formattedData));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json(["hola" => true]);
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

    public function horario_docente($id)
    {
        $horarios = Docente::find($id)->horarios()
            ->orderBy('numero_dia', 'asc')
            ->with(['aula', 'puesto', 'puesto.aula'])
            ->get();
    
        $horarioInfo = [];
    
        foreach ($horarios as $horario) {
            $aula = $horario->aula;
            $puesto = $horario->puesto;
            $actividad = $horario->actividad; 
    
            $aulaConcatenada = '';
            if ($aula) {
                $aulaConcatenada = "{$aula->nombre} - {$aula->edificio} - {$aula->piso}";
            }
    
            $puestoConcatenado = '';
            if ($puesto) {
                $puestoConcatenado = "P{$puesto->numero_puesto} - {$puesto->aula->nombre} - {$puesto->aula->edificio} - {$puesto->aula->piso}";
            }
    
            $horarioData = [
                'id' => $horario->id,
                // 'actividad_id' => $horario->actividad_id,
                // 'docente_id' => $horario->docente_id,
                // 'periodo_id' => $horario->periodo_id,
                'dia_semana' => $horario->dia_semana,
                'numero_dia' => $horario->numero_dia,
                'hora_inicio' => $horario->hora_inicio,
                'hora_fin' => $horario->hora_fin,
                // 'created_at' => $horario->created_at,
                // 'updated_at' => $horario->updated_at,
                'aula_puesto_info' => $aulaConcatenada ? $aulaConcatenada : ($puestoConcatenado ? $puestoConcatenado : 'N/A'),
                'aula' => $aula ? true : false,
                'puesto' => $puesto ? true : false,
                'actividad' => $actividad->nombre,
            ];
    
            $horarioInfo[] = $horarioData;
        }
    
        return response()->json(["horarioInfo" => $horarioInfo]);
    }
    
}
