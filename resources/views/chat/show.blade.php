@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-xl font-semibold mb-4">Chat con {{ $receptor->name }}</h2>

    <div class="bg-white shadow-md rounded p-4 mb-4 max-h-96 overflow-y-auto">
        @foreach($mensajes as $mensaje)
            <div class="mb-2">
                <span class="font-semibold {{ $mensaje->sender_id == auth()->id() ? 'text-sky-600' : 'text-gray-700' }}">
                    {{ $mensaje->sender->name }}:
                </span>
                <span>{{ $mensaje->content }}</span>
                <div class="text-xs text-gray-400">{{ $mensaje->created_at->diffForHumans() }}</div>
            </div>
        @endforeach
    </div>

    <form action="{{ route('chat.enviar') }}" method="POST" class="flex gap-2">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $receptor->id }}">
        <input type="text" name="content" placeholder="Escribe tu mensaje..." class="flex-1 border px-4 py-2 rounded" required>
        <button type="submit" class="bg-sky-600 text-white px-4 py-2 rounded hover:bg-sky-700">Enviar</button>
    </form>
</div>
@endsection
