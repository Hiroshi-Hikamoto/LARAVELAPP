<?php

namespace App\Http\Controllers;

use App\Models\AsistenciaEvento;
use Illuminate\Http\Request;
use App\Models\RegistroEvento;
use App\Models\Afiliado;
use DB;
use Illuminate\Support\Facades\Auth;
/**
 * Class AsistenciaEventoController
 * @package App\Http\Controllers
 */
class AsistenciaEventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            $cedula = auth()->user()->usuario;
            $id_evento = "null";
            $asistenciaEventos = AsistenciaEvento::whereRaw('id_evento in (select id from Registro_Eventos where estado = 1)')
                                ->simplePaginate(500);
            $eventos = RegistroEvento::whereRaw('estado >= 1')
            ->pluck('Nombre_Evento','Id');
                
            $totales = AsistenciaEvento::groupBy(DB::raw("CASE WHEN Referido = 'VINCULADOS' THEN [Referido] ELSE 'OTROS' END"))
        ->selectRaw("CASE WHEN Referido = 'VINCULADOS' THEN [Referido] ELSE 'OTROS' END AS Grupo,COUNT([confirmacion]) AS TotalR,SUM(IIF([confirmacion] = 2,1,0)) AS TotalC")
            ->whereRaw("id_evento in (isnull($id_evento,id_evento))")
            ->orderBy('TotalR','desc')
            ->simplePaginate(1000);

            $totalFooterR = $totales->sum('TotalR');
            $totalFooterC = $totales->sum('TotalC');
            
            return view('asistencia-evento.index', compact('asistenciaEventos','eventos','id_evento','totales','totalFooterR','totalFooterC'))
                ->with('i', (request()->input('page', 1) - 1) * $asistenciaEventos->perPage());
        }
        else{
            return view('auth.login');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asistenciaEvento = new AsistenciaEvento();
        $consulta = RegistroEvento::select('Nombre_Evento', 'Id')
        ->orderBy('Fecha_Evento')
        ->get();
        
        $consulta = RegistroEvento::where('estado',1)
        ->pluck('Nombre_Evento','Id');
        // print_r($consulta);die();
        $tipo = 1;
        return view('asistencia-evento.create', compact('asistenciaEvento','consulta','tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(AsistenciaEvento::$rules);
        // print_r($request->all());die();

        $asistenciaEvento = AsistenciaEvento::create($request->all());
        $resId = $asistenciaEvento->id;
        $data = DB::update("EXEC [actualizar_web_bd] $resId,4;");
        // print_r($asistenciaEvento->id);die();

        return redirect()->route('asistencia-eventos.create')
            ->with('success', 'Se ha registrado exitosamente al evento ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $asistenciaEvento = AsistenciaEvento::find($id);

        // return view('asistencia-evento.show', compact('asistenciaEvento')); 34225

        $asistenciaEvento = new AsistenciaEvento();
        $consulta = RegistroEvento::select('Nombre_Evento', 'Id')
        ->orderBy('Fecha_Evento')
        ->get();
        
        $consulta = RegistroEvento::where('id',34225)
        ->pluck('Nombre_Evento','Id');
        // print_r($consulta);die();
        $tipo = 2;
        return view('asistencia-evento.create', compact('asistenciaEvento','consulta','tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asistenciaEvento = AsistenciaEvento::find($id);

        return view('asistencia-evento.edit', compact('asistenciaEvento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  AsistenciaEvento $asistenciaEvento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AsistenciaEvento $asistenciaEvento)
    {
        request()->validate(AsistenciaEvento::$rules);

        $asistenciaEvento->update($request->all());

        return redirect()->route('asistencia-eventos.index')
            ->with('success', 'AsistenciaEvento updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $asistenciaEvento = AsistenciaEvento::find($id)->delete();

        return redirect()->route('asistencia-eventos.index')
            ->with('success', 'AsistenciaEvento deleted successfully');
    }


    public function ValidarAfiliacion(Request $request)
    {
        $cedula = $request->cedula;
        $evento = $request->evento;
        // print_r($cedula);die();
        $data = DB::select("select (select isnull([Nombre],'') + ' ' + isnull([Segundo_Nombre],'') + ' ' + isnull([Apellido],'') + ' ' + isnull(Segundo_Apellido,'') from Base_de_Datos as t1 where Cedula = $cedula) as Nom_Completo
        ,(select cast(celular as bigint) from Base_de_Datos as t1 where Cedula = $cedula) as celular
        ,(select Direccion from Base_de_Datos as t1 where Cedula = $cedula) as Direccion
        ,(select correo from Base_de_Datos as t1 where Cedula = $cedula) as correo
        ,(select cast(cast(Fecha_Nacimiento as date) as varchar(50)) from Base_de_Datos as t1 where Cedula = $cedula) as Fecha_Nacimiento
        ,(select referido_por from Base_de_Datos as t1 where Cedula = $cedula) as lider
        ,(select COUNT(*) from Asistencia_Eventos as t3 where t3.Cedula = $cedula and t3.id_evento = $evento) as resgistrado;");

        return $data;
        // print_r($data);die();
    }

    public function Validador()
    {
        $cedula = auth()->user()->usuario;
        $data = DB::select("select top 1 * from colabeventos where cedula = '$cedula';");
        $idEvento = $data[0]->id_evento;
        // print_r($idEvento);die();
        if ($idEvento > 10){
            return view('asistencia-evento.edit', compact('idEvento'));
        }else{
            return "Usuarion no tiene acceso a esta funcion";
        }
        
    }

    public function validarAsistencia(Request $request)
    {
        $accion = $request->accion;
        $cedula = $request->cedula;
        $evento = $request->evento;
        // print_r($evento);die();
        if ($accion == 1) {
            $data = DB::select("select top 1 * from Asistencia_Eventos where cedula = '$cedula' and id_evento = $evento;");
            return $data;
        }elseif ($accion == 2){
            // print_r('llego a la accion 2');die();
            // $data = DB::update("update Asistencia_Eventos set confirmacion = 2 where cedula = '$cedula' and id_evento = '$evento';");
            $data = AsistenciaEvento::where('cedula','=',$cedula/*,'id_evento',,$evento*/)
                                    ->where('id_evento',$evento)
                                    ->update(['confirmacion'=>2]);
            // print_r($data);die();
            return $data;
        }

        

    }

    public function buscadorEventos(Request $request)
    {
        if (Auth::check()){
        $id_evento = $request->id_evento; 
        // print_r($id_evento);die();
        $asistenciaEventos = AsistenciaEvento::where('id_evento',$id_evento)
                                             ->orderBy('confirmacion','desc')
                                             ->simplePaginate(1000); 
        $eventos = RegistroEvento::whereRaw('estado >= 1')
                                ->pluck('Nombre_Evento','Id');   

        $mes = DB::select("SELECT TOP 1 MONTH(b.Fecha_Evento) MES FROM Registro_Eventos as b WHERE Id = $id_evento;");                                 
        // $mes = RegistroEvento::whereRaw('estado',$id_evento)->selectRaw("month(Fecha_Evento) as MES");
        $mes = $mes[0]->MES;
        // ddd($mes);
        $totales = AsistenciaEvento::groupBy(DB::raw("CASE WHEN MONTH([Fecha_nacimiento]) = $mes THEN 'CUMPLEAÑEROS' ELSE 'ACOMPAÑANTES' END"))
        ->selectRaw("CASE WHEN MONTH([Fecha_nacimiento]) = $mes THEN 'CUMPLEAÑEROS' ELSE 'ACOMPAÑANTES' END AS Grupo,COUNT([confirmacion]) AS TotalR,SUM(IIF([confirmacion] = 2,1,0)) AS TotalC")
        ->whereRaw("id_evento in (isnull($id_evento,id_evento))")
        ->orderBy('TotalR','desc')
        ->simplePaginate(1000);

        $totalFooterR = $totales->sum('TotalR');
        $totalFooterC = $totales->sum('TotalC');
                                                                                          

        return view('asistencia-evento.index', compact('asistenciaEventos','id_evento','eventos','totales','totalFooterR','totalFooterC'))
            ->with('i', (request()->input('page', 1) - 1) * $asistenciaEventos->perPage());
        }
        else{
            return view('auth.login');
        }
    }    
}
