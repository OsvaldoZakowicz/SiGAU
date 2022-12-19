<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Service;
use App\Models\ServiceDescription;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
     * 
     */
    public function createHouseService($id)
    {
        $casa = House::find($id);
        $descripcionesDeServicio = ServiceDescription::get();
        return view('services.create', compact('casa','descripcionesDeServicio'));
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
            'house_id'                   => ['required'],
            'service_description_id'     => ['required'],
            'connection_number'          => ['required','integer','unique:services,connection_number'],
            'service_owner'              => ['required','string','max:95'],
            'cuit'                       => ['required','integer']
        ]);

        $servicio = new Service;
        $servicio->connection_number = $request->connection_number;
        $servicio->service_owner = $request->service_owner;
        $servicio->cuit = $request->cuit;
        $servicio->service_description_id = $request->service_description_id;
        $servicio->house_id = $request->house_id;
        $servicio->save();

        return redirect()
            ->route('houses.show',$request->house_id)
            ->with('exito','nuevo servicio creado para la casa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicio = Service::find($id);
        return view('services.show', compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicio = Service::find($id);
        $descripcionesDeServicio = ServiceDescription::get();
        return view('services.edit', compact('servicio','descripcionesDeServicio'));
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
        $servicio = Service::find($id);

        $this->validate($request, [
            'house_id'                   => ['required'],
            'service_description_id'     => ['required'],
            'connection_number'          => ['required','integer'],
            'service_owner'              => ['required','string','max:95'],
            'cuit'                       => ['required','integer']
        ]);

        $servicio->update($request->all());

        return redirect()
            ->route('houses.show',$request->house_id)
            ->with('exito','servicio actualizado para la casa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $casa = Service::find($id)->house;

        return redirect()
            ->route('houses.show',$casa->id)
            ->with('error','no implementado aún');
    }
}
