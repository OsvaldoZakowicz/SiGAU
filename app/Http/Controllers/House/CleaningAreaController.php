<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CleaningArea;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CleaningAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areasDeLimpieza = CleaningArea::paginate(15);
        return view('cleaningareas.index',compact('areasDeLimpieza'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cleaningareas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => [
                'required',
                'unique:cleaning_areas,name',
                'regex:/^([a-zA-Z,.ñ\ ]+)$/i',
                'max:95'
            ],
            'cleaning_description' => [
                'required',
                'regex:/^([a-zA-Z,.ñ\ ]+)$/i',
                'max:650'
            ],
            'cleaning_frequency' => [
                'required',
                'integer'
            ],
            'cleaning_points' => [
                'required',
                'integer'
            ]
        ],[
            'required' => 'El campo :attribute es obligatorio',
            'unique' => 'El campo :attribute ya existe para otra area de limpieza',
            'regex' => 'El campo :attribute debe ser texto sin numeros, acentos o simbolos',
            'max' => 'El campo :attribute no debe superar los :max caracteres'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('cleaningareas.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validated = $validator->validated();

        $areaDeLimpieza = new CleaningArea;
        $areaDeLimpieza->name = Str::lower($validated['name']);
        $areaDeLimpieza->cleaning_description = Str::lower($validated['cleaning_description']);
        $areaDeLimpieza->cleaning_frequency = Str::lower($validated['cleaning_frequency']);
        $areaDeLimpieza->cleaning_points = Str::lower($validated['cleaning_points']);
        $areaDeLimpieza->save();

        return redirect()
            ->route('cleaningareas.index')
            ->with('exito','nueva área de limpieza creada');
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area = CleaningArea::find($id);
        return view('cleaningareas.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = CleaningArea::find($id);
        return view('cleaningareas.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $areaDeLimpieza = CleaningArea::find($id);

        $validator = Validator::make($request->all(),[
            'name' => [
                'required',
                Rule::unique('cleaning_areas','name')->ignore($areaDeLimpieza->id),
                'regex:/^([a-zA-Z,.ñ\ ]+)$/i',
                'max:95'
            ],
            'cleaning_description' => [
                'required',
                'regex:/^([a-zA-Z,.ñ\ ]+)$/i',
                'max:650'
            ],
            'cleaning_frequency' => [
                'required',
                'integer'
            ],
            'cleaning_points' => [
                'required',
                'integer'
            ]
        ],[
            'required' => 'El campo :attribute es obligatorio',
            'unique' => 'El campo :attribute ya existe para otra area de limpieza',
            'regex' => 'El campo :attribute debe ser texto sin numeros, acentos o simbolos',
            'max' => 'El campo :attribute no debe superar los :max caracteres'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('cleaningareas.edit', [$areaDeLimpieza->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        $validated = $validator->validated();

        $areaDeLimpieza->name = Str::lower($validated['name']);
        $areaDeLimpieza->cleaning_description = Str::lower($validated['cleaning_description']);
        $areaDeLimpieza->cleaning_frequency = Str::lower($validated['cleaning_frequency']);
        $areaDeLimpieza->cleaning_points = Str::lower($validated['cleaning_points']);
        $areaDeLimpieza->save();

        return redirect()
            ->route('cleaningareas.index')
            ->with('exito','área de limpieza actualizada');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* $areaDeLimpieza = CleaningArea::find($id);
        $areaDeLimpieza->delete(); */

        return redirect()
            ->route('cleaningareas.index')
            ->with('error','no implementado aún');
    }
}
