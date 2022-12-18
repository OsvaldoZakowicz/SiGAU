<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Models\AmbientType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AmbientTypeController extends Controller
{

    //TODO constructor con middleware.

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposAmbiente = AmbientType::paginate(15);
        return view('ambientTypes.index', compact('tiposAmbiente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ambientTypes.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required','alpha','max:95'],
            'description' => ['required','alpha','max:95'],
        ]);

        $ambientType = new AmbientType;
        $ambientType->name = $request->name;
        $ambientType->description = $request->description;
        $ambientType->save();

        return redirect()
            ->route('ambienttypes.index')
            ->with('exito', 'nuevo tipo de ambiente creado');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tipoAmbiente = AmbientType::find($id);
        return view('ambientTypes.show', compact('tipoAmbiente'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  bigint unsigned $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoAmbiente = AmbientType::find($id);
        return view('ambientTypes.edit', compact('tipoAmbiente'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  bigint unsigned $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipoAmbiente = AmbientType::find($id);

        $this->validate($request, [
            'name' => ['required','alpha','max:95'],
            'description' => ['required','alpha','max:95'],
        ]);


        $tipoAmbiente->update($request->all());

        return redirect()
            ->route('ambienttypes.index')
            ->with('exito', 'tipo de ambiente actualizado');
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\AmbientType  $ambientType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoAmbiente = AmbientType::find($id);
        $tipoAmbiente->delete();

        return redirect()
            ->route('ambienttypes.index')
            ->with('exito', 'tipo de ambiente eliminado');
    }
}
