<?php

namespace App\Http\Controllers;

use App\Models\cargos;
use Illuminate\Http\Request;

class CargosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cargos = cargos::all();
        return view('cargos.index', ['cargos' => $cargos]);
    }
    public function indexAndroid(){
        $cargos = cargos::all();
        return response()->json($cargos, 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255|unique:zonas,nombre',
        ]);

        $cargos = cargos::create([
            'nombre' => $request->nombre,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'zonas' => $cargos], 200);
        } else {
            return redirect()->route('cargos.index')->with('success', 'Cargos creado exitosamente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(cargos $cargos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cargos $cargos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cargos $cargos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cargos = cargos::find($id);
        if ($cargos) {
            $cargos->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

}
