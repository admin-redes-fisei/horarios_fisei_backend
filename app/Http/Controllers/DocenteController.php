<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocenteRequest;
use App\Http\Requests\UpdateDocenteRequest;
use App\Models\Actividad;
use App\Models\Aula;
use App\Models\Docente;
use App\Models\Horario;
use App\Models\Paralelo;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docentes = Docente::all();

        $formattedData = [];

        foreach ($docentes as $docente) {
            // $titles = $docente->titulos;
            // $fullName = $docente->nombres . ' ' . $docente->apellidos;


            $formattedData[] = array("id" => $docente->id, "docente" => $docente->docente, "cedula" => $docente->cedula);
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
    public function store(StoreDocenteRequest $request)
    {
        $nombre = $request->docente;
        $ced = $request->cedula;

        $docente = Docente::create([
            "docente" => $nombre,
            "cedula" => $ced
        ]);

        $respuesta = [
            "id" => $docente->id,
            "docente" => $docente->docente,
            "cedula" => $docente->cedula
        ];

        $docenteJson = json_encode($respuesta);

        return $docenteJson;
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
    public function update(UpdateDocenteRequest $request, string $id)
    {

        $docente = Docente::find($id);


        if ($docente->update($request->all())) {

            $respuesta = [
                'docente' => $docente->docente,
                'id' => $docente->id,
                'cedula' => $docente->cedula,
            ];


            return json_encode($respuesta);
        }

        return json_encode(array('Error' => 'No se actualizo al docente'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $horarios = Horario::where('docente_id', '=', $id)->get();
        if ($horarios->count() == 0) {
            if (Docente::destroy($id)) {
                return response()->json(array('Eliminado' => true));
            }
        }else{
            return response()->json(array('Error' => "Hay filas en la tabla horario donde se requiere el Docente"));
        }

        return response()->json(array('Eliminado' => false));
    }

    public function horario_docente(string $id)
    {
        $horarios = Docente::find($id)->horarios()
            ->orderBy('numero_dia', 'asc')
            ->get();

        // dd($horarios);

        $horarioInfo = [];

        foreach ($horarios as $horario) {
            
            $aula = Aula::find($horario->aula_id);
            $paralelo = Paralelo::find($horario->paralelo_id);
            $actividad = Actividad::find($horario->actividad_id);
            $carrera = $actividad->carrera;
            

        // dd($horario->numero_puesto);
            $aulaConcatenada = '';
        if ($horario->numero_puesto == '') {
            //Change
            $aulaConcatenada = "{$aula->nombre} - {$aula->edificio} - {$aula->piso} Piso";
        }else{
            $aulaConcatenada = "{$aula->nombre} - {$aula->edificio} - {$aula->piso} Piso - Puesto {$horario->numero_puesto}";
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
                'aula_puesto_info' => $aulaConcatenada,
                'aula' =>  $horario->numero_puesto == '' ? true : false,
                'puesto' => $horario->numero_puesto != '' ? true : false,
                'actividad' => $actividad->nombre,
                'nivel' => $actividad->nivel,
                'carrera' => $carrera->nombre,
                'paralelo' => $paralelo->nombre
            ];

            $horarioInfo[] = $horarioData;
        }

        return response()->json(["horarioInfo" => $horarioInfo]);
    }
}
