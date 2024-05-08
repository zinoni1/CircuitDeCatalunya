<?php

namespace App\Http\Controllers;

use App\Models\averias;
use App\Models\tipo_averias;
use App\Models\User;
use App\Models\zonas;
use Illuminate\Http\Request;

class AveriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $usuarios = User::all();
        $tipoAverias = tipo_averias::all();
        $Zonas = zonas::all();
        $averias = averias::with(['zona', 'tipo_averia'])->get();
        return view('averias.index', ['averias' => $averias, 'tipoAverias' => $tipoAverias, 'usuarios' => $usuarios, 'Zonas' => $Zonas]);
    }
    public function indexAndroid()
    {
        $averias = averias::all()->map(function ($averia) {
            $averia['image_url'] = asset('storage/images/' . $averia['imagen']); // Genera la URL completa para la imagen
            return $averia;
        });

        return response()->json($averias, 200);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::all();
        $tipoAverias = tipo_averias::all();
        return view('averias.create', compact('tipoAverias', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
        // Validar los datos del formulario
        $request->validate([
            'Incidencia' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'data_inicio' => 'required|date',
            'data_fin' => 'nullable|date',
            'prioridad' => 'required|in:baja,media,alta',
            'creator_id' => 'required',
            'tecnico_asignado_id' => 'required',
            'zona_id' => 'required',
            'tipo_averias_id' => 'required',
        ]);

        $averia = averias::create([
            'Incidencia' => $request->Incidencia,
            'descripcion' => $request->descripcion,
            'data_inicio' => $request->data_inicio,
            'data_fin' => $request->data_fin,
            'prioridad' => $request->prioridad,

            'creator_id' => $request->creator_id,
            'tecnico_asignado_id' => $request->tecnico_asignado_id,
            'zona_id' => $request->zona_id,
            'tipo_averias_id' => $request->tipo_averias_id,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'averia' => $averia], 200);
        } else {
            return redirect()->route('averias.index')->with('success', 'Avería creada exitosamente.');
        }
    }

    public function storeAndroid(Request $request)
    {
      try{
        $averia = averias::create([
            'Incidencia' => $request->Incidencia,
            'descripcion' => $request->descripcion,
            'data_inicio' => $request->data_inicio,
            'data_fin' => $request->data_fin,
            'prioridad' => $request->prioridad,
            'imagen' => $request->imagen,
            'creator_id' => $request->creator_id,
            'tecnico_asignado_id' => $request->tecnico_asignado_id,
            'asignador' => $request->asignador,
            'zona_id' => $request->zona_id,
            'tipo_averias_id' => $request->tipo_averias_id,
        ]);
        return response()->json(['success' => true, 'averia' => $averia], 200);
      }
        catch(\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(averias $averias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(averias $averias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, averias $averias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $averia = averias::find($id);
        if ($averia) {
            $averia->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
