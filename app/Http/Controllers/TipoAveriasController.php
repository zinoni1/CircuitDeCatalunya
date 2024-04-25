<?php

namespace App\Http\Controllers;

use App\Models\tipo_averias;
use Illuminate\Http\Request;

class TipoAveriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoAverias = tipo_averias::all();
        return view('tipo_averias.index', ['tipoAverias' => $tipoAverias]);
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
            'nombre' => 'required|string|max:255|unique:tipo_averias,nombre',
        ]);

        tipo_averias::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('tipo-averias.index')->with('success', 'Tipo de avería creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(tipo_averias $tipo_averias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tipo_averias $tipo_averias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tipo_averias $tipo_averias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tipo_averias $tipo_averias)
    {
        //
    }
}
