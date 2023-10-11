<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ImportTestigos;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Cargatestigo;
use App\Models\idCargueArchivo;
use Illuminate\Support\Facades\Auth;
use DB;


class ArchivoController extends Controller
{


    public function importar(Request $request)
{

    $nombreArchivo = $request->file('archivo')->getClientOriginalName();

    $idUser = auth()->user()->id;    
    //Aqui debo generar la tabla con campos: Id/NombreArchivo/idUser
    // $idCargue = DB::update("insert into CargueArchivo select '$nombreArchivo' as NombreArchivo,$idUser as idUser");
    $idCargue = DB::table('CargueArchivo')->insertGetId([
        'NombreArchivo' => $nombreArchivo,
        'idUser' => $idUser
    ]);
    $idArchivo = $idCargue;

    if ($request->hasFile('archivo')) {
        $file = $request->file('archivo');
        $path = $file->getRealPath();
        
        if (($handle = fopen($path, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                Cargatestigo::create([
                    'idCargueArchivo' => $idArchivo,
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
                ]);
            }
            fclose($handle);
        }
    }
    $insertTestigo = DB::update("EXEC	[dbo].[insertTestigos] @idCargue = $idArchivo");
    return back()->with('success', 'Datos importados exitosamente.');
}

}