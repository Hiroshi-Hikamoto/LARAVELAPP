<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use Illuminate\Http\Request;

/**
 * Class PruebaController
 * @package App\Http\Controllers
 */
class PruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pruebas = Prueba::paginate();

        return view('prueba.index', compact('pruebas'))
            ->with('i', (request()->input('page', 1) - 1) * $pruebas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prueba = new Prueba();
        return view('prueba.create', compact('prueba'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // request()->validate(Prueba::$rules);

        // $prueba = Prueba::create($request->all());

        // return redirect()->route('pruebas.index')
        //     ->with('success', 'Prueba created successfully.');
        $text = $request->text;
        $inputs = ['text' => $text];
        Prueba::create($inputs);
        // print_r($text);die();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prueba = Prueba::find($id);

        return view('prueba.show', compact('prueba'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prueba = Prueba::find($id);

        return view('prueba.edit', compact('prueba'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Prueba $prueba
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prueba $prueba)
    {
        request()->validate(Prueba::$rules);

        $prueba->update($request->all());

        return redirect()->route('pruebas.index')
            ->with('success', 'Prueba updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $prueba = Prueba::find($id)->delete();

        return redirect()->route('pruebas.index')
            ->with('success', 'Prueba deleted successfully');
    }
}
