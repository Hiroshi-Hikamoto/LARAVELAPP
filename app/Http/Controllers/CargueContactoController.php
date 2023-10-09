<?php

namespace App\Http\Controllers;

use App\Models\CargueContacto;
use Illuminate\Http\Request;

/**
 * Class CargueContactoController
 * @package App\Http\Controllers
 */
class CargueContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargueContactos = CargueContacto::paginate();

        return view('cargue-contacto.index', compact('cargueContactos'))
            ->with('i', (request()->input('page', 1) - 1) * $cargueContactos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargueContacto = new CargueContacto();
        return view('cargue-contacto.create', compact('cargueContacto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(CargueContacto::$rules);

        $cargueContacto = CargueContacto::create($request->all());

        return redirect()->route('cargue-contactos.index')
            ->with('success', 'CargueContacto created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cargueContacto = CargueContacto::find($id);

        return view('cargue-contacto.show', compact('cargueContacto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cargueContacto = CargueContacto::find($id);

        return view('cargue-contacto.edit', compact('cargueContacto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  CargueContacto $cargueContacto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CargueContacto $cargueContacto)
    {
        request()->validate(CargueContacto::$rules);

        $cargueContacto->update($request->all());

        return redirect()->route('cargue-contactos.index')
            ->with('success', 'CargueContacto updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cargueContacto = CargueContacto::find($id)->delete();

        return redirect()->route('cargue-contactos.index')
            ->with('success', 'CargueContacto deleted successfully');
    }
}
