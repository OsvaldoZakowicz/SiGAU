<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\House;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $casas = House::paginate(15);
        return view('house.index', compact('casas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('house.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'street'            =>  ['required', 'regex:/^([a-zA-Z\s]{0,95})$/i', 'max:95'],
            'street_number'     =>  ['required', 'numeric', 'max_digits:10'],
            'house_number'      =>  ['required', 'alpha_num', 'max:10'],
            'department_number' =>  ['nullable', 'alpha_num', 'max:10'],
            'floor_number'      =>  ['nullable', 'numeric', 'max_digits:10'],
            'location_id'       =>  ['required'],
            'block'         => ['nullable','string','max:15'],
            'neighborhood'  => ['required','string','max:95']
        ]);

        $direccion = new Address;
        $direccion->street = $request->street;
        $direccion->street_number = $request->street_number;
        $direccion->house_number = $request->house_number;
        $direccion->department_number = $request->department_number;
        $direccion->floor_number = $request->floor_number;
        $direccion->location_id = $request->location_id;
        $direccion->save();

        $casa = new House;
        $casa->block = $request->block;
        $casa->neighborhood = $request->neighborhood;
        $casa->address_id = $direccion->id;
        $casa->save();

        return redirect()
            ->route('houses.index')
            ->with('exito','nueva casa creada');
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $casa = House::find($id);
        $serviciosDeLaCasa = $casa->services;
        $ambientesDeLaCasa = $casa->ambients;
        return view('house.show', compact('casa','serviciosDeLaCasa','ambientesDeLaCasa'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $casa = House::find($id);
        return view('house.edit', compact('casa'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $casa = House::find($id);

        $this->validate($request, [
            'street'            =>  ['required', 'regex:/^([a-zA-Z\s]{0,95})$/i', 'max:95'],
            'street_number'     =>  ['required', 'numeric', 'max_digits:10'],
            'house_number'      =>  ['required', 'alpha_num', 'max:10'],
            'department_number' =>  ['nullable', 'alpha_num', 'max:10'],
            'floor_number'      =>  ['nullable', 'numeric', 'max_digits:10'],
            'location_id'       =>  ['required'],
            'block'         => ['nullable','string','max:15'],
            'neighborhood'  => ['required','string','max:95']
        ]);

        $casa->address->update($request->all());
        $casa->update($request->all());

        return redirect()
            ->route('houses.index')
            ->with('exito','casa actualizada');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* $casa = House::find($id);
        $casa->delete(); */

        return redirect()
            ->route('houses.index')
            ->with('error','no implementado aún');
    }
}
