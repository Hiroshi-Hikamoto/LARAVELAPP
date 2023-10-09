<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\{JsonResponse, Response};

class WebhookController extends Controller
{
   public function getAllNotifications(Request $request)
   
   : JsonResponse {
      print_r($request);die();
       return response()->json();
   }

   public function handleNotification()
   : JsonResponse {

      //  return response()
      //      ->json(null, Response::HTTP_NO_CONTENT);
      return response()->json();

   }
}
