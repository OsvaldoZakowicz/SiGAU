<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        //*nombres de tipos de servicios unicos

        /* $this->validate($request, [
            'name' => ['required','unique:service_types,name','string','max:95'],
            'description' => ['required','string','max:95'],
        ]); */

        $validator = Validator::make($request->all(),[
            'name' => ['required','unique:service_types,name','regex:/^([a-zA-Z\ ]+)$/i','max:95'],
            'description' => ['required','regex:/^([a-zA-Z\ ]+)$/i','max:95']
        ],[
            'required' => 'El campo :attribute es obligatorio',
            'unique' => 'El campo :attribute ya existe para otro tipo de servicio',
            'regex' => 'El campo :attribute debe ser texto sin numeros, acentos o simbolos',
            'max' => 'El campo :attribute no debe superar los 95 caracteres'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('servicetypes.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validated = $validator->validated();

        //*datos en lowercase
        $tipoServicio = new ServiceType;
        $tipoServicio->name = Str::lower($validated['name']);
        $tipoServicio->description = Str::lower($validated['description']);
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

        $datos = $request->all();

        //*validator requiere previamente extraer datos del request
        $validator = Validator::make($datos, [
            'name' => [
                'required',
                Rule::unique('service_types','name')->ignore($tipoServicio->id),
                'regex:/^([a-zA-Z\ ]+)$/i',
                'max:95'
            ],
            'description' => [
                'required',
                'regex:/^([a-zA-Z\ ]+)$/i',
                'max:95'
            ]
        ], [
            'required' => 'El campo :attribute es obligatorio',
            'unique' => 'El campo :attribute ya existe para otro tipo de servicio',
            'regex' => 'El campo :attribute debe ser texto sin numeros, acentos o simbolos',
            'max' => 'El campo :attribute no debe superar los 95 caracteres'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('servicetypes.edit', [$tipoServicio->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        $validated = $validator->validated();

        //*datos en lowercase
        $tipoServicio->name = Str::lower($validated['name']);
        $tipoServicio->description = Str::lower($validated['description']);
        $tipoServicio->save();

        return redirect()
            ->route('servicetypes.index')
            ->with('exito', 'tipo de servicio actualizado');
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoServicio = ServiceType::find($id);

        //?el tipo de servicio esta asociado a descripciones de servicio?
        if ($tipoServicio->service_descriptions->count() !== 0) {
            return redirect()
                ->route('servicetypes.show', [$tipoServicio->id])
                ->with('error', 'el tipo de servicio ' . $tipoServicio->name . ' está siendo usado por descripciones de servicios para casas de albergue, no se puede eliminar.');
        }

        $tipoServicio->delete();

        return redirect()
            ->route('servicetypes.index')
            ->with('exito', 'tipo de servicio ' . $tipoServicio->name . ' fue eliminado');
    }
}
