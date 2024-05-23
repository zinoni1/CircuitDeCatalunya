<?php

namespace App\Http\Controllers;

use App\Models\chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function indexAndroid($idUser)
{
    $chats = Chat::where('id_enviat', $idUser)
                 ->orWhere('id_rebut', $idUser)
                 ->get();

    return response()->json($chats);
}


public function indexAndroidId($idGrupo, $idUser)
{
    // Obtener el chat con el ID proporcionado y donde el ID de envío o recepción sea igual a $idUser
    $chat = Chat::where('id_grupo', $idGrupo)
                ->where(function ($query) use ($idUser) {
                    $query->where('id_enviat', $idUser)
                          ->orWhere('id_rebut', $idUser);
                })
                ->get();

    // Verificar si se encontró un chat y retornar la respuesta correspondiente
    if ($chat) {
        return response()->json($chat, 200);
    } else {
        return response()->json(['message' => 'Chat not found'], 404);
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
    public function show(chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(chat $chat)
    {
        //
    }
}
