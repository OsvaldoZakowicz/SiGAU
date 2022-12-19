<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CleaningArea;

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
        $this->validate($request, [
            'name'                  =>['required','string','max:95'],
            'cleaning_description'  =>['required','string','max:200'],
            'cleaning_frequency'    =>['required','integer'],
            'cleaning_points'       =>['required','integer']
        ]);

        $cleaningArea = new CleaningArea;
        $cleaningArea->name = $request->name;
        $cleaningArea->cleaning_description = $request->cleaning_description;
        $cleaningArea->cleaning_frequency = $request->cleaning_frequency;
        $cleaningArea->cleaning_points = $request->cleaning_points;
        $cleaningArea->save();

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

        $this->validate($request, [
            'name'                  =>['required','string','max:95'],
            'cleaning_description'  =>['required','string','max:200'],
            'cleaning_frequency'    =>['required','integer'],
            'cleaning_points'       =>['required','integer']
        ]);

        $areaDeLimpieza->update($request->all());

        return redirect()
            ->route('cleaningareas.index')
            ->with('exito','área de limpieza actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
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
