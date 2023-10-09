<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use Illuminate\Http\Request;
use App\Models\Eliminado;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Apoyo;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use DataTables;
use App\Exports\afiliadosExports;
use Maatwebsite\Excel\Facades\Excel;


/**
 * Class AfiliadoController
 * @package App\Http\Controllers
 */
class AfiliadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idLider = auth()->user()->usuario;
        $afiliados = Afiliado::where('lider', $idLider)
                    ->whereNotIn('estado', [9,10])
                    ->orderBy('Primer_Nombre', 'asc')
                    ->simplePaginate(50);
        $totalFYA = Afiliado::where('lider', $idLider)
                    ->whereNotIn('estado', [9,10])
                    ->count();        
        $consulta = DB::select("SELECT count(*) cant FROM [afiliados] where lider in (select Cedula from [afiliados] where lider = $idLider and cedula != $idLider) and estado != 9;"); 
        $totalOtros = $consulta[0]->cant;                                  

        return view('afiliado.index', compact('afiliados','totalFYA','totalOtros'))
            ->with('i', (request()->input('page', 1) - 1) * $afiliados->perPage());
    }

    public function reportes()
    {
        $idLider = auth()->user()->usuario;
        //print_r($idLider);die();
        $afiliados = Afiliado::where('lider', $idLider)
                    ->whereNotIn('estado', [9,10])
                    ->orderBy('Primer_Nombre', 'asc')
                    ->simplePaginate(10);

        
        $Departamento = Departamento::pluck('depto','ID_DPT');
        $id_dpto = 11;
        $municipio = Municipio::where('DPT', $id_dpto)->pluck('municipio','ID');
        return view('afiliado.reportes', compact('afiliados','Departamento','municipio'))
            ->with('i', (request()->input('page', 1) - 1) * $afiliados->perPage());
    }

    public function getDatosReport(Request $request)
    {
        $idLider = auth()->user()->usuario;
        $idperfil = auth()->user()->perfil;
        
        $idcomuna = auth()->user();
        //print_r($idLider);die();
        if ($idperfil == 14) {
            //$data = DB::select("SELECT * FROM getReportAfilia( $idLider )  order by 3 desc;");
            $data = DB::select("select a.lider CEDULA,b.name NOMBRE,COUNT(*) as FYA,sum(case Apoyo when 1 then 1 else 0 end) as CAMARA_Y_SENADO,sum(case Apoyo when 2 then 1 else 0 end) as CAMARA
            ,sum(case Apoyo when 3 then 1 else 0 end) as SENADO,sum(case Apoyo when 1005 then 1 else 0 end) as NO_VOTA
            from afiliados a
            inner join users b
            on a.lider = b.usuario
            group by a.lider,b.name
            order by 3 desc;");
            //print_r($data);die();
            
        }elseif($idperfil == 3){

            $data = DB::select("select a.lider CEDULA,b.name NOMBRE,COUNT(*) as FYA,sum(case Apoyo when 1 then 1 else 0 end) as CAMARA_Y_SENADO,sum(case Apoyo when 2 then 1 else 0 end) as CAMARA
            ,sum(case Apoyo when 3 then 1 else 0 end) as SENADO,sum(case Apoyo when 1005 then 1 else 0 end) as NO_VOTA
            from afiliados a
            inner join users b
            on a.lider = b.usuario
			inner join Lideres c
			on a.lider = c.Cedula
            where c.Org_Ciudad = 1 and c.Org_Comuna = $idLider
            group by a.lider,b.name
            order by 3 desc;");

        }else{
            $data = DB::select("SELECT * FROM getReportAfilia( $idLider )  order by 3 desc;");
            // $data = DB::select("select a.lider CEDULA,b.name NOMBRE,COUNT(*) as FYA,sum(case Apoyo when 1 then 1 else 0 end) as CAMARA_Y_SENADO,sum(case Apoyo when 2 then 1 else 0 end) as CAMARA
            // ,sum(case Apoyo when 3 then 1 else 0 end) as SENADO,sum(case Apoyo when 1005 then 1 else 0 end) as NO_VOTA
            // from afiliados a
            // inner join users b
            // on a.lider = b.usuario
            // where year(a.updated_at) >=  2021
            // and a.lider = $idLider
            // group by a.lider,b.name
            // order by 3 desc;");
        }

        return Datatables::of($data)
                ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $afiliado = new Afiliado();
        $Departamento = Departamento::pluck('depto','ID_DPT');
        $id_dpto = 11;
        $municipio = Municipio::where('DPT', $id_dpto)->pluck('municipio','ID');
        $apoyo = Apoyo::where('Estado', 1)->pluck('Apoyo','Id');
        return view('afiliado.create', compact('afiliado','Departamento','municipio','apoyo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Afiliado::$rules);
        $cedula = $request->Cedula;
        //print_r($request->Cedula);die();
        $cant = Afiliado::where('Cedula',$cedula)->count();
        //print_r($cant);die();
        if ($cant == 0) {
            $afiliado = Afiliado::create($request->all());
            $data = DB::update("EXEC [actualizar_web_bd] $cedula,1;");
            //print_r($afiliado);die();
            return redirect()->route('afiliados.index')
                ->with('success', 'Registro creado correctamente.');
        }else{
            
            return redirect()->route('afiliados.index')
                ->with('success', 'El usuario ya esta asociado a otro lider.');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $existe = Afiliado::where('cedula',$id)->count();
        // print_r($existe);die();
        $afiliado = Afiliado::find($id);
        
        if ($existe == 0){
            $afiliado = new Afiliado();
            $Departamento = Departamento::pluck('depto','ID_DPT');
            $id_dpto = 31;
            $municipio = Municipio::where('DPT', $id_dpto)->pluck('municipio','Mpio');
            $apoyo = Apoyo::where('Estado', 1)->pluck('Apoyo','Id');
            return view('afiliado.create', compact('afiliado','Departamento','municipio','apoyo'));
        }elseif ($existe == 1 ){
            $queryResult = DB::select('select id from afiliados where cedula in (?)', [$id]);
            $result = collect($queryResult);
            $id2 = $result[0]->id;
            $afiliado = Afiliado::find($id2);
            $Departamento = Departamento::pluck('depto','ID_DPT');
            $id_dpto = $afiliado->departamento;
            $municipio = Municipio::where('DPT', $id_dpto)->pluck('municipio','ID');
            $fecha = Afiliado::where('cedula', $id)->update(array('updated_at' => null));
            $apoyo = Apoyo::where('Estado', 1)->pluck('Apoyo','Id');
            $ptoVota = DB::select("select d.depto as Departamento,e.Municipio,c.Puesto,b.Mesa
            from BD_Getion.dbo.Censo_Electoral b
            left join BD_Getion.dbo.Puestos_de_Votacion c on b.Id_Puesto = c.Id
            left join departamentos d on c.Dpt = d.ID_DPT
            left join municipios e on c.Mpio = e.ID
            where b.Cedula = $afiliado->Cedula");
            // print_r($ptoVota);die();
            if (empty($ptoVota)) {
                $dept = "";
                $munpio = "";
                $puesto = "";
                $mesa = "";
            } else {
                $dept = $ptoVota[0]->Departamento;
                $munpio = $ptoVota[0]->Municipio;
                $puesto = $ptoVota[0]->Puesto;
                $mesa = $ptoVota[0]->Mesa;
            }
            return view('afiliado.edit', compact('afiliado','Departamento','municipio','apoyo','dept','munpio','puesto','mesa'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $afiliado = Afiliado::find($id);
        $Departamento = Departamento::pluck('depto','ID_DPT');
        $id_dpto = $afiliado->departamento;
        $municipio = Municipio::where('DPT', $id_dpto)->pluck('municipio','ID');
        $fecha = Afiliado::where('id', $id)->update(array('updated_at' => null));
        $apoyo = Apoyo::where('Estado', 1)->pluck('Apoyo','Id');
        $ptoVota = DB::select("select d.depto as Departamento,e.Municipio,c.Puesto,b.Mesa
        from BD_Getion.dbo.Censo_Electoral b
        left join BD_Getion.dbo.Puestos_de_Votacion c on b.Id_Puesto = c.Id
        left join departamentos d on c.Dpt = d.ID_DPT
        left join municipios e on c.Mpio = e.ID
        where b.Cedula = $afiliado->Cedula");
        // print_r($ptoVota);die();
        if (empty($ptoVota)) {
            $dept = "";
            $munpio = "";
            $puesto = "";
            $mesa = "";
        } else {
            $dept = $ptoVota[0]->Departamento;
            $munpio = $ptoVota[0]->Municipio;
            $puesto = $ptoVota[0]->Puesto;
            $mesa = $ptoVota[0]->Mesa;
        }
        
        // $ptoVota = collect($ptoVota);
        return view('afiliado.edit', compact('afiliado','Departamento','municipio','apoyo','dept','munpio','puesto','mesa'));
    }


    public function getMunicipios($id)
    {
        print_r('llega aqui');die();
        $afiliado = Afiliado::find($id);
        $Departamento = Departamento::pluck('depto','ID_DPT');
        //print_r($afiliado);die();
        $fecha = Afiliado::where('id', $id)->update(array('updated_at' => null));
        return view('afiliado.edit', compact('afiliado','Departamento'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Afiliado $afiliado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Afiliado $afiliado)
    {
        //print_r($afiliado);die();
        request()->validate(Afiliado::$rules);
        $id = $afiliado->id;
        $cedula = $afiliado->Cedula;
        $afiliado->update($request->all());

        $fecha = Afiliado::where('id', $id)->update(array('estado' => 2));
        $data = DB::update("EXEC [actualizar_web_bd] $cedula,2;");
        //print_r($data);die();

        return redirect()->route('afiliados.index')
            ->with('success', 'Registro actualizado correctamente');

    }

    /**
     * @param int $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request)
    {
        //$afiliado = Afiliado::find($id)->delete();
        //($request->afiliado
        //$request->motivo
        //$request->Otro

        $id = $request->num_id;
        $inMotivo = $request->motivo;
        $inOtro = $request->Otro;
        //$afiliado = Afiliado::find($id);
        $afiliado = Afiliado::find($id);
        
        $cedula = $afiliado->Cedula;
        
        $Eliminar = Afiliado::where('id', $id)->update(array('estado' => 9));

        $flight = Eliminado::create([
            'ID_AFILIADO' => $id,
            'ID_MOTIVO_ELIMINACION' => $inMotivo,
            'OTRO' => $inOtro,
        ]);
        
        $data = DB::update("EXEC [actualizar_web_bd] $cedula,3;");
        
        return redirect()->route('afiliados.index')
            ->with('success', 'Registro eliminado correctamente');
    }

    public function export(){
        return Excel::download(new afiliadosExports, 'MiListado.xlsx');
    }

    

    public function chatWhatsApp(){
        
        $chats = DB::select("SELECT top 10 contacto [from],max(fecCreate) fecCreate,convert(varchar(5),max(fecCreate),8) hora
        ,case when (select top 1 wabapi.dbo.InitCap(Nombre + ' ' + Apellido) from web_produccion.dbo.Base_de_Datos where celular = RIGHT(a.contacto,10)) is null then a.contacto else 
        (select top 1 wabapi.dbo.InitCap(Nombre + ' ' + Apellido) from web_produccion.dbo.Base_de_Datos where celular = RIGHT(a.contacto,10)) end as nombre
                FROM [AVA].[dbo].[AVAChat] a
                where role in ('ava','user') and contacto != '' and contacto in ('573182491757','573117762689')
                group by contacto
                order by fecCreate desc;");
        // print_r($queryResult);die();
        // $chats = collect($queryResult);
        // print_r($result);die();
        return view('chat',compact('chats'));
    }

    

    public function getMessages(Request $request){
        $contacto = $request->contacto;
        $chats = DB::select("SELECT contacto [from],role,content,convert(varchar(5),fecCreate,8) hora,fecCreate
        FROM [AVA].[dbo].[AVAChat]
        where contacto = '$contacto'
        order by fecCreate;");
        
        // $chats = json_encode($chats);

        // print_r($chats);die();
        return $chats;
    }

    

    public function sendMessages(Request $request){


        $contacto = $request->contacto;
        $message = $request->message;
        // print_r($message);die();
        $send = DB::update("DECLARE @res varchar(max) EXEC	[AVA].[dbo].[enviarAVAChat] N'$contacto',  N'$message', 2009, @res OUTPUT");
        // print_r($send);die();
        $chats = DB::select("SELECT contacto [from],role,content,convert(varchar(5),fecCreate,8) hora,fecCreate
        FROM [AVA].[dbo].[AVAChat]
        where contacto = '$contacto'
        order by fecCreate;");
        
        // $chats = json_encode($chats);

        // print_r($chats);die();
        return $chats;
    }

}
