<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActividadRequest;
use App\Http\Requests\UpdateActividadRequest;
use App\Models\Actividad;
use App\Models\Carrera;
use App\Models\Horario;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actividades = Actividad::with('carrera')->get();

        $actividadesTransformadas = $actividades->map(function ($actividad) {
            return [
                'id' => $actividad->id,
                'nombre' => $actividad->nombre,
                'nivel' => $actividad->nivel,
                'numero_nivel' => $actividad->numero_nivel,
                'id_carrera' => $actividad->carrera->id,
                'carrera' => $actividad->carrera->nombre, // Acceso al nombre de la carrera
                'created_at' => $actividad->created_at,
                'updated_at' => $actividad->updated_at,
            ];
        });

        return response()->json(array('actividades' => $actividadesTransformadas));
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
    public function store(StoreActividadRequest $request)
    {
        $id_carrera = $request->id_carrera;
        $nombre = $request->nombre;
        $nivel = $request->nivel;

        $numero_nivel = 0;
        switch ($nivel) {
            case 'Nivelación':
                $numero_nivel = 0;
                break;
            case 'Primero':
                $numero_nivel = 1;
                break;
            case 'Segundo':
                $numero_nivel = 2;
                break;
            case 'Tercero':
                $numero_nivel = 3;
                break;
            case 'Cuarto':
                $numero_nivel = 4;
                break;
            case 'Quinto':
                $numero_nivel = 5;
                break;
            case 'Sexto':
                $numero_nivel = 6;
                break;
            case 'Septimo':
                $numero_nivel = 7;
                break;
            case 'Octavo':
                $numero_nivel = 8;
                break;
            case 'Noveno':
                $numero_nivel = 9;
                break;
            case 'Decimo':
                $numero_nivel = 10;
                break;
        }

        $carrera = Carrera::find($id_carrera);

        $actividad = Actividad::create([
            'nombre' => $nombre,
            'nivel' => $nivel,
            'carrera_id' => $id_carrera,
            'numero_nivel' => $numero_nivel,
        ]);

        $respuesta = [
            'id' => $actividad->id,
            'nombre' => $actividad->nombre,
            'nivel' => $actividad->nivel,
            'id_carrera' => $actividad->carrera_id,
            'numero_nivel' => strval($actividad->numero_nivel),
            'carrera' => $carrera->nombre
        ];

        return json_encode($respuesta);
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
    public function update(UpdateActividadRequest $request, string $id)
    {

        $actividad = Actividad::find($id);

        $numero_n = 0;
        switch ($request->nivel) {
            case 'Nivelacion':
                $numero_n = 0;
                break;
            case 'Primero':
                $numero_n = 1;
                break;
            case 'Segundo':
                $numero_n = 2;
                break;
            case 'Tercero':
                $numero_n = 3;
                break;
            case 'Cuarto':
                $numero_n = 4;
                break;
            case 'Quinto':
                $numero_n = 5;
                break;
            case 'Sexto':
                $numero_n = 6;
                break;
            case 'Septimo':
                $numero_n = 7;
                break;
            case 'Octavo':
                $numero_n = 8;
                break;
            case 'Noveno':
                $numero_n = 9;
                break;
            case 'Decimo':
                $numero_n = 10;
                break;
        }

        if ($actividad->update(['nombre' => $request->nombre, 'nivel' => $request->nivel, 'carrera_id' => $request->id_carrera, 'numero_nivel' => $numero_n])) {

            $carrera = Carrera::find($actividad->carrera_id);

            $respuesta = [
                'id' => $actividad->id,
                'nombre' => $actividad->nombre,
                'nivel' => $actividad->nivel,
                'id_carrera' => $actividad->carrera_id,
                'numero_nivel' => strval($actividad->numero_nivel),
                'carrera' => $carrera->nombre
            ];


            return json_encode($respuesta);
        }

        return json_encode(array('Error' => 'No se actualizo la Actividad'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $horarios = Horario::where('actividad_id', '=', $id)->get();

        if ($horarios->count() == 0) {
            if (Actividad::destroy($id)) {
                return response()->json(array('Eliminado' => true));
            }
        } else {
            return response()->json(array('Error' => "Hay filas en la tabla horario donde se requiere el Docente"));
        }


        return response()->json(array('Eliminado' => false));
    }
}
