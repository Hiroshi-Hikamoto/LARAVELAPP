<?php

namespace App\Http\Controllers;

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
class NotificacionesController extends Controller
{
    
    public function sendWS(Request $request){
        // print_r($request->mensaje);die();
        $contacto = $request->contacto;
        $tipo = $request->tipo;

        $url = 'https://graph.facebook.com/v15.0/104812412538802/messages';
        if ($tipo == 1) {
            $mensaje = $request->mensaje;
            $data = '{
                "messaging_product": "whatsapp",
                "recipient_type": "individual",
                "to": "' .$contacto .'",
                "type": "text",
                "text": {
                    "body": "' .$mensaje .'"
                }
                }';
        } elseif($tipo == 2) {  
            $mensaje = $request->mensaje;
            $data = '{
                "messaging_product": "whatsapp",
                "recipient_type": "individual",
                "to": "' .$contacto .'",
                "type": "template",
                "template": {
                    "name": "plantilla_3_2 ",
                    "language": {
                        "code": "es_ES"
                    },
                    "components": [
                        {
                            "type": "header",
                            "parameters": [
                                {
                                    "type": "image",
                                    "image": {
                                        "id": "617796533758621"
                                    }
                                }
                            ]
                        },  {"type": "body","parameters": [{"type": "text","text": "Pepito Perz"},
                            {"type": "text","text": "Desde Avapp e Inteligencia Electoral te queremos dar la bienvenida al equipo de testigos electorales. Recuerda que este sera nuestro canal de informacion y registro este proximo 29 de octubre."},
                            {"type": "text","text": "¿Deseas ver el video tutorial?"}]}
                    ]
                }
            }';
        }
        
        

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
}
