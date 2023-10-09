<?php

namespace App\Http\Controllers;

use App\Models\Testigo;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Afiliado;
use DB;
use App\Models\PuestosVotacion;
use App\Models\users;

/**
 * Class TestigoController
 * @package App\Http\Controllers
 */
class TestigoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $Departamento = Departamento::orderBy('depto', 'ASC')->pluck('depto','ID_DPT');
        $id_dpto = 31;
        $municipio = Municipio::where('DPT', $id_dpto)->pluck('municipio','ID');
        $puestoVota = PuestosVotacion::where('Dpt',31)
                                   ->where('Mpio',1)
                                   ->where('Zonacomuna',1)->pluck('Puesto','Id');
        $comuna = PuestosVotacion::where('Dpt',31)
                                ->where('Mpio',1)->distinct()->pluck('ZonaComuna','ZonaComuna');

        $testigos = Testigo::where('id_departamento',1000)->simplepaginate(50);

        return view('testigo.index', compact('testigos','Departamento','municipio'))
            ->with('i', (request()->input('page', 1) - 1) * $testigos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $testigo = new Testigo();
        return view('testigo.create', compact('testigo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Testigo::$rules);

        $testigo = Testigo::create($request->all());

        return redirect()->route('testigos.index')
            ->with('success', 'Testigo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $testigo = Testigo::find($id);

        return view('testigo.show', compact('testigo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testigo = Testigo::find($id);

        return view('testigo.edit', compact('testigo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Testigo $testigo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testigo $testigo)
    {
        request()->validate(Testigo::$rules);

        $testigo->update($request->all());

        return redirect()->route('testigos.index')
            ->with('success', 'Testigo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $testigo = Testigo::find($id)->delete();

        return redirect()->route('testigos.index')
            ->with('success', 'Testigo deleted successfully');
    }

    public function selectList(Request $request){
        $tipo = $request->tipo;
        
        if ($tipo == 1){
            $idDepartameto = $request->idDepartameto;
            $muncipi = Municipio::select('municipio','Mpio')->where('DPT',$idDepartameto)->get();
            return response()->json($muncipi);

        }elseif ($tipo == 2) {
            $idDepartameto = $request->idDepartameto;
            $idMunicipio = $request->idMunicipio;
            $zona = PuestosVotacion::select('Zonacomuna','Zonacomuna')->where('Dpt',$idDepartameto)
                                     ->where('Mpio',$idMunicipio )->distinct()->get();
            return response()->json($zona);
        }elseif ($tipo == 3) {
            $idDepartameto = $request->idDepartameto;
            $idMunicipio = $request->idMunicipio;
            $idzona = $request->idZona;
            $puestoVota = PuestosVotacion::where('Dpt',$idDepartameto)
                                       ->where('Mpio',$idMunicipio)
                                       ->where('Zonacomuna',$idzona)->select('Puesto','Pto')->distinct()->get();
            return response()->json($puestoVota);
        }
    }

    public function getMesaVot(Request $request){
        $idDepartameto = $request->idDepartameto;
        $idMunicipio = $request->idMunicipio;
        $idZona = $request->idZona;
        $idPuesto = $request->idPuesto;
        // print_r($idPuesto);die();
        $Departamento = Departamento::orderBy('depto', 'ASC')->pluck('depto','ID_DPT');
        $municipio = Municipio::where('DPT', $idDepartameto)->pluck('municipio','ID');
        $puestoVota = PuestosVotacion::where('Dpt',$idDepartameto)
                                   ->where('Mpio',$idMunicipio)
                                   ->where('Zonacomuna',$idZona )->pluck('Puesto','Id');
        $comuna = PuestosVotacion::where('Dpt',$idDepartameto)
                                ->where('Mpio',$idMunicipio)->distinct()->pluck('ZonaComuna','ZonaComuna');

        $testigos = Testigo::where('id_departamento',$idDepartameto)->where('id_municipio',$idMunicipio)
                            ->where('id_Zona',$idZona)
                            ->where('id_puesto',$idPuesto)->orderBy('mesa', 'ASC')
                            ->simplepaginate(500);

        $tablaHTML =  view('testigo.tablaTestigos', compact('testigos','Departamento','municipio'))
        ->with('i')->render();
        return response()->json(['tabla' => $tablaHTML]);
        
    }
}
