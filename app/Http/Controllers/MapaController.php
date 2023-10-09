<?php

namespace App\Http\Controllers;

use App\Models\Mapa;
use Illuminate\Http\Request;

/**
 * Class MapaController
 * @package App\Http\Controllers
 */
class MapaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comuna = auth()->user()->usuario;

        $mapas = Mapa::select('frame')->where('Comuna',$comuna)->get();
       
        $mapa = ($mapas[0]['frame']);        

        //print_r($mapa);die();

        return view('mapa.index', compact('mapa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mapa = new Mapa();
        return view('mapa.create', compact('mapa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Mapa::$rules);

        $mapa = Mapa::create($request->all());

        return redirect()->route('mapas.index')
            ->with('success', 'Mapa created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mapa = Mapa::find($id);

        return view('mapa.show', compact('mapa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mapa = Mapa::find($id);

        return view('mapa.edit', compact('mapa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Mapa $mapa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapa $mapa)
    {
        request()->validate(Mapa::$rules);

        $mapa->update($request->all());

        return redirect()->route('mapas.index')
            ->with('success', 'Mapa updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $mapa = Mapa::find($id)->delete();

        return redirect()->route('mapas.index')
            ->with('success', 'Mapa deleted successfully');
    }
}
