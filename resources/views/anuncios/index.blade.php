@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">Anuncios en Video</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Anuncio con video de YouTube --}}
        <div class="bg-white rounded-xl shadow p-4">
            <h3 class="text-lg font-semibold mb-2">Anuncio con video</h3>

            @php
                $url = 'https://www.youtube.com/watch?v=SNcQxD8mR7o';
                preg_match('/(youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $url, $matches);
                $youtubeId = $matches[2] ?? null;
            @endphp

            @if($youtubeId)
                <iframe class="w-full aspect-video rounded"
                        src="https://www.youtube.com/embed/{{ $youtubeId }}"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            @endif

            <p class="mt-2 text-sm text-gray-600">Este es un anuncio de ejemplo con video de YouTube.</p>
        </div>
    </div>
</div>
@endsection
