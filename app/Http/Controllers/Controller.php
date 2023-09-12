<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // public function horario()
    // {

    //     // Ruta al archivo CSV
    //     $rutaArchivoOriginal = storage_path('app/archivos/hora.csv');

    //     // Verificar si el archivo existe
    //     if (file_exists($rutaArchivoOriginal)) {
    //         // Leer el contenido del archivo CSV
    //         $contenidoCSV = file_get_contents($rutaArchivoOriginal);

    //         // Parsear, limpiar y filtrar las filas CSV
    //         $filasCSV = explode("\n", $contenidoCSV);

    //         $filasLimpias = [];

    //         foreach ($filasCSV as $fila) {
    //             $datos = str_getcsv($fila, ';'); // Parsea la fila en datos usando ';' como delimitador

    //             // Filtra las filas que no contengan "Sin clase" ni "("
    //             if (!in_array('Sin clase', $datos) && strpos($fila, '(') === false) {
    //                 // Filtra los elementos vacíos o en blanco y los une con ','
    //                 $filaLimpia = implode(',', array_filter($datos, function ($valor) {
    //                     return !empty(trim($valor));
    //                 }));
    //                 $filasLimpias[] = $filaLimpia;
    //             }
    //         }

    //         // Crear un nuevo archivo CSV con las filas limpias
    //         $rutaArchivoResultado = storage_path('app/archivos/resultado.csv');

    //         $csvFile = fopen($rutaArchivoResultado, 'w');
    //         foreach ($filasLimpias as $filaLimpia) {
    //             fputcsv($csvFile, explode(',', $filaLimpia));
    //         }
    //         fclose($csvFile);

    //         // Devolver el archivo CSV resultante como respuesta para su descarga
    //         return response()->download($rutaArchivoResultado)->deleteFileAfterSend(true);
    //     } else {
    //         return "El archivo CSV original no existe.";
    //     }
    // }

    public function horario()
    {
        // Ruta al archivo CSV original
        $rutaArchivoOriginal = storage_path('app/archivos/hora.csv');

        // Verificar si el archivo existe
        if (file_exists($rutaArchivoOriginal)) {
            // Leer el contenido del archivo CSV
            $contenidoCSV = file_get_contents($rutaArchivoOriginal);

            // Parsear, limpiar y filtrar las filas CSV
            $filasCSV = explode("\n", $contenidoCSV);

            $filasLimpias = [];

            foreach ($filasCSV as $fila) {
                $datos = str_getcsv($fila, ';'); // Parsea la fila en datos usando ';' como delimitador

                // Filtra las filas que no contengan "Sin clase" ni "("
                if (!in_array('Sin clase', $datos) && strpos($fila, '(') === false) {
                    // Filtra los elementos vacíos o en blanco y los une con ','
                    $filaLimpia = implode(',', array_filter($datos, function ($valor) {
                        return !empty(trim($valor));
                    }));
                    $filasLimpias[] = $filaLimpia;
                }
            }

            // Crear un nuevo archivo CSV con las filas limpias
            $rutaArchivoResultado = storage_path('app/archivos/horarioCSV.csv');

            $csvFile = fopen($rutaArchivoResultado, 'w');
            foreach ($filasLimpias as $filaLimpia) {
                // Escritura personalizada sin comillas
                fwrite($csvFile, $filaLimpia . "\n");
            }
            fclose($csvFile);

            // Devolver el archivo CSV resultante como respuesta para su descarga
            return response()->download($rutaArchivoResultado)->deleteFileAfterSend(true);
        } else {
            return "El archivo CSV original no existe.";
        }
    }


    public function asignaturas()
    {

        // Ruta al archivo CSV original
        $rutaArchivoOriginal = storage_path('app/archivos/asignaturas.csv');

        // Verificar si el archivo existe
        if (file_exists($rutaArchivoOriginal)) {
            // Leer el contenido del archivo CSV
            $contenidoCSV = file_get_contents($rutaArchivoOriginal);

            // Dividir el contenido en filas
            $filasCSV = explode("\n", $contenidoCSV);

            // Filtrar filas que no contienen "(PAE)" y eliminar los puntos y comas al final
            $filasModificadas = [];
            foreach ($filasCSV as $fila) {
                if (strpos($fila, 'PAE') === false && !empty(trim($fila))) {
                    // Conservar solo los dos primeros campos (Asignatura y Abreviatura)
                    $campos = explode(';', $fila);
                    $filaModificada = implode(';', array_slice($campos, 1, 2));

                    // Agregar la fila modificada al array
                    $filasModificadas[] = $filaModificada;
                }
            }

            // Unir las filas modificadas en un solo texto
            $contenidoModificado = implode("\n", $filasModificadas);

            // Crear un nuevo archivo CSV con las modificaciones
            $rutaArchivoResultado = storage_path('app/archivos/asignaturas_modificado.csv');
            file_put_contents($rutaArchivoResultado, $contenidoModificado);

            // Devolver el archivo CSV resultante como respuesta para su descarga
            return response()->download($rutaArchivoResultado)->deleteFileAfterSend(true);
        } else {
            return "El archivo CSV original no existe.";
        }
    }

    public function profesores()
    {

        // Ruta al archivo CSV original
        $rutaArchivoOriginal = storage_path('app/archivos/profesores.csv');

        // Verificar si el archivo existe
        if (file_exists($rutaArchivoOriginal)) {
            // Leer el contenido del archivo CSV
            $contenidoCSV = file_get_contents($rutaArchivoOriginal);

            // Dividir el contenido en filas
            $filasCSV = explode("\n", $contenidoCSV);

            // Filtrar filas que no contienen "(PAE)" y eliminar los puntos y comas al final
            $filasModificadas = [];
            foreach ($filasCSV as $fila) {
                // Eliminar espacios en blanco al inicio y al final de la fila
                $fila = trim($fila);
                if (!empty($fila)) {
                    // Conservar solo los dos primeros campos (Nombre y Abreviatura)
                    $campos = explode(';', $fila);
                    $nombre = $campos[1];
                    $abreviatura = $campos[2];

                    // Crear la fila modificada
                    $filaModificada = "$nombre;$abreviatura";

                    // Agregar la fila modificada al array
                    $filasModificadas[] = $filaModificada;
                }
            }

            // Unir las filas modificadas en un solo texto
            $contenidoModificado = implode("\n", $filasModificadas);

            // Crear un nuevo archivo CSV con las modificaciones
            $rutaArchivoResultado = storage_path('app/archivos/profesoresCSV.csv');
            file_put_contents($rutaArchivoResultado, $contenidoModificado);

            // Devolver el archivo CSV resultante como respuesta para su descarga
            return response()->download($rutaArchivoResultado)->deleteFileAfterSend(true);
        } else {
            return "El archivo CSV original de docentes no existe.";
        }
    }
}
