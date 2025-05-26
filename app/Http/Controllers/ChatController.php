<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Mostrar la conversación entre el usuario actual y otro usuario.
     */
    public function show($vendedor_id, $producto_id)
    {
        $userId = Auth::id();

        // Obtener mensajes entre el usuario autenticado y el vendedor
        $mensajes = Message::where(function ($query) use ($userId, $vendedor_id) {
            $query->where('sender_id', $userId)
                  ->orWhere('receiver_id', $userId);
        })->where(function ($query) use ($userId, $vendedor_id) {
            $query->where('sender_id', $vendedor_id)
                  ->orWhere('receiver_id', $vendedor_id);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        $vendedor = User::findOrFail($vendedor_id);

        return view('chat.show', compact('mensajes', 'vendedor', 'producto_id'));
    }

    /**
     * Enviar un nuevo mensaje.
     */
    public function enviarMensaje(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Mensaje enviado');
    }

    /**
     * Ver todos los chats del usuario actual.
     */
    public function misChats()
    {
        $userId = Auth::id();

        // Obtener IDs de usuarios con los que ha conversado
        $userIds = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->pluck('sender_id', 'receiver_id')
            ->flatten()
            ->unique()
            ->filter(fn($id) => $id != $userId)
            ->values();

        $usuarios = User::whereIn('id', $userIds)->get();

        return view('chat.mis-chats', compact('usuarios'));
    }
}
