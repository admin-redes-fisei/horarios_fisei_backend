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
        // $docente = Docente::find($id)->horarios()->orderBy('numero_dia', 'asc')->get();
        $horarios = Docente::find($id)->horarios()->orderBy('numero_dia', 'asc')->with(['aula', 'puesto', 'puesto.aula'])->get();

        // $horariosOrdenados = $docente

        return response()->json(["horario" => $horarios]);
    }
}
