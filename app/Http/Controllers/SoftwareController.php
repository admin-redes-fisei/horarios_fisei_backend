<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSoftwareRequest;
use App\Http\Requests\UpdateSoftwareRequest;
use App\Models\Aula;
use App\Models\Software;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $softwares = Software::with('aula')->get();

        return response()->json(array('softwares' => $softwares));
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
    public function store(StoreSoftwareRequest $request)
    {
        $software = Software::create($request->all());

        $respuesta = [
            'id' => $software->id,
            'nombre' => $software->nombre,
            'version' => $software->version,
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
    public function update(UpdateSoftwareRequest $request, string $id)
    {
        $software = Software::find($id);
        if ($software->update($request->all())) {
            $respuesta = [
                'id' => $software->id,
                'nombre' => $software->nombre,
                'version' => $software->version,
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
        if (Software::destroy($id)) {
            return response()->json(array('Eliminado' => true));
        }
        return response()->json(array('Eliminado' => false));

    }

    public function software_aula($id){

        $aula = Aula::find($id);

        $softwares = $aula->softwares;

        $softwaresLab = [];

        foreach ($softwares as $software){
            $nombre = $software->nombre;
            $version = $software->version;

            $softwaresData = [
                'nombre' => $nombre,
                'version' => $version,
            ];

            $softwaresLab[] = $softwaresData;
        }

        return $softwaresLab;  
    }


}
