<?php

namespace App\Http\Controllers;

use App\Models\RegistroEvento;
use Illuminate\Http\Request;

/**
 * Class RegistroEventoController
 * @package App\Http\Controllers
 */
class RegistroEventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registroEventos = RegistroEvento::paginate();

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
        $registroEvento = new RegistroEvento();
        return view('registro-evento.create', compact('registroEvento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(RegistroEvento::$rules);

        $registroEvento = RegistroEvento::create($request->all());

        return redirect()->route('registro-eventos.index')
            ->with('success', 'RegistroEvento created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registroEvento = RegistroEvento::find($id);

        return view('registro-evento.show', compact('registroEvento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registroEvento = RegistroEvento::find($id);

        return view('registro-evento.edit', compact('registroEvento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  RegistroEvento $registroEvento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistroEvento $registroEvento)
    {
        request()->validate(RegistroEvento::$rules);

        $registroEvento->update($request->all());

        return redirect()->route('registro-eventos.index')
            ->with('success', 'RegistroEvento updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $registroEvento = RegistroEvento::find($id)->delete();

        return redirect()->route('registro-eventos.index')
            ->with('success', 'RegistroEvento deleted successfully');
    }
}
