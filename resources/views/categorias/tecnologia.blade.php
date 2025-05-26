@extends('layouts.app')

@section('content')
<main class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Sidebar con filtros específicos para tecnología -->
        <div class="lg:w-64">
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                <h2 class="text-lg font-semibold mb-4">Filtros para Tecnología</h2>
                
                <form action="{{ route('categoria.tecnologia') }}" method="GET">
                    <!-- Tipo de dispositivo -->
                    <div class="mb-4">
                        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de dispositivo</label>
                        <select 
                            id="tipo" 
                            name="tipo" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="">Todos los dispositivos</option>
                            <option value="laptop" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'laptop' ? 'selected' : '' }}>Laptops</option>
                            <option value="tablet" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'tablet' ? 'selected' : '' }}>Tablets</option>
                            <option value="celular" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'celular' ? 'selected' : '' }}>Celulares</option>
                            <option value="monitor" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'monitor' ? 'selected' : '' }}>Monitores</option>
                            <option value="audio" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'audio' ? 'selected' : '' }}>Audio</option>
                            <option value="calculadora" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'calculadora' ? 'selected' : '' }}>Calculadoras</option>
                            <option value="accesorios" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'accesorios' ? 'selected' : '' }}>Accesorios</option>
                        </select>
                    </div>
                    
                    <!-- Marca -->
                    <div class="mb-4">
                        <label for="marca" class="block text-sm font-medium text-gray-700 mb-1">Marca</label>
                        <select 
                            id="marca" 
                            name="marca" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="">Todas las marcas</option>
                            <option value="HP" {{ isset($filtros['marca']) && $filtros['marca'] == 'HP' ? 'selected' : '' }}>HP</option>
                            <option value="Dell" {{ isset($filtros['marca']) && $filtros['marca'] == 'Dell' ? 'selected' : '' }}>Dell</option>
                            <option value="Lenovo" {{ isset($filtros['marca']) && $filtros['marca'] == 'Lenovo' ? 'selected' : '' }}>Lenovo</option>
                            <option value="Apple" {{ isset($filtros['marca']) && $filtros['marca'] == 'Apple' ? 'selected' : '' }}>Apple</option>
                            <option value="Samsung" {{ isset($filtros['marca']) && $filtros['marca'] == 'Samsung' ? 'selected' : '' }}>Samsung</option>
                            <option value="Sony" {{ isset($filtros['marca']) && $filtros['marca'] == 'Sony' ? 'selected' : '' }}>Sony</option>
                            <option value="Casio" {{ isset($filtros['marca']) && $filtros['marca'] == 'Casio' ? 'selected' : '' }}>Casio</option>
                            <option value="LG" {{ isset($filtros['marca']) && $filtros['marca'] == 'LG' ? 'selected' : '' }}>LG</option>
                        </select>
                    </div>
                    
                    <!-- Estado -->
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
                        href="{{ route('categoria.tecnologia') }}" 
                        class="text-sm text-sky-600 hover:underline flex items-center"
                    >
                        <i class="fas fa-times-circle mr-1"></i> Limpiar filtros
                    </a>
                </div>
                @endif
            </div>
            
            <!-- Consejos para comprar tecnología -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="font-semibold text-gray-800 mb-2">Consejos para comprar tecnología</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Verifica que el dispositivo funcione correctamente</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Pregunta por la duración de la batería</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Solicita ver el dispositivo encendido antes de comprar</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Consulta si incluye cargador y accesorios originales</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Contenido principal -->
        <div class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-laptop text-sky-500 mr-2"></i>
                    Tecnología y Electrónicos
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
                                    onerror="this.src='https://via.placeholder.com/400x300?text=Tecnología'"
                                >
                                <div class="absolute top-2 left-2 bg-sky-100 text-sky-800 text-xs px-2 py-1 rounded-full">
                                    {{ ucfirst($producto['tipo']) }}
                                </div>
                                <div class="absolute top-2 right-2 bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                    {{ ucfirst($producto['estado']) }}
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900 mb-1 truncate">{{ $producto['titulo'] }}</h3>
                                <p class="text-green-600 font-bold">{{ $producto['precio'] }}</p>
                                <div class="mt-1 text-xs text-gray-500">
                                    <p><span class="font-medium">Marca:</span> {{ $producto['marca'] }}</p>
                                    <p><span class="font-medium">Modelo:</span> {{ $producto['modelo'] }}</p>
                                    @if(isset($producto['especificaciones']))
                                        @foreach(array_slice($producto['especificaciones'], 0, 2) as $key => $value)
                                            <p><span class="font-medium">{{ $key }}:</span> {{ $value }}</p>
                                        @endforeach
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
                    <i class="fas fa-laptop text-4xl text-gray-300 mb-3"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No se encontraron dispositivos</h3>
                    <p class="text-gray-500 mb-4">Intenta con otros filtros o revisa más tarde</p>
                    <a href="{{ route('categoria.tecnologia') }}" class="text-sky-600 hover:underline">Ver todos los dispositivos</a>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
