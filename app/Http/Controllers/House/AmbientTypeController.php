<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Models\AmbientType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $validator = Validator::make($request->all(),[
            'name' => ['required','unique:ambient_types,name','regex:/^([a-zA-Z,.ñ\ ]{1,95})$/i','max:95'],
            'description' => ['required','regex:/^([a-zA-Z,.ñ\ ]{1,95})$/i','max:95'],
        ],[
            'required' => 'El campo :attribute es obligatorio',
            'unique' => 'El campo :attribute ya existe para otro tipo de ambiente',
            'regex' => 'El campo :attribute debe ser texto sin numeros, acentos o simbolos',
            'max' => 'El campo :attribute no debe superar los 95 caracteres'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('ambienttypes.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validated = $validator->validated();

        //*datos en lowercase
        $tipoAmbiente = new AmbientType;
        $tipoAmbiente->name = Str::lower($validated['name']);
        $tipoAmbiente->description = Str::lower($validated['description']);
        $tipoAmbiente->save();

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

        $validator = Validator::make($request->all(),[
            'name' => [
                'required',
                Rule::unique('ambient_types','name')->ignore($tipoAmbiente->id),
                'regex:/^([a-zA-Z,.ñ\ ]{1,95})$/i',
                'max:95'],
            'description' => [
                'required',
                'regex:/^([a-zA-Z,.ñ\ ]{1,95})$/i',
                'max:95'],
        ],[
            'required' => 'El campo :attribute es obligatorio',
            'unique' => 'El campo :attribute ya existe para otro tipo de ambiente',
            'regex' => 'El campo :attribute debe ser texto sin numeros, acentos o simbolos',
            'max' => 'El campo :attribute no debe superar los 95 caracteres'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('ambienttypes.edit', [$tipoAmbiente->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        $validated = $validator->validated();

        $tipoAmbiente->name = Str::lower($validated['name']);
        $tipoAmbiente->description = Str::lower($validated['description']);
        $tipoAmbiente->save();

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

        if ($tipoAmbiente->ambient_descriptions->count() !== 0) {
            return redirect()
                ->route('ambienttypes.show', [$tipoAmbiente->id])
                ->with('error','el tipo de ambiente ' . $tipoAmbiente->name . ' está siendo usado por descripciones de ambientes para casas de albergue, no se puede eliminar.');
        }

        $tipoAmbiente->delete();

        return redirect()
            ->route('ambienttypes.index')
            ->with('exito', 'tipo de ambiente ' . $tipoAmbiente->name . ' fue eliminado');
    }
}
