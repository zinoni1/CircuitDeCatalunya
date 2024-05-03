<?php

namespace App\Http\Controllers;

use App\Models\api;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(api $api)
    {
        //
    }
}
