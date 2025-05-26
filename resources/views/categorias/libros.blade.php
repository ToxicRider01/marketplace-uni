@extends('layouts.app')

@section('content')
<main class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Sidebar con filtros específicos para libros -->
        <div class="lg:w-64">
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                <h2 class="text-lg font-semibold mb-4">Filtros para Libros</h2>
                
                <form action="{{ route('categoria.libros') }}" method="GET">
                    <!-- Carrera/Facultad -->
                    <div class="mb-4">
                        <label for="carrera" class="block text-sm font-medium text-gray-700 mb-1">Carrera/Facultad</label>
                        <select 
                            id="carrera" 
                            name="carrera" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="">Todas las carreras</option>
                            <option value="ingenieria" {{ isset($filtros['carrera']) && $filtros['carrera'] == 'ingenieria' ? 'selected' : '' }}>Ingeniería</option>
                            <option value="medicina" {{ isset($filtros['carrera']) && $filtros['carrera'] == 'medicina' ? 'selected' : '' }}>Medicina</option>
                            <option value="derecho" {{ isset($filtros['carrera']) && $filtros['carrera'] == 'derecho' ? 'selected' : '' }}>Derecho</option>
                            <option value="economia" {{ isset($filtros['carrera']) && $filtros['carrera'] == 'economia' ? 'selected' : '' }}>Economía y Negocios</option>
                            <option value="letras" {{ isset($filtros['carrera']) && $filtros['carrera'] == 'letras' ? 'selected' : '' }}>Letras y Humanidades</option>
                            <option value="ciencias" {{ isset($filtros['carrera']) && $filtros['carrera'] == 'ciencias' ? 'selected' : '' }}>Ciencias</option>
                            <option value="quimica" {{ isset($filtros['carrera']) && $filtros['carrera'] == 'quimica' ? 'selected' : '' }}>Química y Biología</option>
                            <option value="otros" {{ isset($filtros['carrera']) && $filtros['carrera'] == 'otros' ? 'selected' : '' }}>Otros</option>
                        </select>
                    </div>
                    
                    <!-- Tipo de libro -->
                    <div class="mb-4">
                        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de libro</label>
                        <select 
                            id="tipo" 
                            name="tipo" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="">Todos los tipos</option>
                            <option value="texto" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'texto' ? 'selected' : '' }}>Libro de texto</option>
                            <option value="guia" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'guia' ? 'selected' : '' }}>Guía de estudio</option>
                            <option value="atlas" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'atlas' ? 'selected' : '' }}>Atlas/Manual</option>
                            <option value="literatura" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'literatura' ? 'selected' : '' }}>Literatura</option>
                            <option value="diccionario" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'diccionario' ? 'selected' : '' }}>Diccionario/Enciclopedia</option>
                        </select>
                    </div>
                    
                    <!-- Estado del libro -->
                    <div class="mb-4">
                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <select 
                            id="estado" 
                            name="estado" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="">Todos los estados</option>
                            <option value="nuevo" {{ isset($filtros['estado']) && $filtros['estado'] == 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                            <option value="bueno" {{ isset($filtros['estado']) && $filtros['estado'] == 'bueno' ? 'selected' : '' }}>Buen estado</option>
                            <option value="usado" {{ isset($filtros['estado']) && $filtros['estado'] == 'usado' ? 'selected' : '' }}>Muy usado</option>
                        </select>
                    </div>
                    
                    <!-- Rango de precio -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rango de precio (S/.)</label>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="relative">
                                <span class="absolute left-2 top-2 text-gray-500 text-xs">S/.</span>
                                <input 
                                    type="number" 
                                    name="precio_min" 
                                    placeholder="Mín" 
                                    class="w-full pl-8 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                                    value="{{ $filtros['precio_min'] ?? '' }}"
                                    min="0"
                                >
                            </div>
                            <div class="relative">
                                <span class="absolute left-2 top-2 text-gray-500 text-xs">S/.</span>
                                <input 
                                    type="number" 
                                    name="precio_max" 
                                    placeholder="Máx" 
                                    class="w-full pl-8 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                                    value="{{ $filtros['precio_max'] ?? '' }}"
                                    min="0"
                                >
                            </div>
                        </div>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full bg-sky-500 text-white py-2 px-4 rounded-md hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
                    >
                        Aplicar filtros
                    </button>
                </form>
                
                @if(count($filtros))
                <div class="mt-3">
                    <a 
                        href="{{ route('categoria.libros') }}" 
                        class="text-sm text-sky-600 hover:underline flex items-center"
                    >
                        <i class="fas fa-times-circle mr-1"></i> Limpiar filtros
                    </a>
                </div>
                @endif
            </div>
            
            <!-- Consejos para comprar libros -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="font-semibold text-gray-800 mb-2">Consejos para comprar libros</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Verifica que todas las páginas estén completas</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Pregunta si hay subrayados o anotaciones</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Confirma la edición y año de publicación</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Consulta si el libro incluye material adicional (CD, códigos, etc.)</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Contenido principal -->
        <div class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-book text-sky-500 mr-2"></i>
                    Libros y Material Académico
                </h1>
                <span class="text-sm text-gray-500">{{ count($productos) }} productos encontrados</span>
            </div>
            
            @if(count($productos) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($productos as $producto)
                        <div class="bg-white rounded-lg overflow-hidden border border-gray-200 transition-shadow hover:shadow-md product-card cursor-pointer" data-product-id="{{ $producto['id'] }}">
                            <div class="relative h-48 bg-gray-100">
                                <img 
                                    src="{{ asset('images/' . $producto['imagen']) }}" 
                                    alt="{{ $producto['titulo'] }}" 
                                    class="w-full h-full object-cover"
                                    onerror="this.src='https://via.placeholder.com/400x300?text=Libro'"
                                >
                                <div class="absolute top-2 left-2 bg-sky-100 text-sky-800 text-xs px-2 py-1 rounded-full">
                                    {{ ucfirst($producto['carrera']) }}
                                </div>
                                <div class="absolute top-2 right-2 bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                    {{ ucfirst($producto['estado']) }}
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900 mb-1 truncate">{{ $producto['titulo'] }}</h3>
                                <p class="text-green-600 font-bold">{{ $producto['precio'] }}</p>
                                <div class="mt-1 text-xs text-gray-500">
                                    <p><span class="font-medium">Autor:</span> {{ $producto['autor'] }}</p>
                                    <p><span class="font-medium">Editorial:</span> {{ $producto['editorial'] }}</p>
                                    <p><span class="font-medium">Edición:</span> {{ $producto['edicion'] }}</p>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <span>Vendedor: {{ $producto['vendedor'] }}</span>
                                </div>
                                <div class="mt-2 text-sky-600 text-sm font-medium">Ver detalles</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg p-8 text-center shadow-sm">
                    <i class="fas fa-book text-4xl text-gray-300 mb-3"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No se encontraron libros</h3>
                    <p class="text-gray-500 mb-4">Intenta con otros filtros o revisa más tarde</p>
                    <a href="{{ route('categoria.libros') }}" class="text-sky-600 hover:underline">Ver todos los libros</a>
                </div>
            @endif
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach(card => {
            card.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                if (productId) {
                    window.location.href = `/producto/${productId}`;
                }
            });
        });
    });
</script>
@endsection
