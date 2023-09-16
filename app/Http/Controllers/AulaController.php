<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAulaRequest;
use App\Http\Requests\UpdateAulaRequest;
use App\Models\Aula;
use App\Models\Horario;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aulas = Aula::with(['caracteristicas', 'softwares'])->get();

        // Mapear los resultados para excluir la relación pivot
        $aulasSinPivot = $aulas->map(function ($aula) {
            return [
                'id' => $aula->id,
                'nombre' => $aula->nombre,
                'edificio' => $aula->edificio,
                'numero_edificio' => $aula->numero_edificio,
                'piso' => $aula->piso,
                'numero_piso' => $aula->numero_piso,
                'proyector' => $aula->proyector,
                'aire' => $aula->aire,
                'cantidad_pc' => $aula->cantidad_pc,
                'capacidad' => $aula->capacidad,
                'created_at' => $aula->created_at,
                'updated_at' => $aula->updated_at,
                'caracteristicas' => $aula->caracteristicas->map(function ($caracteristica) {
                    return [
                        'id' => $caracteristica->id,
                        'nombre' => $caracteristica->nombre,
                        'descripcion' => $caracteristica->descripcion
                    ];
                }),
                'softwares' => $aula->softwares->map(function ($software) {
                    return [
                        'id' => $software->id,
                        'nombre' => $software->nombre,
                        'version' => $software->version,
                    ];
                }),
            ];
        });

        return response()->json(['aulas' => $aulasSinPivot]);
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
    public function store(StoreAulaRequest $request)
    {
        $nombre = $request->nombre;
        $edificio = $request->edificio;
        $piso = $request->piso;
        $proyector = $request->proyector;
        $aire = $request->aire;
        $cantidad_pc = $request->cantidad_pc;
        $capacidad = $request->capacidad;

        $numeroP = 0;
        $numeroE = 0;
        switch ($edificio) {
            case 'Edificio 1':
                $numeroE = 1;
                break;
            case 'Edificio 2':
                $numeroE = 2;
                break;
            case 'Edificio Ciencias Aplicadas':
                $numeroE = 3;
                break;

            default:
                $numeroE = 0;
                break;
        }

        switch ($piso) {
            case 'Subsuelo':
                $numeroP = 0;
                break;
            case 'Primero':
                $numeroP = 1;
                break;
            case 'Segundo':
                $numeroP = 2;
                break;
            case 'Tercero':
                $numeroP = 3;
                break;
            case 'Cuarto':
                $numeroP = 4;
                break;
            case 'Quinto':
                $numeroP = 5;
                break;
            case 'Sexto':
                $numeroP = 6;
                break;
            case 'Septimo':
                $numeroP = 7;
                break;

            default:
                $numeroP = 0;
                break;
        }

        $aula = Aula::create([
            'nombre' => $nombre,
            'edificio' => $edificio,
            'piso' => $piso,
            'numero_piso' => $numeroP,
            'numero_edificio' => $numeroE,
            'proyector' => $proyector,
            'aire' => $aire,
            'cantidad_pc' => $cantidad_pc,
            'capacidad' => $capacidad,
        ]);


        $respuesta = [
            'nombre' => $aula->nombre,
            'edificio' => $aula->edificio,
            'piso' => $aula->piso,
            'numero_piso' => $aula->numero_piso,
            'numero_edificio' => $aula->numero_edificio,
            'proyector' => $aula->proyector,
            'aire' => $aula->aire,
            'cantidad_pc' => $aula->cantidad_pc,
            'capacidad' => $aula->capacidad
        ];

        $aulaJSON = json_encode($respuesta);

        return $aulaJSON;
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
    public function update(UpdateAulaRequest $request, string $id)
    {

        $aula = Aula::find($id);

        if ($aula->update($request->all())) {

            $respuesta = [
                'id' => $aula->id,
                'nombre' => $aula->nombre,
                'edificio' => $aula->edificio,
                'piso' => $aula->piso,
                'numero_piso' => $aula->numero_piso,
                'numero_edificio' => $aula->numero_edificio,
                'proyector' => $aula->proyector,
                'aire' => $aula->aire,
                'cantidad_pc' => $aula->cantidad_pc,
                'capacidad' => $aula->capacidad
            ];

            return json_encode($respuesta);
        }

        return json_encode(array('Error' => 'No se actualizo el Aula'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $horarios = Horario::where('aula_id', '=', $id)->get();

        if ($horarios->count() == 0) {
            if (Aula::destroy($id)) {
                return response()->json(array('Eliminado' => true));
            }
        } else {
            return response()->json(array('Error' => "Hay filas en la tabla horario donde se requiere el Docente"));
        }


        return response()->json(array('Eliminado' => false));
    }

    public function horario_aula($id)
    {

        // $aulas = Aula::with('puestos.horarios.actividad')->get();

        // return response()->json(array('aulas' => $aulas));

        $aula = Aula::find($id);

        $horarios = $aula->horarios()
            ->orderBy('numero_dia', 'asc')
            ->get();

        // dd($horarios);
        $horarioLab = [];

        foreach ($horarios as $horario) {

            $materia = $horario->actividad;

            $carrera = $materia->carrera;

            $paralelo = $horario->paralelo;

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
                "carrera" => $carrera->nombre,
                "paralelo" => $paralelo->nombre,
                "docente" => $docente->docente,
            ];

            $horarioLab[] = $horarioData;
        }

        return response()->json(["horarios" => $horarioLab]);
    }
}
