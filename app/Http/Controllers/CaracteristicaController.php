<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaracteristicaRequest;
use App\Http\Requests\UpdateCaracteristicaRequest;
use App\Models\Aula;
use App\Models\Caracteristica;
use Illuminate\Http\Request;

class CaracteristicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $caracteristicas = Caracteristica::all();

        return response()->json(array('caracteristicas' => $caracteristicas));
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
    public function store(StoreCaracteristicaRequest $request)
    {
        $caracteristica = Caracteristica::create($request->all());

        $respuesta = [
            'id' => $caracteristica->id,
            'nombre' => $caracteristica->nombre,
            'descripcion' => $caracteristica->descripcion,
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
    public function update(UpdateCaracteristicaRequest $request, string $id)
    {
        $caracteristica = Caracteristica::find($id);
        if ($caracteristica->update($request->all())) {
            $respuesta = [
                'id' => $caracteristica->id,
                'nombre' => $caracteristica->nombre,
                'descripcion' => $caracteristica->descripcion,
            ];

            return response()->json($respuesta);
        } else {
            return json_encode(array('Error' => 'No se actualizo la Caracteristica'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Caracteristica::destroy($id)) {
            return response()->json(array('Eliminado' => true));
        }
        return response()->json(array('Eliminado' => false));

    }

    public function caracteristicas_aula($id)
    {

        $aula = Aula::find($id);

        $caracteristicas = $aula->caracteristicas;

        $caracteisticaLab = [];
        foreach ($caracteristicas as $caracteristica) {
            $nombre = $caracteristica->nombre;
            $descripcion = $caracteristica->descripcion;

            $caracteristicasData = [
                'nombre' => $nombre,
                'descripcion' => $descripcion
            ];

            $caracteisticaLab[] = $caracteristicasData;
        }

        return $caracteisticaLab;
    }
}
