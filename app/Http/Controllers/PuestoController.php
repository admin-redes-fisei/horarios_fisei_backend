<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Puesto;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $docenteConHorarios = Docente::with('horarios')->get();

        // return response()->json(['docente' => $docenteConHorarios]);

        $docente = Docente::find(1); // Obtener el docente por su ID
        $docente->horarios; // Obtener los horarios del docente
        $docente->makeHidden('horarios'); // Ocultar los horarios del modelo

        return response()->json(['docente' => $docente]);
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
}
