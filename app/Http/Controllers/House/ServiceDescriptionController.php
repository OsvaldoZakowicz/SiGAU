<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceDescription;
use App\Models\ServiceType;

class ServiceDescriptionController extends Controller
{
    //TODO constructor con middleware

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $descripcionesServicio = ServiceDescription::with('service_type')
            ->paginate(15);
        return view('serviceDescriptions.index', compact('descripcionesServicio'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposServicio = ServiceType::pluck('name','id');
        return view('serviceDescriptions.create', compact('tiposServicio'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'dia_llegada_boleta'       => ['required','integer'],
            'periodo_recaudacion'      => ['required','integer'],
            'dia_pago_servicio'        => ['required','integer'],
            'maximo_pagos_adeudados'   => ['required','integer'],
            'service_types_id'         => ['required']
        ]);

        $descripcionServicio = new ServiceDescription;
        $descripcionServicio->dia_llegada_boleta = $request->dia_llegada_boleta;
        $descripcionServicio->periodo_recaudacion = $request->periodo_recaudacion;
        $descripcionServicio->dia_pago_servicio = $request->dia_pago_servicio;
        $descripcionServicio->maximo_pagos_adeudados = $request->maximo_pagos_adeudados;
        $descripcionServicio->service_types_id = $request->service_types_id;
        $descripcionServicio->save();

        return redirect()
            ->route('servicedescriptions.index')
            ->with('exito','nueva descripcion de servicio creada');
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $descripcionServicio = ServiceDescription::find($id);
        return view('serviceDescriptions.show', compact('descripcionServicio'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $descripcionServicio = ServiceDescription::find($id);
        $tiposServicio = ServiceType::pluck('name','id');
        return view('serviceDescriptions.edit', compact('descripcionServicio','tiposServicio'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $descripcionServicio = ServiceDescription::find($id);

        $this->validate($request, [
            'dia_llegada_boleta'       => ['required','integer'],
            'periodo_recaudacion'      => ['required','integer'],
            'dia_pago_servicio'        => ['required','integer'],
            'maximo_pagos_adeudados'   => ['required','integer'],
            'service_types_id'         => ['required']
        ]);

        $descripcionServicio->update($request->all());

        return redirect()
            ->route('servicedescriptions.index')
            ->with('exito','descripcion de servicio actualizada');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* $descripcionServicio = ServiceDescription::find($id);
        $descripcionServicio->delete(); */

        return redirect()
            ->route('servicedescriptions.index')
            ->with('error','no implementado aún');
    }
}
