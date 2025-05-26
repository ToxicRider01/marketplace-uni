@extends('layouts.app')

@section('content')
<main class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Sidebar con filtros específicos para servicios -->
        <div class="lg:w-64">
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                <h2 class="text-lg font-semibold mb-4">Filtros para Servicios</h2>
                
                <form action="{{ route('categoria.servicios') }}" method="GET">
                    <!-- Tipo de servicio -->
                    <div class="mb-4">
                        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de servicio</label>
                        <select 
                            id="tipo" 
                            name="tipo" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="">Todos los servicios</option>
                            <option value="clases" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'clases' ? 'selected' : '' }}>Clases particulares</option>
                            <option value="asesoria" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'asesoria' ? 'selected' : '' }}>Asesoría académica</option>
                            <option value="diseno" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'diseno' ? 'selected' : '' }}>Diseño gráfico</option>
                            <option value="impresion" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'impresion' ? 'selected' : '' }}>Impresión y fotocopiado</option>
                            <option value="traduccion" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'traduccion' ? 'selected' : '' }}>Traducción</option>
                            <option value="programacion" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'programacion' ? 'selected' : '' }}>Programación</option>
                            <option value="otros" {{ isset($filtros['tipo']) && $filtros['tipo'] == 'otros' ? 'selected' : '' }}>Otros servicios</option>
                        </select>
                    </div>
                    
                    <!-- Modalidad -->
                    <div class="mb-4">
                        <label for="modalidad" class="block text-sm font-medium text-gray-700 mb-1">Modalidad</label>
                        <select 
                            id="modalidad" 
                            name="modalidad" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="">Todas las modalidades</option>
                            <option value="presencial" {{ isset($filtros['modalidad']) && $filtros['modalidad'] == 'presencial' ? 'selected' : '' }}>Presencial</option>
                            <option value="virtual" {{ isset($filtros['modalidad']) && $filtros['modalidad'] == 'virtual' ? 'selected' : '' }}>Virtual</option>
                            <option value="presencial_virtual" {{ isset($filtros['modalidad']) && $filtros['modalidad'] == 'presencial_virtual' ? 'selected' : '' }}>Presencial y virtual</option>
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
                        href="{{ route('categoria.servicios') }}" 
                        class="text-sm text-sky-600 hover:underline flex items-center"
                    >
                        <i class="fas fa-times-circle mr-1"></i> Limpiar filtros
                    </a>
                </div>
                @endif
            </div>
            
            <!-- Consejos para contratar servicios -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="font-semibold text-gray-800 mb-2">Consejos para contratar servicios</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Verifica las credenciales y experiencia del proveedor</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Solicita ejemplos de trabajos anteriores</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Aclara todos los detalles del servicio antes de contratar</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Establece plazos y entregables claros</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Contenido principal -->
        <div class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-hands-helping text-sky-500 mr-2"></i>
                    Servicios Académicos
                </h1>
                <span class="text-sm text-gray-500">{{ count($productos) }} servicios encontrados</span>
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
                                    onerror="this.src='https://via.placeholder.com/400x300?text=Servicio'"
                                >
                                <div class="absolute top-2 left-2 bg-sky-100 text-sky-800 text-xs px-2 py-1 rounded-full">
                                    {{ ucfirst($producto['tipo']) }}
                                </div>
                                <div class="absolute top-2 right-2 bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">
                                    @if($producto['modalidad'] == 'presencial')
                                        Presencial
                                    @elseif($producto['modalidad'] == 'virtual')
                                        Virtual
                                    @else
                                        Presencial/Virtual
                                    @endif
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900 mb-1 truncate">{{ $producto['titulo'] }}</h3>
                                <p class="text-green-600 font-bold">{{ $producto['precio'] }}</p>
                                <div class="mt-1 text-xs text-gray-500">
                                    @if(isset($producto['horario']))
                                    <p><span class="font-medium">Horario:</span> {{ $producto['horario'] }}</p>
                                    @endif
                                    @if(isset($producto['duracion']))
                                    <p><span class="font-medium">Duración:</span> {{ $producto['duracion'] }}</p>
                                    @endif
                                    @if(isset($producto['nivel']))
                                    <p><span class="font-medium">Nivel:</span> {{ $producto['nivel'] }}</p>
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
                    <i class="fas fa-hands-helping text-4xl text-gray-300 mb-3"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No se encontraron servicios</h3>
                    <p class="text-gray-500 mb-4">Intenta con otros filtros o revisa más tarde</p>
                    <a href="{{ route('categoria.servicios') }}" class="text-sky-600 hover:underline">Ver todos los servicios</a>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
