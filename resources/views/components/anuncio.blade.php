@if(count($anuncios) > 0)
    @foreach($anuncios as $anuncio)
        @if($anuncio->tipo == 'google_adsense')
            <!-- Google AdSense -->
            <div class="anuncio anuncio-adsense mb-4">
                {!! $anuncio->codigo_adsense !!}
            </div>
        @else
            <!-- Anuncio interno o externo -->
            <div class="anuncio anuncio-{{ $anuncio->posicion }} mb-4">
                <a href="{{ $anuncio->url ?? '#' }}" 
                   target="_blank" 
                   class="block relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow"
                   onclick="registrarClic({{ $anuncio->id }})">
                    
                    @if($anuncio->imagen)
                        <img src="{{ asset('storage/' . $anuncio->imagen) }}" 
                             alt="{{ $anuncio->titulo }}" 
                             class="w-full h-auto object-cover"
                             onerror="this.src='https://via.placeholder.com/600x200?text=Anuncio'">
                    @endif
                    
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-gray-900">{{ $anuncio->titulo }}</h3>
                        @if($anuncio->descripcion)
                            <p class="text-sm text-gray-600 mt-1">{{ $anuncio->descripcion }}</p>
                        @endif
                        
                        <div class="flex items-center mt-2">
                            @if($anuncio->universidad)
                                <span class="text-xs text-gray-500">{{ $anuncio->universidad->siglas }}</span>
                            @endif
                            
                            <span class="text-xs text-gray-400 ml-auto">Anuncio</span>
                        </div>
                    </div>
                </a>
            </div>
        @endif
    @endforeach
    
    <script>
        function registrarClic(anuncioId) {
            fetch('{{ route("api.anuncios.clic") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    anuncio_id: anuncioId
                })
            });
        }
    </script>
@endif
