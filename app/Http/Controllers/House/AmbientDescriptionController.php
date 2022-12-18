<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AmbientDescription;
use App\Models\AmbientType;

class AmbientDescriptionController extends Controller
{
    //TODO constructor con middleware

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $descripcionesAmbiente = AmbientDescription::with('ambient_type')
            ->paginate(15);
        return view('ambientDescriptions.index', compact('descripcionesAmbiente'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposAmbiente = AmbientType::pluck('name','id');
        return view('ambientDescriptions.create', compact('tiposAmbiente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'lights_quantity'   => ['required','integer'],
            'plugs_quantity'    => ['required','integer'],
            'size'              => ['nullable','string','max:95'],
            'places_quantity'   => ['required','integer'],
            'ambient_types_id'  => ['required']
        ]);

        $descripcionAmbiente = new AmbientDescription;
        $descripcionAmbiente->lights_quantity = $request->lights_quantity;
        $descripcionAmbiente->plugs_quantity = $request->plugs_quantity;
        $descripcionAmbiente->size = $request->size;
        $descripcionAmbiente->places_quantity = $request->places_quantity;
        $descripcionAmbiente->ambient_types_id = $request->ambient_types_id;
        $descripcionAmbiente->save();

        return redirect()
            ->route('ambientdescriptions.index')
            ->with('exito','nueva descripción de ambiente creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $descripcionAmbiente = AmbientDescription::find($id);
        return view('ambientDescriptions.show', compact('descripcionAmbiente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $descripcionAmbiente = AmbientDescription::find($id);
        $tiposAmbiente = AmbientType::pluck('name','id');
        return view('ambientDescriptions.edit', compact('descripcionAmbiente','tiposAmbiente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $descripcionAmbiente = AmbientDescription::find($id);

        $this->validate($request, [
            'lights_quantity'   => ['required','integer'],
            'plugs_quantity'    => ['required','integer'],
            'size'              => ['nullable','string','max:95'],
            'places_quantity'   => ['required','integer'],
            'ambient_types_id'  => ['required']
        ]);

        $descripcionAmbiente->update($request->all());

        return redirect()
            ->route('ambientdescriptions.index')
            ->with('exito','descripcion de ambiente actualizada');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* $descripcionAmbiente = AmbientDescription::find($id);
        $descripcionAmbiente->delete(); */

        return redirect()
            ->route('ambientdescriptions.index')
            ->with('error','no implementado aún');
    }
}
