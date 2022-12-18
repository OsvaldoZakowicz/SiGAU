<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{

    //TODO constructor con middleware

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposServicio = ServiceType::paginate(15);
        return view('serviceTypes.index', compact('tiposServicio'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('serviceTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required','string','max:95'],
            'description' => ['required','string','max:95'],
        ]);

        $tipoServicio = new ServiceType;
        $tipoServicio->name = $request->name;
        $tipoServicio->description = $request->description;
        $tipoServicio->save();

        return redirect()
            ->route('servicetypes.index')
            ->with('exito', 'nuevo tipo de servicio creado');
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoServicio = ServiceType::find($id);
        return view('serviceTypes.show', compact('tipoServicio'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoServicio = ServiceType::find($id);
        return view('serviceTypes.edit', compact('tipoServicio'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipoServicio = ServiceType::find($id);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:95'],
            'description' => ['required', 'string', 'max:95'],
        ]);

        $tipoServicio->update($request->all());

        return redirect()
            ->route('servicetypes.index')
            ->with('exito', 'tipo de servicio actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoServicio = ServiceType::find($id);
        $tipoServicio->delete();

        return redirect()
            ->route('servicetypes.index')
            ->with('exito', 'tipo de servicio eliminado');
    }
}
