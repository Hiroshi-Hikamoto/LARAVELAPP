<?php

namespace App\Http\Controllers;

use App\Models\BaseCallCenter;
use Illuminate\Http\Request;
use App\Models\RegistroEvento;
use DB;

/**
 * Class BaseCallCenterController
 * @package App\Http\Controllers
 */
class BaseCallCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $baseCallCenters = BaseCallCenter::simplePaginate(50);

        // return view('base-call-center.index', compact('baseCallCenters'))
        //     ->with('i', (request()->input('page', 1) - 1) * $baseCallCenters->perPage());

        $registroEventos = RegistroEvento::where('estado',1)
                                            ->orderBy('Fecha_Evento','asc')
                                            ->simplePaginate(50);

        return view('registro-evento.index', compact('registroEventos'))
            ->with('i', (request()->input('page', 1) - 1) * $registroEventos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $baseCallCenter = new BaseCallCenter();
        $id_usuario = auth()->user()->id;
        return view('base-call-center.create', compact('baseCallCenter','id_usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BaseCallCenter::$rules);

        $baseCallCenter = BaseCallCenter::create($request->all());

        return redirect()->route('callCenter.index')
            ->with('success', 'BaseCallCenter created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $baseCallCenter = BaseCallCenter::find($id);

        return view('base-call-center.show', compact('baseCallCenter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // print_r($id);die();
        $baseCallCenter = BaseCallCenter::find($id);
        $id_usuario = auth()->user()->id;
        // print_r($baseCallCenter);die();
        return view('base-call-center.edit', compact('baseCallCenter','id_usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function Llamar($id)
    {
        // print_r($id);die();
        $id_usuario = auth()->user()->id;
        $separarLlamada = DB::update("EXEC [separarLlamada] $id,$id_usuario;");
        // $idLlamar = 
        $separarLlamada = DB::select("select id from web_produccion.dbo.base_call_centers
        where estadoContacto = 100 and id_evento = $id and id_usuario = $id_usuario;");
        $cantReg = sizeof($separarLlamada);
        // print_r(sizeof($separarLlamada));die();
        if ($cantReg ===1){
            $baseCallCenter = BaseCallCenter::find($separarLlamada[0]->id);
            return view('base-call-center.edit', compact('baseCallCenter','id_usuario'));
        }elseif ($cantReg <> 1){
            return redirect()->back()->with('error', 'No hay llamadas pendientes para este evento'); 
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BaseCallCenter $baseCallCenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BaseCallCenter $baseCallCenter)
    {
        
        request()->validate(BaseCallCenter::$rules);
        $id = $request->id;
        // print_r($id);die();
        $BaseCallCenter = BaseCallCenter::findOrFail($id);   
        // print_r($baseCallCenter);die(); 
        $BaseCallCenter->update($request->all());

        // print_r($baseCallCenter);die();
        $baseCallCenter->update($request->all());
        // print_r($baseCallCenter);die();
        return redirect()->route('callCenter.index')
            ->with('success', 'Se han realizado todas las llamades disponibles para este evento');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $baseCallCenter = BaseCallCenter::find($id)->delete();

        return redirect()->route('base-call-centers.index')
            ->with('success', 'BaseCallCenter deleted successfully');
    }
}
