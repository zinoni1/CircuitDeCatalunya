<?php

namespace App\Http\Controllers;

use App\Models\api;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Averias;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $api = User::all();
        return response()->json($api, 200);
    }

    public function index2()
{
    $api = User::all();
    $data = []; // Inicializar un array para almacenar los datos

    foreach ($api as $user) {
        $email = $user->email;
        $password = $user->password;

        // Agregar los datos de cada usuario al array
        $data[] = [
            'email' => $email,
            'password' => $password
        ];
    }

    // Devolver los datos como una respuesta JSON con el código de estado 200
    return response()->json($data, 200);
}

public function verifyCredentials($email, $password){
    $user = User::where('email', $email)->first();
    Hash::make($password);
    $id = $user->id;
    if ($user) {
        if (password_verify($password, $user->password)) {
            return response()->json($id, 200);
        } else {
            return response()->json(false, 401);
        }
    } else {
        return response()->json(false, 404);
    }
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function uploadImage(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $image = $request->file('image');
    $imageName = $image->getClientOriginalName();

    Storage::disk('public')->put('images/' . $imageName, File::get($image));

    // Ruta relativa de la imagen
    $imagePath = 'storage/images/' . $imageName;

    return response()->json(['image_path' => $imagePath]);
}
    /**
     * Store a newly created resource in storage.
     */

     public function cambiarPassword($id, $password)
     {
         $user = User::findOrFail($id);

         $user->password = Hash::make($password);

         // Guardar la contraseña y verificar si se guardó correctamente
         if ($user->save()) {
             return response()->json(1, 200);
         } else {
             return response()->json(0, 401);
         }
     }

     public function averiesProgramades(){
        $averias = Averias::all();

        //count de averias
        $count = count($averias);
        return response()->json($count);
     }

     public function averiesUrgents(){
        //averias donde la prioridad es alta
        $averias = Averias::where('prioridad', 'alta')->get();

        //count de averias
        $count = count($averias);
        return response()->json($count);
     }

     public function statsPendents()
     {
         // Obtener la fecha de mañana
         $mañana = date('Y-m-d', strtotime('+1 day'));

         // Obtener las averías que son null o que tienen una fecha mayor a la de hoy
            $averias = Averias::where('data_fin', null)
                                ->orWhere('data_fin', '>', $mañana)
                                ->get();



         // Contar el número de averías pendientes
         $pendents = count($averias);

         // Retornar el número de averías pendientes como respuesta JSON
         return response()->json($pendents);
     }



    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(api $api)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(api $api)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, api $api)
    {
        //
    }

    public function createUser(Request $request)
    {
       //validar
         $request->validate([
          'name' => 'required',
          'email' => 'required|email|unique:users',
          'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'cargo_id' => $request->cargo_id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(api $api)
    {
        //
    }
}
