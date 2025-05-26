@extends('layouts.app')

@section('content')
<main class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Sidebar con filtros -->
        <div class="lg:w-64">
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                <h2 class="text-lg font-semibold mb-4">Filtros de búsqueda</h2>
                
                <form action="{{ route('buscar') }}" method="GET">
                    <!-- Mantener la consulta de búsqueda -->
                    <input type="hidden" name="query" value="{{ $query }}">
                    
                    <!-- Filtro por categoría -->
                    <div class="mb-4">
                        <label for="categoria" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                        <select 
                            id="categoria" 
                            name="categoria" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="todos" {{ $categoria == 'todos' ? 'selected' : '' }}>Todas las categorías</option>
                            <option value="libros" {{ $categoria == 'libros' ? 'selected' : '' }}>Libros</option>
                            <option value="tecnologia" {{ $categoria == 'tecnologia' ? 'selected' : '' }}>Tecnología</option>
                            <option value="ropa" {{ $categoria == 'ropa' ? 'selected' : '' }}>Ropa</option>
                            <option value="servicios" {{ $categoria == 'servicios' ? 'selected' : '' }}>Servicios</option>
                            <option value="comida" {{ $categoria == 'comida' ? 'selected' : '' }}>Comida</option>
                        </select>
                    </div>
                    
                    <!-- Filtro por rango de precio -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rango de precio (S/.)</label>
                        
                        <!-- Rangos predefinidos de precios -->
                        <div class="grid grid-cols-3 gap-2 mb-3">
                            <a href="{{ route('buscar', ['query' => $query, 'categoria' => $categoria, 'precio_min' => 0, 'precio_max' => 50, 'ordenar' => $ordenar]) }}" 
                               class="text-center py-1 px-2 text-xs rounded {{ ($precioMin == 0 && $precioMax == 50) ? 'bg-sky-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                Hasta S/. 50
                            </a>
                            <a href="{{ route('buscar', ['query' => $query, 'categoria' => $categoria, 'precio_min' => 50, 'precio_max' => 100, 'ordenar' => $ordenar]) }}" 
                               class="text-center py-1 px-2 text-xs rounded {{ ($precioMin == 50 && $precioMax == 100) ? 'bg-sky-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                S/. 50 - 100
                            </a>
                            <a href="{{ route('buscar', ['query' => $query, 'categoria' => $categoria, 'precio_min' => 100, 'precio_max' => 500, 'ordenar' => $ordenar]) }}" 
                               class="text-center py-1 px-2 text-xs rounded {{ ($precioMin == 100 && $precioMax == 500) ? 'bg-sky-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                S/. 100 - 500
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2 mb-3">
                            <a href="{{ route('buscar', ['query' => $query, 'categoria' => $categoria, 'precio_min' => 500, 'precio_max' => 1000, 'ordenar' => $ordenar]) }}" 
                               class="text-center py-1 px-2 text-xs rounded {{ ($precioMin == 500 && $precioMax == 1000) ? 'bg-sky-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                S/. 500 - 1000
                            </a>
                            <a href="{{ route('buscar', ['query' => $query, 'categoria' => $categoria, 'precio_min' => 1000, 'precio_max' => '', 'ordenar' => $ordenar]) }}" 
                               class="text-center py-1 px-2 text-xs rounded {{ ($precioMin == 1000 && empty($precioMax)) ? 'bg-sky-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                Más de S/. 1000
                            </a>
                        </div>
                        
                        <!-- Separador -->
                        <div class="relative my-4">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span class="bg-white px-2 text-xs text-gray-500">o ingresa un rango personalizado</span>
                            </div>
                        </div>
                        
                        <!-- Campos para rango personalizado -->
                        <div class="flex items-center gap-2">
                            <div class="relative flex-1">
                                <span class="absolute left-2 top-2 text-gray-500 text-xs">S/.</span>
                                <input 
                                    type="number" 
                                    name="precio_min" 
                                    placeholder="Mín" 
                                    class="w-full pl-8 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                                    value="{{ $precioMin }}"
                                    min="0"
                                >
                            </div>
                            <span class="text-gray-500">-</span>
                            <div class="relative flex-1">
                                <span class="absolute left-2 top-2 text-gray-500 text-xs">S/.</span>
                                <input 
                                    type="number" 
                                    name="precio_max" 
                                    placeholder="Máx" 
                                    class="w-full pl-8 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                                    value="{{ $precioMax }}"
                                    min="0"
                                >
                            </div>
                        </div>
                    </div>
                    
                    <!-- Ordenar por -->
                    <div class="mb-4">
                        <label for="ordenar" class="block text-sm font-medium text-gray-700 mb-1">Ordenar por</label>
                        <select 
                            id="ordenar" 
                            name="ordenar" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="recientes" {{ $ordenar == 'recientes' ? 'selected' : '' }}>Más recientes</option>
                            <option value="precio_asc" {{ $ordenar == 'precio_asc' ? 'selected' : '' }}>Precio: menor a mayor</option>
                            <option value="precio_desc" {{ $ordenar == 'precio_desc' ? 'selected' : '' }}>Precio: mayor a menor</option>
                        </select>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full bg-sky-500 text-white py-2 px-4 rounded-md hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
                    >
                        Aplicar filtros
                    </button>
                </form>
                
                @if($query || $categoria != 'todos' || $precioMin || $precioMax)
                <div class="mt-3">
                    <a 
                        href="{{ route('buscar') }}" 
                        class="text-sm text-sky-600 hover:underline flex items-center"
                    >
                        <i class="fas fa-times-circle mr-1"></i> Limpiar filtros
                    </a>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Resultados de búsqueda -->
        <div class="flex-1">
            <!-- Agregar un indicador visual de los filtros activos -->
            @if($query || $categoria != 'todos' || $precioMin || $precioMax)
            <div class="bg-white rounded-lg p-3 mb-4 shadow-sm">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-sm font-medium text-gray-700">Filtros activos:</span>
                    
                    @if($query)
                    <div class="bg-sky-100 text-sky-800 text-xs px-2 py-1 rounded-full flex items-center">
                        <span>Búsqueda: {{ $query }}</span>
                        <a href="{{ route('buscar', ['categoria' => $categoria, 'precio_min' => $precioMin, 'precio_max' => $precioMax, 'ordenar' => $ordenar]) }}" class="ml-1 text-sky-600 hover:text-sky-800">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    </div>
                    @endif
                    
                    @if($categoria != 'todos')
                    <div class="bg-sky-100 text-sky-800 text-xs px-2 py-1 rounded-full flex items-center">
                        <span>Categoría: {{ ucfirst($categoria) }}</span>
                        <a href="{{ route('buscar', ['query' => $query, 'precio_min' => $precioMin, 'precio_max' => $precioMax, 'ordenar' => $ordenar]) }}" class="ml-1 text-sky-600 hover:text-sky-800">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    </div>
                    @endif
                    
                    @if($precioMin || $precioMax)
                    <div class="bg-sky-100 text-sky-800 text-xs px-2 py-1 rounded-full flex items-center">
                        <span>Precio: 
                            @if($precioMin && $precioMax)
                                S/. {{ $precioMin }} - S/. {{ $precioMax }}
                            @elseif($precioMin)
                                Desde S/. {{ $precioMin }}
                            @elseif($precioMax)
                                Hasta S/. {{ $precioMax }}
                            @endif
                        </span>
                        <a href="{{ route('buscar', ['query' => $query, 'categoria' => $categoria, 'ordenar' => $ordenar]) }}" class="ml-1 text-sky-600 hover:text-sky-800">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    </div>
                    @endif
                    
                    <a href="{{ route('buscar') }}" class="text-xs text-sky-600 hover:underline ml-auto">
                        Limpiar todos los filtros
                    </a>
                </div>
            </div>
            @endif
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">
                    @if($query)
                        Resultados para "{{ $query }}"
                    @else
                        Todos los productos
                    @endif
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
                                    onerror="this.src='https://via.placeholder.com/400x300?text=UniMarket'"
                                >
                                <div class="absolute top-2 left-2 bg-sky-100 text-sky-800 text-xs px-2 py-1 rounded-full">
                                    {{ ucfirst($producto['categoria']) }}
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900 mb-1 truncate">{{ $producto['titulo'] }}</h3>
                                <p class="text-green-600 font-bold">{{ $producto['precio'] }}</p>
                                <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $producto['descripcion'] }}</p>
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
                    <i class="fas fa-search text-4xl text-gray-300 mb-3"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No se encontraron resultados</h3>
                    <p class="text-gray-500 mb-4">Intenta con otros términos de búsqueda o filtros diferentes</p>
                    <a href="{{ route('home') }}" class="text-sky-600 hover:underline">Volver al inicio</a>
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
