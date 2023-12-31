<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSugerenciaRequest;
use App\Models\Sugerencia;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class SugerenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sugerencias = Sugerencia::with('aula')->get();

        $sugerenciasFormat = $sugerencias->map(function($sugerencia){
            return [
                'id' => $sugerencia->id,
                'nombre' => $sugerencia->nombre,
                'descripcion' => $sugerencia->descripcion,
                'aula' => $sugerencia->aula->nombre
            ];
        });

        return response()->json(array('sugerencias' => $sugerenciasFormat));
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
    public function store(StoreSugerenciaRequest $request)
    {

        try {

            Sugerencia::create($request->all());

           
            return response()->json(array('ok' => true));
    
        } catch (HttpResponseException $exception) {
            return $exception->getResponse();
        }

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
