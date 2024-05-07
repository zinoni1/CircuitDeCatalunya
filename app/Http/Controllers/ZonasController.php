<?php

namespace App\Http\Controllers;

use App\Models\zonas;
use Illuminate\Http\Request;

class ZonasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zonas = zonas::all();
        return view('zonas.index', ['zonas' => $zonas]);
    }

    /**
     * Show the form for creating a new resource.
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
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255|unique:zonas,nombre',
        ]);

        $zonas = zonas::create([
            'nombre' => $request->nombre,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'zonas' => $zonas], 200);
        } else {
            return redirect()->route('zonas.index')->with('success', 'Zona creado exitosamente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(zonas $zonas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(zonas $zonas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, zonas $zonas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $zonas = zonas::find($id);
        if ($zonas) {
            $zonas->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
