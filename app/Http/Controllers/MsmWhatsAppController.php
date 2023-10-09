<?php

namespace App\Http\Controllers;

use App\Models\MsmWhatsApp;
use Illuminate\Http\Request;
use DB;
use DataTables;
use FFMpeg;
use FFMpeg\FFProbe;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

/**
 * Class MsmWhatsAppController
 * @package App\Http\Controllers
 */
class MsmWhatsAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $msmWhatsApps = MsmWhatsApp::paginate();

        return view('msm-whats-app.index', compact('msmWhatsApps'))
            ->with('i', (request()->input('page', 1) - 1) * $msmWhatsApps->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $msmWhatsApp = new MsmWhatsApp();
        return view('msm-whats-app.create', compact('msmWhatsApp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // request()->validate(MsmWhatsApp::$rules);

        // $msmWhatsApp = MsmWhatsApp::create($request->all());

        // return redirect()->route('msm-whats-apps.index')
        //     ->with('success', 'MsmWhatsApp created successfully.');
        $from = $request->from;
        $idMsg = $request->idMsg;
        $text = $request->text;
        $tipo = $request->tipo;
        $to = $request->to;
        $idMsgReference = $request->idMsgReference;
        $status = $request->status;
        $type = $request->type;
        
        $inputs = ['from' => $from,'to' => $to,'idMsg' => $idMsg,'text' => $text,'tipo' => $tipo, 'idMsgReference' => $idMsgReference,'status' => $status ];
        
        if ($to == '15550331344')
        {
            // $contactar = DB::update("EXEC ava.dbo.[AvappChat] '$from','$text','$idMsgReference','$to','$type','$status';");
            $contactar = DB::update("EXEC ava.dbo.[Respc}}hatBot] '$from','$text','$idMsgReference','$to','$type','$status','$idMsg','$tipo';");
            // $proceso = DB::update("insert into validarProceos select '$from' as [text],123456 as [numeric] ");
            // $proceso = DB::update("insert into validarProceos select '$text' as [text],654321 as [numeric] ");
            // $proceso = DB::update("insert into validarProceos select '$idMsgReference' as [text],7890 as [numeric] ");
            MsmWhatsApp::create($inputs);
        }else{
            $contactar = DB::update("EXEC ava.dbo.[responderEncuesta] '$from','$text','$idMsgReference','$to','$type','$status';");
            if($type == 1){
                MsmWhatsApp::create($inputs);
            }
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
        $msmWhatsApp = MsmWhatsApp::find($id);

        return view('msm-whats-app.show', compact('msmWhatsApp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $msmWhatsApp = MsmWhatsApp::find($id);

        return view('msm-whats-app.edit', compact('msmWhatsApp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  MsmWhatsApp $msmWhatsApp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MsmWhatsApp $msmWhatsApp)
    {
        request()->validate(MsmWhatsApp::$rules);

        $msmWhatsApp->update($request->all());

        return redirect()->route('msm-whats-apps.index')
            ->with('success', 'MsmWhatsApp updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $msmWhatsApp = MsmWhatsApp::find($id)->delete();

        return redirect()->route('msm-whats-apps.index')
            ->with('success', 'MsmWhatsApp deleted successfully');
    }

    public function contactChats(Request $request){
        $data = DB::select("select case when [from] = '573205400870' then [to]  else [from] end as contact 
        ,isnull((select Primer_Nombre + ' ' + Segundo_Apellido + ' ' + Primer_Apellido + ' ' + Segundo_Apellido from afiliados as b where '57' + celular = case when a.[from] = '573205400870' then a.[to]  else a.[from] end),'No registrado') as [name]
        from msm_whats_apps as a order by id desc;");
        $res = json_decode(json_encode($data));
        return Datatables::of($data)
        ->make();
    }

    public function sendWS(Request $request){
        // print_r($request->mensaje);die();
        $contacto = $request->contacto;
        $mensaje = $request->mensaje;

        $url = 'https://graph.facebook.com/v15.0/100233056316278/messages';
        $data = '{
            "messaging_product": "whatsapp",
            "recipient_type": "individual",
            "to": "' .$contacto .'",
            "type": "text",
            "text": {
                "body": "' .$mensaje .'"
            }
            }';

        $headers = [
            'Authorization: Bearer EAAXIz9r2264BAMMoMlMquMDVAflMJm1xZAu1MAhu64sIhzLvZBnUTV6HdZBdDgU2uMj73sMC3odtYZC60HY3XmLOq1AflLOROWhqY7shJe7pgZA50Bzkl4DiOHZBnQEx6PFZAxvKb03FbI9E6bLfOyddBEz05nQAyThiEZBfIKISoiRjUkvZBtZC9emhSCp6C0IBjP9xN5ZAoJqfwZDZD',
            'Content-Type: application/json'
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
        print_r($response);die();
    }

    public function toAuidio(Request $request) {

        $texto = $request->Texto;
        // print_r($texto);die();

        $apiUrl = 'https://us-central1-texttospeech.googleapis.com/v1beta1/text:synthesize?key=AIzaSyD9JT89kDwF2oL0xkxWnLjPjwisqgWgRZA'; // URL de la API de Google Text-to-Speech
        $apiKey = 'AIzaSyD9JT89kDwF2oL0xkxWnLjPjwisqgWgRZA'; // Reemplaza con tu propia clave de API

        // Parámetros de la solicitud
        $requestParams = [
            'input' => [
                'text' => $texto,
            ],
            'voice' => [
                'languageCode' => 'es-US',
                'name' => 'es-US-Neural2-B'
            ],
            'audioConfig' => [
                'audioEncoding' => 'LINEAR16',
                'effectsProfileId'=> [
                    "small-bluetooth-speaker-class-device"
                  ],
                  "pitch" => 0,
                  "speakingRate" => 1
            ],
        ];

        $response = (new Client())->post($apiUrl, [
            'headers' => [
                // 'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => $requestParams,
        ]);

        $responseBody = json_decode($response->getBody(), true);
        $linear16Audio = base64_decode($responseBody['audioContent']);

        // Ruta para guardar el archivo LINEAR16
        $linear16FilePath = storage_path('app\public\linear16.raw');

        // Guarda el contenido LINEAR16 en un archivo
        $t = Storage::put('public/linear16.raw', $linear16Audio);

        // Ruta para guardar el archivo MP3
        $mp3FilePath = storage_path('app\public\output.mp3');
        
        $t = Storage::put('public/output.mp3', $linear16Audio);
        // print_r($linear16FilePath);
        // print_r($mp3FilePath);die();

        // Ejecutar el comando sox para convertir LINEAR16 a MP3
        $command = "sox -t raw -r 16000 -b 16 -e signed-integer $linear16FilePath -t mp3 $mp3FilePath";
        exec($command);

        return response()->download($mp3FilePath, 'output.mp3');
    }

    function misHerramientas(){
        $msmWhatsApp = "";
        return view('Herramientas.mis_herramientas', compact('msmWhatsApp'));
    }
}
