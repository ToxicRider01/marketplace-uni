@extends('layouts.app')

@section('content')
<main class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Sidebar con filtros específicos para comida -->
        <div class="lg:w-64">
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                <h2 class="text-lg font-semibold mb-4">Filtros para Comida</h2>
                
                <form action="{{ route('categoria.comida') }}" method="GET">
                    <!-- Tipo de comida -->
                    <div class="mb-4">
                        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de comida</label>
                        <select 
                            id="tipo" 
                            name="tipo" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="">Todos los tipos</option>
                            <option value="menu" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'menu' ? 'selected' : '' }}>Menú completo</option>
                            <option value="snack" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'snack' ? 'selected' : '' }}>Snacks</option>
                            <option value="bebida" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'bebida' ? 'selected' : '' }}>Bebidas</option>
                            <option value="postre" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'postre' ? 'selected' : '' }}>Postres</option>
                            <option value="saludable" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'saludable' ? 'selected' : '' }}>Comida saludable</option>
                        </select>
                    </div>
                    
                    <!-- Dieta -->
                    <div class="mb-4">
                        <label for="dieta" class="block text-sm font-medium text-gray-700 mb-1">Dieta</label>
                        <select 
                            id="dieta" 
                            name="dieta" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="">Todas las dietas</option>
                            <option value="regular" {{ isset($filtros['dieta']) && $filtros['dieta'] == 'regular' ? 'selected' : '' }}>Regular</option>
                            <option value="vegetariano" {{ isset($filtros['dieta']) && $filtros['dieta'] == 'vegetariano' ? 'selected' : '' }}>Vegetariano</option>
                            <option value="vegano" {{ isset($filtros['dieta']) && $filtros['dieta'] == 'vegano' ? 'selected' : '' }}>Vegano</option>
                            <option value="sin_gluten" {{ isset($filtros['dieta']) && $filtros['dieta'] == 'sin_gluten' ? 'selected' : '' }}>Sin gluten</option>
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
                        href="{{ route('categoria.comida') }}" 
                        class="text-sm text-sky-600 hover:underline flex items-center"
                    >
                        <i class="fas fa-times-circle mr-1"></i> Limpiar filtros
                    </a>
                </div>
                @endif
            </div>
            
            <!-- Consejos para comprar comida -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="font-semibold text-gray-800 mb-2">Consejos para comprar comida</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Verifica los horarios de entrega</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Pregunta por los ingredientes si tienes alergias</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Consulta si hay costo adicional por delivery</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Verifica los métodos de pago aceptados</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Contenido principal -->
        <div class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-utensils text-sky-500 mr-2"></i>
                    Comida y Bebidas
                </h1>
                <span class="text-sm text-gray-500">{{ count($productos) }} productos encontrados</span>
            </div>
            
            @if(count($productos) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($productos as $producto)
                        <div class="bg-white rounded-lg overflow-hidden border border-gray-200 transition-shadow hover:shadow-md">
                            <div class="relative h-48 bg-gray-100">
                                <img 
                                    src="{{ asset('images/' . $producto['imagen']) }}" 
                                    alt="{{ $producto['titulo'] }}" 
                                    class="w-full h-full object-cover"
                                    onerror="this.src='https://via.placeholder.com/400x300?text=Comida'"
                                >
                                <div class="absolute top-2 left-2 bg-sky-100 text-sky-800 text-xs px-2 py-1 rounded-full">
                                    {{ ucfirst($producto['tipo']) }}
                                </div>
                                
                                @if(isset($producto['dietas']) && count($producto['dietas']) > 0)
                                <div class="absolute bottom-2 left-2 flex flex-wrap gap-1">
                                    @foreach($producto['dietas'] as $dieta)
                                        @if($dieta == 'vegetariano')
                                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Vegetariano</span>
                                        @elseif($dieta == 'vegano')
                                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Vegano</span>
                                        @elseif($dieta == 'sin_gluten')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Sin gluten</span>
                                        @endif
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900 mb-1 truncate">{{ $producto['titulo'] }}</h3>
                                <p class="text-green-600 font-bold">{{ $producto['precio'] }}</p>
                                <div class="mt-1 text-xs text-gray-500">
                                    @if(isset($producto['horario']))
                                    <p><span class="font-medium">Horario:</span> {{ $producto['horario'] }}</p>
                                    @endif
                                    @if(isset($producto['incluye']))
                                    <p><span class="font-medium">Incluye:</span> {{ $producto['incluye'] }}</p>
                                    @endif
                                    @if(isset($producto['metodo_pago']))
                                    <p><span class="font-medium">Pago:</span> 
                                        {{ implode(', ', array_map(function($metodo) {
                                            return ucfirst(str_replace('_', ' ', $metodo));
                                        }, $producto['metodo_pago'])) }}
                                    </p>
                                    @endif
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <span>Vendedor: {{ $producto['vendedor'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg p-8 text-center shadow-sm">
                    <i class="fas fa-utensils text-4xl text-gray-300 mb-3"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No se encontraron productos</h3>
                    <p class="text-gray-500 mb-4">Intenta con otros filtros o revisa más tarde</p>
                    <a href="{{ route('categoria.comida') }}" class="text-sky-600 hover:underline">Ver todos los productos</a>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
