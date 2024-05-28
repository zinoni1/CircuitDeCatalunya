<?php

namespace App\Http\Controllers;

use App\Models\averias_anonimas;
use Illuminate\Http\Request;

class AveriasAnonimasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $averias = averias_anonimas::all();
        return view('averiasAnonimas.index', compact('averias'));
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
            'email' => 'required|string|email|max:255',
            'descripcion' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('imagen')) {
            $imageName = time().'.'.$request->imagen->extension();  
            $request->imagen->move(public_path('images'), $imageName);
        }

        $averia = averias_anonimas::create([
            'email' => $request->email,
            'descripcion' => $request->descripcion,
            'imagen' => $imageName,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'averia' => $averia], 200);
        } else {
            return redirect()->route('averiasAnonimas.index')->with('success', 'Avería creada exitosamente.');
        }
    }
    

    /**
     * Display the specified resource.
     */
 

    public function show($id)
    {
        // Buscar la avería anónima por su ID
        $averia = averias_anonimas::findOrFail($id);

        // Pasar la avería anónima a la vista
        return view('averiasAnonimas.show', compact('averia'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(averias_anonimas $averias_anonimas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, averias_anonimas $averias_anonimas)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(averias_anonimas $averias_anonimas)
    {
    }
}