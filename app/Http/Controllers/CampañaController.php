<?php

namespace App\Http\Controllers;

use App\Models\Campaña;
use Illuminate\Http\Request;
use DB;
use App\Events\bingoEvento;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Bingo;
/**
 * Class CampañaController
 * @package App\Http\Controllers
 */
class CampañaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $campañas = Campaña::where('id_usuario',$id)
                    ->simplePaginate(10);

        return view('campaña.index', compact('campañas'))
            ->with('i', (request()->input('page', 1) - 1) * $campañas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idUsuario = auth()->user()->id;
        $estado = 1;
        // print_r($idUsuario);die();
        $campaña = new Campaña();
        return view('campaña.create', compact('campaña','idUsuario','estado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Campaña::$rules);

        $campaña = Campaña::create($request->all());

        return redirect()->route('campañas.index')
            ->with('success', 'Campaña created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaña = DB::table("vistaResultadoEnvios")->where('id_campaña',$id)->simplePaginate(10000);
        // print_r($campaña);die();
        

        return view('campaña.show', compact('campaña'))
        ->with('i', (request()->input('page', 1) - 1) * $campaña->perPage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campaña = Campaña::find($id);
        $numeros = DB::select("select (Empresa + ' - ' + descripcion) as EnviarDesde,id from AVA.dbo.Parametro where estado = 1; ");
        $numero = DB::table('Parametro')->select(DB::raw("CONCAT(Empresa,' - ',descripcion) AS EnviarDesde"),'id')->where('estado', 1)->pluck("EnviarDesde","id");
        // $numero = collect($numeros);
        // print_r($campaña);die();
        return view('campaña.edit', compact('campaña','numero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Campaña $campaña
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaña $campaña)
    {
        // request()->validate(Campaña::$rules);
        
        $id = $request->id;
        $campaña = Campaña::find($id);
        
        $campaña->update($request->all());
        // print_r($campaña);die();
        return redirect()->route('campana.index')
            ->with('success', 'Campaña configurada');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        
        // print_r($id);die();
        // $campaña = Campaña::find($id)->delete();
        $campaña = DB::update("EXEC [AVA].[dbo].[btnEnviar] @idCampaña = N'$id'");
        return redirect()->route('campana.index')
            ->with('success', 'Enviando campaña');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request)
    {
        $campaña = Campaña::find($id);

        return view('campaña.report', compact('campaña'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function bingo(Request $request)
    {
        $id = $request->id;
        $idTabla = DB::select("select * from participantesBingo where id = $id");
        $datosParticipante = $idTabla[0];
        $idTabla = $datosParticipante->id_tabla_bingo;
        $idBingo = $datosParticipante->id_bingo;
        // print_r($datosParticipante);die();
        $data = DB::select("select * from tbBingoConte where num_tabla in ($idTabla) order by orden;");
        $tipo_juego = DB::select("select opcion_ganar from jugarBingo where id_bingo = $idBingo and estado = 'jugando';");
        $tipo_juego = $tipo_juego[0]->opcion_ganar;
        // print_r($tipo_juego[0]->opcion_ganar);die();
        $recuento = count($data);
        return view('bingo.misTablas', compact('data','recuento','id','idTabla','datosParticipante','idBingo','tipo_juego'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function Adminbingo(Request $request)
    {
        $data = DB::select("SELECT  min(num_tabla) id,b,b+15 i,b+30 n ,b+45 g ,b+60 o FROM [AVA].[dbo].[tbBingoConten] group by b;");
        // print_r($request->id);die();
        $idBingo = $request->id;
        $Nombre = DB::select("SELECT  Nombre FROM [AVA].[dbo].[Bingos] where id = $idBingo;");
        $Nombre = $Nombre[0]->Nombre;
        $recuento = count($data);
        // print_r($Nombre);die();
        return view('bingo.adminBingo', compact('data','recuento','idBingo','Nombre'));
    }

    public function cantarBingo(Request $request){

        $id = $request->id;
        $data = DB::select("SET NOCOUNT ON DECLARE	@return nvarchar(20) EXEC [dbo].[cantarBingo] $id, @return = @return OUTPUT SELECT	@return as N'return';");
        $respuesta = $data[0]->return;
        // print_r($data[0]->return);die();
        return $respuesta;
    }
    

    public function cargarArchivo(Request $request)
    {
        // Valida el archivo
        $request->validate([
            'archivo' => 'required|mimes:csv,txt|max:2048',
        ]);

        //guardar Archivo
        $archivo = $request->file('archivo');
        $patch = Storage::putFileAs(
            'archivos',
            $archivo,
            str_replace([' ', ':'], '', $archivo->getClientOriginalName())
        );
        print_r($patch);die();
        //generar vista previa
        Excel::import(new UsersImport, 'users.xlsx');
    }
    

    public function listenBingo(Request $request)
    {
        $tipo = $request->tipo;
        $id_bingo = $request->id_bingo;
        // print_r($id_bingo);die();
        if ($tipo == 1){
            $data = DB::select("select top 1 * from [AVA].[dbo].[ganadoresBingos] where [id_bingo] = $id_bingo and estado = 'ganador' order by id asc;");
            $recuento = count($data);
            if ($recuento > 0) {
                return $data[0]->id;
            }else{
                return 0;
            }
        }
        if ($tipo == 2){
            $data = DB::update("update [AVA].[dbo].[ganadoresBingos] set estado = 'notificado' where [id_bingo] = $id_bingo and estado = 'ganador';");
            return $data;
        }
        
        if ($tipo == 3){
            $numero = $request->numero;
            $data = DB::update("EXEC [AVA].[dbo].[balotasBingo] $id_bingo,$numero,$tipo;");
            return $data;
        }
        
        if ($tipo == 4){
            $numero = $request->numero;
            $data = DB::update("EXEC [AVA].[dbo].[balotasBingo] $id_bingo,$numero,$tipo;");
            return $data;
        }
    }
    
    

    public function jugar(Request $request)
    {

        $id_bingo = $request->id_bingo;
        $juego = $request->juego;
        $data = DB::update("update jugarBingo set fecActualizacion = GETDATE(),estado = 'Finalizado' where id_bingo = $id_bingo and estado = 'Jugando' 
        insert into jugarBingo select $id_bingo id_bingo,$juego opcion_ganar,'Jugando' estado,GETDATE() fecCreacion,null fecActualizacion;");
        // print_r($data);die();
        return $data;
    }
}
