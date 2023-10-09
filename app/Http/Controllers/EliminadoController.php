<?php

namespace App\Http\Controllers;

use App\Models\Eliminado;
use Illuminate\Http\Request;

/**
 * Class EliminadoController
 * @package App\Http\Controllers
 */
class EliminadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eliminados = Eliminado::paginate();

        return view('eliminado.index', compact('eliminados'))
            ->with('i', (request()->input('page', 1) - 1) * $eliminados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eliminado = new Eliminado();
        return view('eliminado.create', compact('eliminado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Eliminado::$rules);

        $eliminado = Eliminado::create($request->all());

        return redirect()->route('eliminados.index')
            ->with('success', 'Eliminado created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $eliminado = Eliminado::find($id);

        return view('eliminado.show', compact('eliminado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eliminado = Eliminado::find($id);

        return view('eliminado.edit', compact('eliminado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Eliminado $eliminado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eliminado $eliminado)
    {
        request()->validate(Eliminado::$rules);

        $eliminado->update($request->all());

        return redirect()->route('eliminados.index')
            ->with('success', 'Eliminado updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $eliminado = Eliminado::find($id)->delete();

        return redirect()->route('eliminados.index')
            ->with('success', 'Eliminado deleted successfully');
    }
}
