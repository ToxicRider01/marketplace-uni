@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-xl font-semibold mb-4">Mis conversaciones</h2>

    @forelse($conversaciones as $usuario)
        <div class="mb-2">
            <a href="{{ route('chat.show', ['vendedor_id' => $usuario->id, 'producto_id' => 0]) }}" 
               class="text-sky-600 hover:underline">
                {{ $usuario->name }}
            </a>
        </div>
    @empty
        <p class="text-gray-600">Aún no tienes conversaciones.</p>
    @endforelse
</div>
@endsection
