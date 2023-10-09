<?php

namespace App\Http\Controllers;

use App\Models\Lidere;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\TipoRelacion;
use App\Models\Afiliado;
use DB;
use App\Models\PuestosVotacion;
use App\Models\users;

use  PHPUnit\Framework\isNull;

/**
 * Class LidereController
 * @package App\Http\Controllers
 */
class LidereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idLider = auth()->user()->id;
        //print_r($idLider);die();
        $perfil = auth()->user()->perfil;
        if ($perfil == 1) {
            $lideres = Lidere::orderBy('nom_completo', 'asc')
                        ->simplePaginate(50);
        } else {
            $lideres = Lidere::where('cod_coordinador', $idLider)
                        ->orderBy('nom_completo', 'asc')
                        ->simplePaginate(200);
        }
        
        

        return view('lidere.index', compact('lideres'))
            ->with('i', (request()->input('page', 1) - 1) * $lideres->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lidere = new Lidere();
        $Departamento = Departamento::pluck('depto','ID_DPT');
        $id_dpto = 31;
        $municipio = Municipio::where('DPT', $id_dpto)->pluck('municipio','ID');
        $TipoRelacion = TipoRelacion::where('Observacion','2')->pluck('Tipo','Id');
        $puestoVota = PuestosVotacion::where('Dpt',31)
                                   ->where('Mpio',1)
                                   ->where('Zonacomuna',1)->pluck('Puesto','Id');
        $comuna = PuestosVotacion::where('Dpt',31)
                                ->where('Mpio',1)->distinct()->pluck('ZonaComuna','ZonaComuna');
        return view('lidere.create', compact('lidere','Departamento','municipio','TipoRelacion','comuna','puestoVota'));
    }

    public function getLider(Request $request)
    {
        $tipoAccion = $request->tipoAccion;
        if ($tipoAccion == 1) {
            $id_dpt = $request->id;
            $muncipi = Municipio::select('municipio','Mpio')->where('DPT',$id_dpt)->get();
            return response()->json($muncipi);
        }elseif ($tipoAccion == 2) {
            $cedula = $request->cedula;
            $queryResult = DB::select("select Cedula, rtrim(ltrim(isnull(Nombre,'') + ' ' + isnull(Segundo_Nombre,'') + ' ' + isnull(Apellido,'') + ' ' + isnull(Segundo_Apellido,''))) as Nombre_completo, celular from Base_de_Datos where cedula in (?)", [$cedula]);
            $result = collect($queryResult);
            $array = json_decode(json_encode($result), true);
            return $array;
            // return array($respuesta);
            
        }
        
    }


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
            
        }elseif ($tipoAccion == 3) {
            $dep = $request->Departamento;
            $mumi = $request->Municipio;
            //print_r($dep);die();
            $queryResult = DB::select("SELECT distinct ZonaComuna,ZonaComuna FROM Puestos_Votacions where Dpt in(isnull($dep,Dpt)) and Mpio in(isnull($mumi,Mpio)) order by 1 asc", [$dep,$mumi]);
            $result = collect($queryResult);
            return $result;
            
        }elseif ($tipoAccion == 4) {
            $dep = $request->Departamento;
            $mumi = $request->Municipio;
            $ZoCo = $request->ZonaComuna;
            $queryResult = DB::select("SELECT distinct Puesto,Id FROM Puestos_Votacions where Dpt in(isnull($dep,Dpt)) and Mpio in(isnull($mumi,Mpio)) and ZonaComuna in(isnull($ZoCo,ZonaComuna))", [$dep,$mumi,$ZoCo]);
            $result = collect($queryResult);
            return $result;
            
        }


        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Lidere::$rules);

        $lidere = Lidere::create($request->all());

        return redirect()->route('lidere.index')
            ->with('success', 'Lidere created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lidere = Lidere::find($id);

        return view('lidere.show', compact('lidere'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lidere = Lidere::find($id);
        $Departamento = Departamento::pluck('depto','ID_DPT');
        $id_dpto = $lidere->Org_departamento;
        $id_ciudad = $lidere->Org_Ciudad;
        $id_comuna = $lidere->Org_Comuna;
        $id_cpuesto = $lidere->Puesto_Votacion;

        $municipio = Municipio::where('DPT', $id_dpto)->pluck('municipio','ID');
        $TipoRelacion = TipoRelacion::where('Observacion','2')->pluck('Tipo','Id');
        $puestoVota = PuestosVotacion::where('Dpt',$id_dpto)
                                   ->where('Mpio',$id_ciudad)
                                   ->where('Zonacomuna',$id_comuna)->pluck('Puesto','Id');
        $comuna = PuestosVotacion::where('Dpt',31)
                                ->where('Mpio',1)->distinct()->pluck('ZonaComuna','ZonaComuna');
        $cedula = $lidere->Cedula;  
        $consulta = DB::select("SELECT foto FROM [Lideres] where Cedula in ($cedula);"); 
        $foto = $consulta[0]->foto;
        //print_r($foto);die();
        if ($foto == '') {
            $foto = 'fotoPerfil/perfilDefault.png';
        };
        return view('lidere.edit', compact('lidere','Departamento','municipio','TipoRelacion','comuna','puestoVota','foto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Lidere $lidere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lidere $lidere)
    {
        request()->validate(Lidere::$rules);

        $lidere->update($request->all());

        return redirect()->route('lidere.index')
            ->with('success', 'Lidere updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
  
        
        $lidere = Lidere::where('Cedula',$id)->delete();

        return redirect()->route('lidere.index')
            ->with('success', 'Lidere deleted successfully');
    }

    public function buscador(Request $request)
    {
        $nombre = $request->nombre;
        $idLider = auth()->user()->id;
        $lideres = Lidere::where('nom_completo', 'LIKE', "%{$nombre}%")
                    ->orWhere('cedula', 'LIKE', "%{$nombre}%")
                    // ->orWhere('cod_coordinador','=' ,$idLider)
                    ->orderBy('nom_completo', 'asc')
                    ->simplePaginate(10);
       
        return view('lidere.index', compact('lideres'))
           ->with('i', (request()->input('page', 1) - 1) * $lideres->perPage());
    }
}
