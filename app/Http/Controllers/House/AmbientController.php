<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Models\AmbientDescription;
use Illuminate\Http\Request;
use App\Models\House;
use App\Models\Ambient;

class AmbientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * *crear ambiente.
     */
    public function createHouseAmbient($id)
    {
        $casa = House::find($id);
        $descripcionesDeAmbiente = AmbientDescription::get();
        return view('ambients.create', compact('casa','descripcionesDeAmbiente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'house_id'               => ['required'],
            'ambient_description_id' => ['required'],
            'quantity'               => ['required','integer']
        ]);

        $ambiente = new Ambient;
        $ambiente->ambient_description_id = $request->ambient_description_id;
        $ambiente->house_id = $request->house_id;
        $ambiente->quantity = $request->quantity;
        $ambiente->save();

        return redirect()
            ->route('houses.show', $request->house_id)
            ->with('exito','nuevo ambiente creado para la casa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ambiente = Ambient::find($id);
        $casa = $ambiente->house;
        $descripcionDeAmbiente = $ambiente->ambient_description;
        return view('ambients.show', compact('ambiente','casa','descripcionDeAmbiente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ambiente = Ambient::find($id);
        $casa = $ambiente->house;
        $descripcionesDeAmbiente = AmbientDescription::get();
        return view('ambients.edit', compact('ambiente','casa','descripcionesDeAmbiente'));
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
        $ambiente = Ambient::find($id);

        $this->validate($request, [
            'house_id'               => ['required'],
            'ambient_description_id' => ['required'],
            'quantity'               => ['required','integer']
        ]);

        $ambiente->update($request->all());

        return redirect()
            ->route('houses.show', $request->house_id)
            ->with('exito','ambiente actualizado para la casa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ambiente = Ambient::find($id);
        /* $ambiente->delete(); */

        return redirect()
            ->route('houses.show',$ambiente->house->id)
            ->with('error','no implementado aún');
    }
}
