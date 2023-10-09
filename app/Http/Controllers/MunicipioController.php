<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;
use App\Models\Afiliado;

/**
 * Class MunicipioController
 * @package App\Http\Controllers
 */
class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = Municipio::paginate();

        return view('municipio.index', compact('municipios'))
            ->with('i', (request()->input('page', 1) - 1) * $municipios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipio = new Municipio();
        return view('municipio.create', compact('municipio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Municipio::$rules);

        $municipio = Municipio::create($request->all());

        return redirect()->route('municipios.index')
            ->with('success', 'Municipio created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getMunicipios(Request $request, $id)
    {
        $tipoAccion = $request->tipoAccion;

        if ($tipoAccion == 1) {
            $id_dpt = $request->id;
            $muncipi = Municipio::select('municipio','Mpio')->where('DPT',$id_dpt)->get();
            return response()->json($muncipi);
        }elseif ($tipoAccion == 2) {
            $cedula = $request->cedula;
            $idLider = $request->idLider;
            
            $respuesta = Afiliado::where('cedula', $cedula)
                                ->count();
            return array($respuesta);
            
        }


        
        
    }

    public function validarCedula(Request $request)
    {

        //$id = $request->cedula;
        print_r('$id');die();
        //$respuesta = Afiliado::where('cedula', $id)->pluck();
        //return array($respuesta);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $municipio = Municipio::find($id);

        return view('municipio.edit', compact('municipio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Municipio $municipio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Municipio $municipio)
    {
        request()->validate(Municipio::$rules);

        $municipio->update($request->all());

        return redirect()->route('municipios.index')
            ->with('success', 'Municipio updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $municipio = Municipio::find($id)->delete();

        return redirect()->route('municipios.index')
            ->with('success', 'Municipio deleted successfully');
    }
}
