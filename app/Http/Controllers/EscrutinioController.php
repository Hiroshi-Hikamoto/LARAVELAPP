<?php

namespace App\Http\Controllers;

use App\Models\Escrutinio;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class EscrutinioController
 * @package App\Http\Controllers
 */
class EscrutinioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Cedula = auth()->user()->usuario; 
        $escrutinios = Escrutinio::where('cedula_testigo', $Cedula)
                    ->orderBy('fec_creacion', 'desc')
                    ->simplePaginate(50);
        // $escrutinios = Escrutinio::paginate();

        return view('escrutinio.index', compact('escrutinios'))
            ->with('i', (request()->input('page', 1) - 1) * $escrutinios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Cedula = auth()->user()->usuario; 
        $idPuestoVotacion = DB::select("SELECT id_puesto FROM [testigoElectoral] where cedula in ($Cedula);");
       
        if (empty($idPuestoVotacion)) {
            $idPuestoVotacionNum = "";
        } else {
            $idPuestoVotacionNum = $idPuestoVotacion[0]->id_puesto;
            $nombrePuesto = DB::select("SELECT Puesto FROM [Puestos_de_Votacion] where id in ($idPuestoVotacionNum);");
            $nombrePuesto = $nombrePuesto[0]->Puesto;
        }

        // print_r($nombrePuesto);die();
        $escrutinio = new Escrutinio();
        return view('escrutinio.create', compact('escrutinio','nombrePuesto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Cedula = auth()->user()->usuario; 
        $idPuestoVotacion = DB::select("SELECT id_puesto FROM [testigoElectoral] where cedula in ($Cedula);");
        $idPuestoVotacionNum = $idPuestoVotacion[0]->id_puesto;
        $votosCamara = $request->votos_camara;
        $votosSenado = $request->votos_senado;
        $numMesa = $request->num_mesa;
        
        
        if ($request->file('foto_camara') == null) {
            $path = "";
        } else {
            $path = $request->file('foto_camara')->store(
                'escrutinioCamara', 'public'
            );
        }
        
        if ($request->file('foto_senado') == null) {
            $path2 = "";
        } else {
            $path2 = $request->file('foto_senado')->store(
                'escrutinioSenado', 'public'
            );
        }
        
        
        if ($votosCamara == null) {
            $votosCamara = 0;
        }
        
        if ($votosSenado == null) {
            $votosSenado = 0;
        }
        
        
        $insert = DB::update("insert into escrutinios select $Cedula as cedula_testigo,$idPuestoVotacionNum as id_puesto,$numMesa num_mesa,$votosCamara as votos_camara,'" .$path ."' as foto_camara,GETDATE() as fec_creacion,$votosSenado as votos_senado,'" .$path2 ."' as foto_Senado;");

        // request()->validate(Escrutinio::$rules);

        // $escrutinio = Escrutinio::create($request->all());

        // print_r($path);die();
        return redirect()->route('escrutinio.index')
            ->with('success', 'Escrutinio created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $escrutinio = Escrutinio::find($id);

        return view('escrutinio.show', compact('escrutinio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $escrutinio = Escrutinio::find($id);

        return view('escrutinio.edit', compact('escrutinio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Escrutinio $escrutinio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Escrutinio $escrutinio)
    {
        request()->validate(Escrutinio::$rules);

        $escrutinio->update($request->all());

        return redirect()->route('escrutinios.index')
            ->with('success', 'Escrutinio updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $escrutinio = Escrutinio::find($id)->delete();

        return redirect()->route('escrutinios.index')
            ->with('success', 'Escrutinio deleted successfully');
    }
}
