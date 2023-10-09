<?php

namespace App\Http\Controllers;

use App\Models\Carguemasivowab;
use Illuminate\Http\Request;

/**
 * Class CarguemasivowabController
 * @package App\Http\Controllers
 */
class CarguemasivowabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carguemasivowabs = Carguemasivowab::paginate();

        return view('carguemasivowab.index', compact('carguemasivowabs'))
            ->with('i', (request()->input('page', 1) - 1) * $carguemasivowabs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carguemasivowab = new Carguemasivowab();
        return view('carguemasivowab.create', compact('carguemasivowab'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Carguemasivowab::$rules);

        $carguemasivowab = Carguemasivowab::create($request->all());

        return redirect()->route('carguemasivowabs.index')
            ->with('success', 'Carguemasivowab created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carguemasivowab = Carguemasivowab::find($id);

        return view('carguemasivowab.show', compact('carguemasivowab'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carguemasivowab = Carguemasivowab::find($id);

        return view('carguemasivowab.edit', compact('carguemasivowab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Carguemasivowab $carguemasivowab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carguemasivowab $carguemasivowab)
    {
        request()->validate(Carguemasivowab::$rules);

        $carguemasivowab->update($request->all());

        return redirect()->route('carguemasivowabs.index')
            ->with('success', 'Carguemasivowab updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $carguemasivowab = Carguemasivowab::find($id)->delete();

        return redirect()->route('carguemasivowabs.index')
            ->with('success', 'Carguemasivowab deleted successfully');
    }
}
