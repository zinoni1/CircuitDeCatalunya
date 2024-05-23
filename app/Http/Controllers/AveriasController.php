<?php

namespace App\Http\Controllers;

use App\Models\averias;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\tipo_averias;
use App\Models\zonas;
use Illuminate\Support\Facades\DB;


class AveriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $averias = averias::with('tipo_averia', 'tecnico', 'zona')->get();
        $tipoAverias = tipo_averias::all();
        $usuarios = User::all();
        $zonas = zonas::all();

        return view('averias.index', ['averias' => $averias, 'tipoAverias' => $tipoAverias, 'usuarios' => $usuarios, 'Zonas' => $zonas]);
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
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->imagen->extension();  
        $request->imagen->move(public_path('images'), $imageName);

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
            'imagen' => $imageName,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'averia' => $averia], 200);
        } else {
            return redirect()->route('averias.index')->with('success', 'Avería creada exitosamente.');
        }
    }

    public function storeAndroid(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function dashboard()
{
    $averiasPorTipo = averias::select(DB::raw('count(*) as count, tipo_averias_id'))
        ->groupBy('tipo_averias_id')
        ->pluck('count', 'tipo_averias_id')->all();

    $tipoAverias = tipo_averias::whereIn('id', array_keys($averiasPorTipo))->pluck('nombre', 'id')->all();

    $labels = [];
    $data = [];

    foreach ($averiasPorTipo as $tipoId => $count) {
        $labels[] = $tipoAverias[$tipoId];
        $data[] = $count;
    }

    return view('dashboard', compact('labels', 'data'));
}


public function dashboard2()
{
    $averiasPorTipo = averias::select(DB::raw('count(*) as count, tipo_averias_id'))
        ->groupBy('tipo_averias_id')
        ->pluck('count', 'tipo_averias_id')->all();

    $tipoAverias = tipo_averias::whereIn('id', array_keys($averiasPorTipo))->pluck('nombre', 'id')->all();

    $labels = [];
    $data = [];

    foreach ($averiasPorTipo as $tipoId => $count) {
        $labels[] = $tipoAverias[$tipoId];
        $data[] = $count;
    }

    // Obtener las averías finalizadas y no finalizadas
    $averiasFinalizadas = averias::whereNotNull('data_fin')->count();
    $averiasNoFinalizadas = averias::whereNull('data_fin')->count();

    return view('dashboard', compact('labels', 'data', 'averiasFinalizadas', 'averiasNoFinalizadas'));
}
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Primero, utilizamos el modelo Averias para buscar en la base de datos la avería con el ID proporcionado.
        $averia = Averias::find($id);

        // Si no se encuentra ninguna avería con ese ID, redirigimos al usuario a la página de lista de averías con un mensaje de error.
        if (!$averia) {
            return redirect()->route('averias.index')->with('error', 'Avería no encontrada');
        }

        $usuarios = User::all();
        $tipoAverias = tipo_averias::all();
        $zonas = zonas::all();
        return view('averias.show', ['averia' => $averia, 'usuarios' => $usuarios, 'tipoAverias' => $tipoAverias, 'Zonas' => $zonas]);
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
    public function update(Request $request, $id)
    {
        $averia = Averias::find($id);

        $averia->Incidencia = $request->Incidencia;
        $averia->descripcion = $request->descripcion;
        $averia->data_inicio = $request->data_inicio;
        $averia->prioridad = $request->prioridad;
        $averia->tecnico_asignado_id = $request->tecnico_asignado_id;
        $averia->zona_id = $request->zona_id;
        $averia->tipo_averias_id = $request->tipo_averias_id;

        // Si data_fin es nulo, establecerlo como nulo en la base de datos
        if ($request->data_fin == null) {
            $averia->data_fin = null;
        } else {
            $averia->data_fin = $request->data_fin;
        }

        // Si se subió una imagen, guardarla
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
            $ubicacion = public_path('/imagenes/averias');
            $imagen->move($ubicacion, $nombreImagen);

            // Guardar el nombre de la imagen en la base de datos
            $averia->imagen = $nombreImagen;
        }

        $averia->save();

        return redirect()->route('averias.show', $averia->id)->with('info', 'Averia actualizada con éxito');
    }
    /**
     * Update the 'data_fin' field of the specified resource in storage.
     */
    public function updateDataFin(Request $request, $id)
    {
        $averias = averias::find($id);

        if ($averias) {
            $averias->data_fin = $request->get('data_fin');
            $averias->save();

            return response()->json([
                'success' => true,
                'message' => 'Fecha de finalización actualizada correctamente'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró la avería con el ID proporcionado'
            ], 404);
        }
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

    public function calendarEvents()
{
    $averias = averias::all()->map(function ($averia) {
        return [
            'title' => $averia->Incidencia,
            'start' => $averia->data_inicio,
            'end' => $averia->data_fin,
            'url' => route('averias.show', $averia->id),
        ];
    });

    return response()->json($averias);
}

}
