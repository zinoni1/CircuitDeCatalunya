<?php

namespace App\Http\Controllers;

use App\Models\chat;
use Illuminate\Http\Request;
use App\Models\User;

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

public function obtenirGrupos($idUser)
{
    // Obtener los chats donde el ID de envío o recepción sea igual a $idUser
    $chats = Chat::where('id_enviat', $idUser)
                 ->orWhere('id_rebut', $idUser)
                 ->orderBy('created_at', 'desc')
                 ->get();

    // Crear un array para almacenar los datos de los grupos
    $grupos = [];

    // Iterar sobre los chats para obtener los IDs de los grupos y el último mensaje del grupo
    foreach ($chats as $chat) {
        $grupoId = $chat->id_grupo;

        //que coja el id del otro usuario del grupo
        if ($chat->id_enviat == $idUser) {
            $otro = $chat->id_rebut;
        } else {
            $otro = $chat->id_enviat;
        }
        // Si el grupo no está en el array, agregarlo con el primer mensaje encontrado (que es el más reciente debido al orden)
        if (!isset($grupos[$grupoId])) {
            $grupos[$grupoId] = [
                'id_grupo' => $grupoId,
                'ultimo_mensaje' => $chat->missatge,
                'id_recibido' => $otro
            ];
        }
    }

    // Convertir el array asociativo en un array indexado
    $grupos = array_values($grupos);

    // Retornar la respuesta con los datos de los grupos
    return response()->json($grupos, 200);
}

public function obtenirUsuarisDeCadaGrup($idUser)
{
    // Obtener los chats donde el ID de envío o recepción sea igual a $idUser
    $chats = Chat::where('id_enviat', $idUser)
        ->orWhere('id_rebut', $idUser)
        ->orderBy('created_at', 'desc')
        ->get();

    // Crear un array para almacenar los datos de los grupos
    $grupos = [];

    // Iterar sobre los chats para obtener los IDs de los grupos y el último mensaje del grupo
    foreach ($chats as $chat) {
        $grupoId = $chat->id_grupo;

        // Obtener el id del otro usuario del grupo
        if ($chat->id_enviat == $idUser) {
            $otro = $chat->id_rebut;
        } else {
            $otro = $chat->id_enviat;
        }

        // Si el grupo no está en el array, agregarlo con el primer mensaje encontrado (que es el más reciente debido al orden)
        if (!isset($grupos[$grupoId])) {
            $grupos[$grupoId] = [
                'id_grupo' => $grupoId,
                'ultimo_mensaje' => $chat->missatge,
                'usuarios' => []
            ];
        }

        // Agregar el usuario al grupo
        if (!in_array($otro, $grupos[$grupoId]['usuarios'])) {
            $grupos[$grupoId]['usuarios'][] = $otro;
        }
    }

    // Convertir el array asociativo en un array indexado
    $grupos = array_values($grupos);

    // Ahora con todos los grupos, de cada grupo obtener sus usuarios
    $usuarios = [];
    foreach ($grupos as $grupo) {
        foreach ($grupo['usuarios'] as $usuario) {
            if ($usuario != $idUser) {
                $usuarios[] = [
                    'id_grupo' => $grupo['id_grupo'],
                    'id_usuario' => $usuario
                ];
            }
        }
    }

    // Retornar la respuesta con los datos de los grupos
    return response()->json($usuarios, 200);
}
public function idGrupGran(){
    //cojer el ultimo id de grupo
    $chats = Chat::orderBy('id_grupo', 'desc')->first();
    $idgrupo = $chats->id_grupo + 1;
    return response()->json($idgrupo, 200);
}

public function chatsNoEmpezados($idUser)
{
    // Obtener los usuarios con los que el usuario actual ha enviado mensajes
    $enviats = Chat::where('id_enviat', $idUser)->pluck('id_rebut')->toArray();

    // Obtener los usuarios que han enviado mensajes al usuario actual
    $rebuts = Chat::where('id_rebut', $idUser)->pluck('id_enviat')->toArray();

    // Combinar y eliminar duplicados
    $conversacions = array_unique(array_merge($enviats, $rebuts));

    // Obtener todos los usuarios excepto el usuario actual
    $todosUsers = User::where('id', '!=', $idUser)->pluck('id')->toArray();

    // Filtrar los usuarios con los que el usuario actual no ha tenido conversaciones
    $usuariosSenseConversacions = array_filter($todosUsers, function ($userId) use ($conversacions) {
        return !in_array($userId, $conversacions);
    });

    // Devolver la respuesta en formato JSON
    return response()->json(array_values($usuariosSenseConversacions), 200);
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

    public function storeAndroid(Request $request){
        $chat = new Chat();
        $chat->id_grupo = $request->id_grupo;
        $chat->id_enviat = $request->id_enviat;
        $chat->id_rebut = $request->id_rebut;
        $chat->missatge = $request->missatge;
        $chat->save();

        return response()->json($chat, 201);
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
