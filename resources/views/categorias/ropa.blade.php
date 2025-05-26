@extends('layouts.app')

@section('content')
<main class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Sidebar con filtros específicos para ropa -->
        <div class="lg:w-64">
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                <h2 class="text-lg font-semibold mb-4">Filtros para Ropa</h2>
                
                <form action="{{ route('categoria.ropa') }}" method="GET">
                    <!-- Tipo de prenda -->
                    <div class="mb-4">
                        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de prenda</label>
                        <select 
                            id="tipo" 
                            name="tipo" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="">Todas las prendas</option>
                            <option value="polera" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'polera' ? 'selected' : '' }}>Poleras</option>
                            <option value="polo" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'polo' ? 'selected' : '' }}>Polos</option>
                            <option value="casaca" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'casaca' ? 'selected' : '' }}>Casacas</option>
                            <option value="pantalon" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'pantalon' ? 'selected' : '' }}>Pantalones</option>
                            <option value="calzado" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'calzado' ? 'selected' : '' }}>Calzado</option>
                            <option value="mochila" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'mochila' ? 'selected' : '' }}>Mochilas</option>
                            <option value="accesorios" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'accesorios' ? 'selected' : '' }}>Accesorios</option>
                        </select>
                    </div>
                    
                    <!-- Talla -->
                    <div class="mb-4">
                        <label for="talla" class="block text-sm font-medium text-gray-700 mb-1">Talla</label>
                        <select 
                            id="talla" 
                            name="talla" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="">Todas las tallas</option>
                            <option value="XS" {{ isset($filtros['talla']) && $filtros['talla'] == 'XS' ? 'selected' : '' }}>XS</option>
                            <option value="S" {{ isset($filtros['talla']) && $filtros['talla'] == 'S' ? 'selected' : '' }}>S</option>
                            <option value="M" {{ isset($filtros['talla']) && $filtros['talla'] == 'M' ? 'selected' : '' }}>M</option>
                            <option value="L" {{ isset($filtros['talla']) && $filtros['talla'] == 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ isset($filtros['talla']) && $filtros['talla'] == 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ isset($filtros['talla']) && $filtros['talla'] == 'XXL' ? 'selected' : '' }}>XXL</option>
                            <option value="38" {{ isset($filtros['talla']) && $filtros['talla'] == '38' ? 'selected' : '' }}>38</option>
                            <option value="39" {{ isset($filtros['talla']) && $filtros['talla'] == '39' ? 'selected' : '' }}>39</option>
                            <option value="40" {{ isset($filtros['talla']) && $filtros['talla'] == '40' ? 'selected' : '' }}>40</option>
                            <option value="41" {{ isset($filtros['talla']) && $filtros['talla'] == '41' ? 'selected' : '' }}>41</option>
                            <option value="42" {{ isset($filtros['talla']) && $filtros['talla'] == '42' ? 'selected' : '' }}>42</option>
                        </select>
                    </div>
                    
                    <!-- Género -->
                    <div class="mb-4">
                        <label for="genero" class="block text-sm font-medium text-gray-700 mb-1">Género</label>
                        <select 
                            id="genero" 
                            name="genero" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="">Todos</option>
                            <option value="masculino" {{ isset($filtros['genero']) && $filtros['genero'] == 'masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="femenino" {{ isset($filtros['genero']) && $filtros['genero'] == 'femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="unisex" {{ isset($filtros['genero']) && $filtros['genero'] == 'unisex' ? 'selected' : '' }}>Unisex</option>
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
                        href="{{ route('categoria.ropa') }}" 
                        class="text-sm text-sky-600 hover:underline flex items-center"
                    >
                        <i class="fas fa-times-circle mr-1"></i> Limpiar filtros
                    </a>
                </div>
                @endif
            </div>
            
            <!-- Consejos para comprar ropa -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="font-semibold text-gray-800 mb-2">Consejos para comprar ropa</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Verifica las medidas exactas de la prenda</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Pregunta si la prenda ha sido lavada o tiene decoloración</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Consulta por posibles defectos o reparaciones</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Pide fotos adicionales si compras sin ver la prenda</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Contenido principal -->
        <div class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-tshirt text-sky-500 mr-2"></i>
                    Ropa y Accesorios
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
                                    onerror="this.src='https://via.placeholder.com/400x300?text=Ropa'"
                                >
                                <div class="absolute top-2 left-2 bg-sky-100 text-sky-800 text-xs px-2 py-1 rounded-full">
                                    {{ ucfirst($producto['tipo']) }}
                                </div>
                                @if(isset($producto['talla']))
                                <div class="absolute top-2 right-2 bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">
                                    Talla {{ $producto['talla'] }}
                                </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900 mb-1 truncate">{{ $producto['titulo'] }}</h3>
                                <p class="text-green-600 font-bold">{{ $producto['precio'] }}</p>
                                <div class="mt-1 text-xs text-gray-500">
                                    @if(isset($producto['color']))
                                    <p><span class="font-medium">Color:</span> {{ $producto['color'] }}</p>
                                    @endif
                                    @if(isset($producto['material']))
                                    <p><span class="font-medium">Material:</span> {{ $producto['material'] }}</p>
                                    @endif
                                    @if(isset($producto['genero']))
                                    <p><span class="font-medium">Género:</span> {{ ucfirst($producto['genero']) }}</p>
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
                    <i class="fas fa-tshirt text-4xl text-gray-300 mb-3"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No se encontraron prendas</h3>
                    <p class="text-gray-500 mb-4">Intenta con otros filtros o revisa más tarde</p>
                    <a href="{{ route('categoria.ropa') }}" class="text-sky-600 hover:underline">Ver toda la ropa</a>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
