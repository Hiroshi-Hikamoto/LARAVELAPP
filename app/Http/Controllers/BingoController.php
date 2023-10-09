<?php

namespace App\Http\Controllers;

use App\Models\Bingo;
use Illuminate\Http\Request;

/**
 * Class BingoController
 * @package App\Http\Controllers
 */
class BingoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $bingos = Bingo::where('id_usuario',$id)
                            ->simplePaginate(10);

        return view('bingo.index', compact('bingos'))
            ->with('i', (request()->input('page', 1) - 1) * $bingos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bingo = new Bingo();
        $idUsuario = auth()->user()->id;
        return view('bingo.create', compact('bingo','idUsuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->Nombre .' fue programado correctamente';
        request()->validate(Bingo::$rules);

        $bingo = Bingo::create($request->all());

        return redirect()->route('bingos.index')
            ->with('success', $name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bingo = Bingo::find($id);

        return view('bingo.show', compact('bingo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bingo = Bingo::find($id);

        return view('bingo.edit', compact('bingo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Bingo $bingo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bingo $bingo)
    {
        request()->validate(Bingo::$rules);

        $bingo->update($request->all());

        return redirect()->route('bingos.index')
            ->with('success', 'Bingo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bingo = Bingo::find($id)->delete();

        return redirect()->route('bingos.index')
            ->with('success', 'Bingo deleted successfully');
    }
}
