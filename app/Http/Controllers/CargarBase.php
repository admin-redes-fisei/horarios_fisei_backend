<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Docente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CargarBase extends Controller
{
    public function cargarDB()
    {
        $resDocentes = $this->cargarDocentes();

        $jsonContentD = $resDocentes->getContent(); // Obtiene el contenido JSON como una cadena
        $dataD = json_decode($jsonContentD, true); // Decodifica el JSON en un array asociativo

        $messageDocentes = $dataD['message'];


        $resMaterias = $this->cargarMaterias();
        
        $jsonContentM = $resMaterias->getContent(); // Obtiene el contenido JSON como una cadena
        $dataM = json_decode($jsonContentM, true); // Decodifica el JSON en un array asociativo

        $messageMaterias = $dataM['message'];

        $response = [
            "Docentes" => $messageDocentes,
            "Materias" => $messageMaterias
        ];
       
        return response()->json($response);
        
    }

    public function cargarDocentes()
    {
        $profesoresCSV = storage_path('app/carga/profesoresCSV.csv');

        if (file_exists($profesoresCSV)) {
            $file = fopen($profesoresCSV, 'r');
            $successCount = 0; // Contador de registros exitosos
            $errorCount = 0;   // Contador de registros con error

            while (($line = fgets($file)) !== false) {
                $data = str_getcsv($line, ';');
                $campo1 = $data[0];
                $campo2 = $data[1];

                // Intenta crear el registro en la base de datos
                $docente = Docente::create([
                    'cedula' => $campo2,
                    'docente' => $campo1,
                ]);

                if ($docente) {
                    $successCount++;
                } else {
                    $errorCount++;
                }
            }

            fclose($file);

            $response = [
                'message' => "Se han cargado $successCount registros con éxito y se produjeron $errorCount errores.",
            ];

            return response()->json($response, JsonResponse::HTTP_OK);
        } else {
            $response = [
                'error' => "El archivo CSV no existe.",
            ];

            return response()->json($response, JsonResponse::HTTP_NOT_FOUND);
        }
    }

    public function cargarMaterias()
    {

        $materiasCSV = storage_path('app/carga/CargaDB.csv');

        if (file_exists($materiasCSV)) {
            $file = fopen($materiasCSV, 'r');
            $successCount = 0; // Contador de registros exitosos
            $errorCount = 0;   // Contador de registros con error

            while (($line = fgets($file)) !== false) {
                $data = str_getcsv($line, ';');
                $campo1 = $data[0];

                // Intenta crear el registro en la base de datos
                $materia = Actividad::create([
                    'nombre' => $campo1,
                ]);

                if ($materia) {
                    $successCount++;
                } else {
                    $errorCount++;
                }
            }

            fclose($file);

            $response = [
                'message' => "Se han cargado $successCount registros con éxito y se produjeron $errorCount errores.",
            ];

            return response()->json($response, JsonResponse::HTTP_OK);
        } else {
            $response = [
                'error' => "El archivo CSV no existe.",
            ];

            return response()->json($response, JsonResponse::HTTP_NOT_FOUND);
        }
    }
}
