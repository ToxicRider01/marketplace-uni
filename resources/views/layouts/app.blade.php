<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniMarket - Marketplace Estudiantil</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sky: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                            950: '#082f49',
                        },
                        green: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                            950: '#052e16',
                        },
                    }
                }
            }
        }
    </script>
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Después de la sección de scripts de Tailwind -->
    <script>
        // Asegurarse de que los enlaces funcionen correctamente
        document.addEventListener('DOMContentLoaded', function() {
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach(card => {
                card.addEventListener('click', function(e) {
                    const productId = this.getAttribute('data-product-id');
                    if (productId) {
                        window.location.href = `/producto/${productId}`;
                    }
                });
            });
        });
    </script>
</head>
<body class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="sticky top-0 z-10 bg-white shadow-sm">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <i class="fas fa-shopping-bag text-sky-500 text-xl"></i>
                    <span class="text-xl font-bold text-sky-500">UniMarket</span>
                </a>
                <!-- Reemplazar el div de búsqueda en el header con este formulario funcional -->
                <div class="hidden md:flex relative w-64 lg:w-96">
                    <form action="{{ route('buscar') }}" method="GET" class="w-full">
                        <i class="fas fa-search absolute left-2 top-2.5 text-gray-400 text-sm"></i>
                        <input 
                            type="text" 
                            name="query" 
                            placeholder="Buscar productos..." 
                            class="w-full pl-8 py-2 rounded-md bg-gray-100 border-0 focus:ring-2 focus:ring-sky-500 focus:outline-none"
                            value="{{ request('query') ?? '' }}"
                        >
                    </form>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}" class="px-3 py-1.5 text-sm border border-sky-200 rounded-md text-sky-600 hover:bg-sky-50">
                    Iniciar Sesión
                </a>
                <a href="{{ route('registro') }}" class="px-3 py-1.5 text-sm bg-sky-500 hover:bg-sky-600 text-white rounded-md">
                    Registrarse
                </a>
            </div>
        </div>
        <!-- Reemplazar también la versión móvil de la búsqueda -->
        <div class="md:hidden container mx-auto px-4 pb-3">
            <div class="relative">
                <form action="{{ route('buscar') }}" method="GET" class="w-full">
                    <i class="fas fa-search absolute left-2 top-2.5 text-gray-400 text-sm"></i>
                    <input 
                        type="text" 
                        name="query" 
                        placeholder="Buscar productos..." 
                        class="w-full pl-8 py-2 rounded-md bg-gray-100 border-0 focus:ring-2 focus:ring-sky-500 focus:outline-none"
                        value="{{ request('query') ?? '' }}"
                    >
                </form>
            </div>
        </div>
    </header>

    <!-- Contenido principal -->
    @yield('content')

    <!-- Floating Action Button -->
    <div class="fixed bottom-6 right-6">
        <a href="{{ route('publicar') }}" class="flex items-center justify-center rounded-full h-14 w-14 bg-green-500 hover:bg-green-600 shadow-lg text-white">
            <i class="fas fa-plus text-xl"></i>
            <span class="sr-only">Publicar producto</span>
        </a>
    </div>
</body>
</html>
