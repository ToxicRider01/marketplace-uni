@extends('layouts.app')

@section('content')
<main class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Main Content -->
        <div class="flex-1">
            <h1 class="text-2xl font-bold mb-6">Marketplace Estudiantil</h1>

            <!-- Agregar un banner de búsqueda avanzada en la página principal -->
            <div class="bg-gradient-to-r from-sky-500 to-sky-600 rounded-lg p-4 text-white shadow-md mb-6">
                <h3 class="font-bold text-lg mb-2">Encuentra lo que necesitas</h3>
                <p class="text-sm mb-3">Utiliza nuestra búsqueda avanzada con filtros por categoría y precio</p>
                
                <form action="{{ route('buscar') }}" method="GET" class="flex flex-col sm:flex-row gap-2">
                    <input 
                        type="text" 
                        name="query" 
                        placeholder="¿Qué estás buscando?" 
                        class="flex-1 px-3 py-2 rounded-md border-0 focus:ring-2 focus:ring-sky-300 text-gray-800"
                    >
                    <button 
                        type="submit" 
                        class="bg-white text-sky-600 hover:bg-sky-50 px-4 py-2 rounded-md font-medium"
                    >
                        <i class="fas fa-search mr-1"></i> Buscar
                    </button>
                </form>
            </div>

            <!-- Categorías destacadas -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Categorías</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <a href="{{ route('categoria.libros') }}" class="bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-book text-xl"></i>
                        </div>
                        <h3 class="font-medium">Libros</h3>
                    </a>
                    <a href="{{ route('categoria.tecnologia') }}" class="bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-laptop text-xl"></i>
                        </div>
                        <h3 class="font-medium">Tecnología</h3>
                    </a>
                    <a href="{{ route('categoria.ropa') }}" class="bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-tshirt text-xl"></i>
                        </div>
                        <h3 class="font-medium">Ropa</h3>
                    </a>
                    <a href="{{ route('categoria.servicios') }}" class="bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-hands-helping text-xl"></i>
                        </div>
                        <h3 class="font-medium">Servicios</h3>
                    </a>
                    <a href="{{ route('categoria.comida') }}" class="bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-utensils text-xl"></i>
                        </div>
                        <h3 class="font-medium">Comida</h3>
                    </a>
                    <a href="{{ route('categoria.muebles') }}" class="bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-chair text-xl"></i>
                        </div>
                        <h3 class="font-medium">Muebles</h3>
                    </a>
                    <a href="{{ route('categoria.deportes') }}" class="bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-futbol text-xl"></i>
                        </div>
                        <h3 class="font-medium">Deportes</h3>
                    </a>
                    <a href="{{ route('buscar') }}" class="bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-ellipsis-h text-xl"></i>
                        </div>
                        <h3 class="font-medium">Ver todo</h3>
                    </a>
                </div>
            </div>

            <!-- Category Filters -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Productos destacados</h2>
                <div class="bg-white border border-gray-200 rounded-md flex flex-wrap mb-4">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm {{ $categoriaActual == 'todos' ? 'bg-sky-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        Todos
                    </a>
                    <a href="{{ route('categoria', 'libros') }}" class="px-4 py-2 text-sm {{ $categoriaActual == 'libros' ? 'bg-sky-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        Libros
                    </a>
                    <a href="{{ route('categoria', 'tecnologia') }}" class="px-4 py-2 text-sm {{ $categoriaActual == 'tecnologia' ? 'bg-sky-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        Tecnología
                    </a>
                    <a href="{{ route('categoria', 'ropa') }}" class="px-4 py-2 text-sm {{ $categoriaActual == 'ropa' ? 'bg-sky-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        Ropa
                    </a>
                    <a href="{{ route('categoria', 'servicios') }}" class="px-4 py-2 text-sm {{ $categoriaActual == 'servicios' ? 'bg-sky-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        Servicios
                    </a>
                    <a href="{{ route('categoria', 'comida') }}" class="px-4 py-2 text-sm {{ $categoriaActual == 'comida' ? 'bg-sky-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        Comida
                    </a>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($productos as $producto)
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
                                @if(isset($producto['estado']))
                                <div class="absolute top-2 right-2 bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                    {{ ucfirst($producto['estado']) }}
                                </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900 mb-1 truncate">{{ $producto['titulo'] }}</h3>
                                <p class="text-green-600 font-bold">{{ $producto['precio'] }}</p>
                                <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $producto['descripcion'] }}</p>
                                <div class="mt-2 flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Vendedor: {{ $producto['vendedor'] }}</span>
                                    <span class="text-sky-600 text-sm font-medium">Ver detalles</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <p class="text-gray-500">No se encontraron productos en esta categoría.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar with Ads -->
        <div class="lg:w-72 space-y-4">
            <div class="bg-gradient-to-r from-sky-500 to-sky-600 rounded-lg p-4 text-white shadow-md">
                <h3 class="font-bold text-lg mb-1">Oferta Yape</h3>
                <p class="text-sm mb-2">¡10% de descuento en tu primera compra pagando con Yape!</p>
                <a href="#" class="block w-full py-1.5 text-sm bg-white text-sky-600 hover:bg-gray-100 rounded-md text-center">
                    Ver más
                </a>
            </div>

            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-4 text-white shadow-md">
                <h3 class="font-bold text-lg mb-1">Delivery Universitario</h3>
                <p class="text-sm mb-2">Entregas en campus de UNS, USP, UCV y más. ¡Rápido y seguro!</p>
                <a href="#" class="block w-full py-1.5 text-sm bg-white text-green-600 hover:bg-gray-100 rounded-md text-center">
                    Solicitar
                </a>
            </div>

            <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-lg p-4 text-white shadow-md">
                <h3 class="font-bold text-lg mb-1">Cursos Cortos</h3>
                <p class="text-sm mb-2">
                    Aprende habilidades prácticas en cursos de 4 semanas. ¡Certificados incluidos!
                </p>
                <a href="#" class="block w-full py-1.5 text-sm bg-white text-amber-600 hover:bg-gray-100 rounded-md text-center">
                    Explorar
                </a>
            </div>
            
            <!-- Modificar la sección de categorías populares -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="font-bold text-lg mb-3">Categorías populares</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('categoria.libros') }}?carrera=ingenieria" class="flex items-center text-gray-700 hover:text-sky-600">
                            <i class="fas fa-angle-right text-sky-500 mr-2"></i>
                            <span>Libros de Ingeniería</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categoria.tecnologia') }}?tipo=laptop" class="flex items-center text-gray-700 hover:text-sky-600">
                            <i class="fas fa-angle-right text-sky-500 mr-2"></i>
                            <span>Laptops</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categoria.servicios') }}?tipo=clases" class="flex items-center text-gray-700 hover:text-sky-600">
                            <i class="fas fa-angle-right text-sky-500 mr-2"></i>
                            <span>Clases particulares</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categoria.comida') }}?tipo=menu" class="flex items-center text-gray-700 hover:text-sky-600">
                            <i class="fas fa-angle-right text-sky-500 mr-2"></i>
                            <span>Menús universitarios</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categoria.ropa') }}?tipo=polera" class="flex items-center text-gray-700 hover:text-sky-600">
                            <i class="fas fa-angle-right text-sky-500 mr-2"></i>
                            <span>Poleras UNS y USP</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Anuncios Principales -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="font-bold text-lg mb-3">Anuncios Principales</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center text-gray-700 hover:text-sky-600">
                            <i class="fas fa-angle-right text-sky-500 mr-2"></i>
                            <span>Anuncio 1</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center text-gray-700 hover:text-sky-600">
                            <i class="fas fa-angle-right text-sky-500 mr-2"></i>
                            <span>Anuncio 2</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center text-gray-700 hover:text-sky-600">
                            <i class="fas fa-angle-right text-sky-500 mr-2"></i>
                            <span>Anuncio 3</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</main>
@endsection
