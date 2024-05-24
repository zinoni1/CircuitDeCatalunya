<?php

namespace App\Http\Controllers;

use App\Models\sectors;
use App\Models\zonas;
use Illuminate\Http\Request;

class SectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectors = sectors::with('zona')->get();
        return view('sectors.index', ['sectors' => $sectors]);
    }
    public function indexAndroid(){
        $sectors = sectors::all();  
        return response()->json($sectors, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'zona_id' => 'required|exists:zonas,id',
        ]);

        $sectors = sectors::create([
            'nombre' => $request->nombre,
            'zona_id' => $request->zona_id,
        ]);

        return response()->json(['success' => true, 'sectors' => $sectors], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(sectors $sectors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sectors $sectors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sectors $sectors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sectors = sectors::find($id);
        if ($sectors) {
            $sectors->delete();
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
}
