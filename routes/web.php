<?php

use App\Events\chatWhatsAppEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\PostDec;
use App\Http\Controllers\WebhookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('http://arroyave.digital:88/AVA/public/', function () {
    return view('http://arroyave.digital:88/AVA/public/home');
});

Auth::routes();

// Route::resource('afiliados', App\Http\Controllers\afiliadoController::class)->middleware('auth');

Route::resource('usuarios', App\Http\Controllers\UserController::class)->middleware('auth');

route::post('update', [App\Http\Controllers\UserController::class, 'update'])->name('update');

// Route::get('afiliados.getDatosReport',[App\Http\Controllers\afiliadoController::class, 'getDatosReport'])->name('getDatosReport');

// Route::get('afiliados.reportes',[App\Http\Controllers\afiliadoController::class, 'reportes'])->name('reportes');

// Route::get('afiliados/getMunicipios/{id}',[App\Http\Controllers\MunicipioController::class, 'getMunicipios'])->name('getMunicipioss');

// Route::get('lidere/getMunicipios/{id}',[App\Http\Controllers\LidereController::class, 'getMunicipios'])->name('getMuni');

// Route::get('validarCedula',[App\Http\Controllers\MunicipioController::class, 'validarCedula'])->name('validarCedula');

// Route::get('afiliados/{afiliado}/getMunicipios/{id}',[App\Http\Controllers\MunicipioController::class, 'getMunicipios'])->name('getMunicipios');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Route::resource('lidere', App\Http\Controllers\LidereController::class)->middleware('auth');

// Route::get('lidere/{lidere}/getMunicipios/{id}',[App\Http\Controllers\LidereController::class, 'getMunicipios'])->name('getMunicipios2');

// Route::get('lidere/getLider/{id}',[App\Http\Controllers\LidereController::class, 'getLider'])->name('getLider');

// route::post('CrearUsuario', [App\Http\Controllers\UserController::class, 'CrearUsuario'])->name('CrearUsuario');

// Route::resource('mapa', App\Http\Controllers\MapaController::class)->middleware('auth');

// Route::resource('RegistroEvento', App\Http\Controllers\RegistroEventoController::class)/*->middleware('auth')*/;

// route::post('RegistraAsistencia', [App\Http\Controllers\RegistroEventoController::class, 'store'])->name('RegistraAsistencia');

// route::post('usuarios/{id}/ActualizarFoto', [App\Http\Controllers\UserController::class, 'ActualizarFoto'])->name('ActualizarFoto');

// Route::get('exportarMiAfiliados',[App\Http\Controllers\afiliadoController::class, 'export'])->name('exportarMiAfiliados');

// Route::resource('escrutinio', App\Http\Controllers\EscrutinioController::class)->middleware('auth');

// Route::get('buscador', [App\Http\Controllers\LidereController::class, 'buscador'])->name('buscador');

// Route::resource('asistencia-eventos', App\Http\Controllers\AsistenciaEventoController::class);

// Route::get('ValidarAfiliacion', [App\Http\Controllers\AsistenciaEventoController::class, 'ValidarAfiliacion'])->name('ValidarAfiliacion');

// Route::get('validador', [App\Http\Controllers\AsistenciaEventoController::class, 'validador'])->name('validador')->middleware('auth');

// Route::post('/validarAsistencia', [App\Http\Controllers\AsistenciaEventoController::class, 'validarAsistencia'])->name('validarAsistencia');

// Route::get('buscadorEventos', [App\Http\Controllers\AsistenciaEventoController::class, 'buscadorEventos'])->name('buscadorEventos');

Route::get('chatWhatsApp',[App\Http\Controllers\afiliadoController::class, 'chatWhatsApp'])->name('chatWhatsApp');

Route::get('/oir', function () {
    
    event(new chatWhatsAppEvent);
    return 'esta es una prueba';
});

// Route::post('/whatsapp/webhook', ['App\Http\Controllers\WebhookController::class', 'handleNotification']);

// Route::get('/whatsapp', ['App\Http\Controllers\WebhookController::class', 'getAllNotifications']);

Route::post('/whatsa', [App\Http\Controllers\MsmWhatsAppController::class, 'store']);

Route::get('/contactChats', [App\Http\Controllers\MsmWhatsAppController::class, 'contactChats']);

// Route::resource('carguemasivowabs', App\Http\Controllers\CargueMasivoWabController::class);

// Route::post('/webhook', 'WebhookController@handle');

// Route::resource('callCenter', App\Http\Controllers\BaseCallCenterController::class);

// Route::post('Llamar/{id}', [App\Http\Controllers\BaseCallCenterController::class, 'Llamar'])->name('Llamar')->middleware('auth');

 Route::resource('campana', App\Http\Controllers\CampañaController::class)->middleware('auth');

 Route::resource('bingos', App\Http\Controllers\BingoController::class)->middleware('auth');

 Route::get('bingo', [App\Http\Controllers\CampañaController::class, 'bingo'])->name('bingo');

 Route::get('Adminbingo', [App\Http\Controllers\CampañaController::class, 'Adminbingo'])->name('Adminbingo');

 Route::post('cantarBingo', [App\Http\Controllers\CampañaController::class, 'cantarBingo'])->name('cantarBingo');

 Route::post('cargarArchivo', [App\Http\Controllers\CampañaController::class, 'cargarArchivo'])->name('cargarArchivo')->middleware('auth');

 Route::post('listenBingo', [App\Http\Controllers\CampañaController::class, 'listenBingo'])->name('listenBingo');

 Route::post('jugar', [App\Http\Controllers\CampañaController::class, 'jugar'])->name('jugar');

 Route::get('getMessages', [App\Http\Controllers\afiliadoController::class, 'getMessages'])->name('getMessages');

 Route::post('sendMessages', [App\Http\Controllers\afiliadoController::class, 'sendMessages'])->name('sendMessages');

 Route::GET('toAuidio', [App\Http\Controllers\MsmWhatsAppController::class, 'toAuidio'])->name('toAuidio')->middleware('auth');

 Route::GET('misHerramientas', [App\Http\Controllers\MsmWhatsAppController::class, 'misHerramientas'])->name('misHerramientas')->middleware('auth');

 Route::resource('testigos', App\Http\Controllers\TestigoController::class)->middleware('auth');

 Route::get('selectList', [App\Http\Controllers\TestigoController::class, 'selectList'])->name('selectList');

 Route::get('getMesaVot', [App\Http\Controllers\TestigoController::class, 'getMesaVot'])->name('getMesaVot')->middleware('auth');
 
 Route::post('sendWS', [App\Http\Controllers\NotificacionesController::class, 'sendWS'])->name('sendWS');

 Route::post('/importar-archivo', [App\Http\Controllers\ArchivoController::class, 'importar'])->name('importar-archivo');
