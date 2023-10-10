<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ImportTestigos;
use Maatwebsite\Excel\Facades\Excel;
use App\models\Cargatestigo;
use Illuminate\Support\Facades\Auth;


class ArchivoController extends Controller
{


    public function importar(Request $request)
{
    
    $idUser = auth()->user()->id;
    //Aqui debo generar la tabla con campos: Id/NombreArchivo/idUser

    if ($request->hasFile('archivo')) {
        $file = $request->file('archivo');
        $path = $file->getRealPath();
        
        if (($handle = fopen($path, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                Cargatestigo::create([
                    'Cedula' => $data[0],
                    'PrimerNombre' => $data[1],
                    'SegundoNombre' => $data[2],
                    'PrimerApellido' => $data[3],
                    'SegundoApellido' => $data[4],
                    'Celular' => $data[5],
                    'Correo' => $data[6],
                    'Departamento' => $data[7],
                    'Municipio' => $data[8],
                    'Zona' => $data[9],
                    'Puesto' => $data[10],
                    'Mesa' => $data[11]
                    //Aqui debo relacionar el ID 
                ]);
            }
            fclose($handle);
        }
    }
    return back()->with('success', 'Datos importados exitosamente.');
}

}




 
