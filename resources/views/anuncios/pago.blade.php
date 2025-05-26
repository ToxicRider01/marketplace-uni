@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-3xl mx-auto">
        <!-- Encabezado -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Pago de anuncio</h1>
            <p class="text-gray-600 mt-1">Complete el pago para activar su anuncio</p>
        </div>
        
        <!-- Resumen del anuncio -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Resumen del anuncio</h2>
            
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Imagen del anuncio -->
                @if($anuncio->imagen)
                <div class="md:w-1/3">
                    <img 
                        src="{{ asset('storage/' . $anuncio->imagen) }}" 
                        alt="{{ $anuncio->titulo }}" 
                        class="w-full h-auto rounded-lg"
                        onerror="this.src='https://via.placeholder.com/400x300?text=Anuncio'"
                    >
                </div>
                @endif
                
                <!-- Detalles del anuncio -->
                <div class="md:w-2/3">
                    <h3 class="font-medium text-gray-900 text-lg mb-2">{{ $anuncio->titulo }}</h3>
                    
                    @if($anuncio->descripcion)
                    <p class="text-gray-600 mb-4">{{ $anuncio->descripcion }}</p>
                    @endif
                    
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500">Posición:</p>
                            <p class="font-medium">
                                @if($anuncio->posicion == 'banner_principal')
                                    Banner principal
                                @elseif($anuncio->posicion == 'sidebar')
                                    Barra lateral
                                @elseif($anuncio->posicion == 'entre_productos')
                                    Entre productos
                                @elseif($anuncio->posicion == 'footer')
                                    Pie de página
                                @endif
                            </p>
                        </div>
                        
                        <div>
                            <p class="text-gray-500">Tipo:</p>
                            <p class="font-medium">
                                @if($anuncio->tipo == 'interno')
                                    Anuncio interno
                                @elseif($anuncio->tipo == 'externo')
                                    Anuncio externo
                                @elseif($anuncio->tipo == 'google_adsense')
                                    Google AdSense
                                @endif
                            </p>
                        </div>
                        
                        <div>
                            <p class="text-gray-500">Fecha de inicio:</p>
                            <p class="font-medium">{{ $anuncio->fecha_inicio->format('d/m/Y') }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-500">Fecha de fin:</p>
                            <p class="font-medium">{{ $anuncio->fecha_fin->format('d/m/Y') }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-500">Duración:</p>
                            <p class="font-medium">{{ $anuncio->fecha_inicio->diffInDays($anuncio->fecha_fin) }} días</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-500">Estado:</p>
                            <p class="font-medium text-amber-600">Pendiente de pago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Formulario de pago -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Detalles de pago</h2>
            
            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg mb-6">
                <span class="text-gray-700">Total a pagar:</span>
                <span class="text-xl font-bold text-gray-900">S/. {{ number_format($anuncio->precio, 2) }}</span>
            </div>
            
            <form action="{{ route('anuncios.procesar-pago', $anuncio->id) }}" method="POST">
                @csrf
                
                <!-- Métodos de pago -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Seleccione un método de pago</label>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <label class="relative border border-gray-300 rounded-lg p-4 cursor-pointer hover:bg-gray-50 transition-colors" id="metodo-tarjeta">
                            <input type="radio" name="metodo_pago" value="tarjeta" class="hidden" required>
                            <div class="text-center">
                                <i class="fas fa-credit-card text-2xl mb-2 text-gray-400"></i>
                                <p class="text-sm font-medium">Tarjeta</p>
                            </div>
                            <div class="hidden absolute top-2 right-2 text-sky-500" id="check-tarjeta">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </label>
                        
                        <label class="relative border border-gray-300 rounded-lg p-4 cursor-pointer hover:bg-gray-50 transition-colors" id="metodo-yape">
                            <input type="radio" name="metodo_pago" value="yape" class="hidden">
                            <div class="text-center">
                                <i class="fas fa-mobile-alt text-2xl mb-2 text-gray-400"></i>
                                <p class="text-sm font-medium">Yape</p>
                            </div>
                            <div class="hidden absolute top-2 right-2 text-sky-500" id="check-yape">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </label>
                        
                        <label class="relative border border-gray-300 rounded-lg p-4 cursor-pointer hover:bg-gray-50 transition-colors" id="metodo-plin">
                            <input type="radio" name="metodo_pago" value="plin" class="hidden">
                            <div class="text-center">
                                <i class="fas fa-qrcode text-2xl mb-2 text-gray-400"></i>
                                <p class="text-sm font-medium">Plin</p>
                            </div>
                            <div class="hidden absolute top-2 right-2 text-sky-500" id="check-plin">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </label>
                        
                        <label class="relative border border-gray-300 rounded-lg p-4 cursor-pointer hover:bg-gray-50 transition-colors" id="metodo-transferencia">
                            <input type="radio" name="metodo_pago" value="transferencia" class="hidden">
                            <div class="text-center">
                                <i class="fas fa-university text-2xl mb-2 text-gray-400"></i>
                                <p class="text-sm font-medium">Transferencia</p>
                            </div>
                            <div class="hidden absolute top-2 right-2 text-sky-500" id="check-transferencia">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </label>
                    </div>
                </div>
                
                <!-- Detalles de pago (cambian según el método seleccionado) -->
                <div class="mb-6 hidden" id="detalles-tarjeta">
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h3 class="font-medium text-gray-800 mb-3">Detalles de la tarjeta</h3>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Número de tarjeta</label>
                            <input 
                                type="text" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                                placeholder="1234 5678 9012 3456"
                            >
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de expiración</label>
                                <input 
                                    type="text" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                                    placeholder="MM/AA"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                <input 
                                    type="text" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                                    placeholder="123"
                                >
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre en la tarjeta</label>
                            <input 
                                type="text" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                                placeholder="Juan Pérez"
                            >
                        </div>
                    </div>
                </div>
                
                <div class="mb-6 hidden" id="detalles-yape">
                    <div class="border border-gray-200 rounded-lg p-4 text-center">
                        <h3 class="font-medium text-gray-800 mb-3">Pago con Yape</h3>
                        
                        <div class="bg-purple-50 p-4 rounded-lg mb-4 mx-auto max-w-xs">
                            <img src="https://via.placeholder.com/200x200?text=QR+Yape" alt="QR Yape" class="mx-auto">
                        </div>
                        
                        <p class="text-sm text-gray-600 mb-2">Escanea el código QR con la app de Yape</p>
                        <p class="font-medium">o envía a: 987654321</p>
                        
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Número de operación</label>
                            <input 
                                type="text" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                                placeholder="Ingresa el número de operación"
                            >
                        </div>
                    </div>
                </div>
                
                <div class="mb-6 hidden" id="detalles-plin">
                    <div class="border border-gray-200 rounded-lg p-4 text-center">
                        <h3 class="font-medium text-gray-800 mb-3">Pago con Plin</h3>
                        
                        <div class="bg-green-50 p-4 rounded-lg mb-4 mx-auto max-w-xs">
                            <img src="https://via.placeholder.com/200x200?text=QR+Plin" alt="QR Plin" class="mx-auto">
                        </div>
                        
                        <p class="text-sm text-gray-600 mb-2">Escanea el código QR con la app de Plin</p>
                        <p class="font-medium">o envía a: 987654321</p>
                        
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Número de operación</label>
                            <input 
                                type="text" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                                placeholder="Ingresa el número de operación"
                            >
                        </div>
                    </div>
                </div>
                
                <div class="mb-6 hidden" id="detalles-transferencia">
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h3 class="font-medium text-gray-800 mb-3">Transferencia bancaria</h3>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-1">Banco:</p>
                            <p class="font-medium">BCP - Banco de Crédito del Perú</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-1">Cuenta corriente:</p>
                            <p class="font-medium">193-1234567-0-00</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-1">CCI:</p>
                            <p class="font-medium">002-193-001234567000-90</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-1">Titular:</p>
                            <p class="font-medium">UniMarket S.A.C.</p>
                        </div>
                        
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Número de operación</label>
                            <input 
                                type="text" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                                placeholder="Ingresa el número de operación"
                            >
                        </div>
                    </div>
                </div>
                
                <!-- Términos y condiciones -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="terminos" 
                            class="h-4 w-4 text-sky-500 border-gray-300 rounded focus:ring-sky-500"
                            required
                        >
                        <span class="ml-2 text-sm text-gray-700">
                            Acepto los <a href="#" class="text-sky-600 hover:underline">Términos y Condiciones</a> y la <a href="#" class="text-sky-600 hover:underline">Política de Privacidad</a>
                        </span>
                    </label>
                </div>
                
                <!-- Botones de acción -->
                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a 
                        href="{{ route('anuncios.crear') }}" 
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
                    >
                        Volver
                    </a>
                    <button 
                        type="submit" 
                        class="bg-green-500 text-white py-2 px-6 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                    >
                        Realizar pago
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript para interactividad -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Selección de método de pago
        const metodoPagoInputs = document.querySelectorAll('input[name="metodo_pago"]');
        const metodoPagoLabels = [
            document.getElementById('metodo-tarjeta'),
            document.getElementById('metodo-yape'),
            document.getElementById('metodo-plin'),
            document.getElementById('metodo-transferencia')
        ];
        
        const checkIcons = [
            document.getElementById('check-tarjeta'),
            document.getElementById('check-yape'),
            document.getElementById('check-plin'),
            document.getElementById('check-transferencia')
        ];
        
        const detallesPago = [
            document.getElementById('detalles-tarjeta'),
            document.getElementById('detalles-yape'),
            document.getElementById('detalles-plin'),
            document.getElementById('detalles-transferencia')
        ];
        
        metodoPagoInputs.forEach((input, index) => {
            input.addEventListener('change', function() {
                // Quitar selección de todos
                metodoPagoLabels.forEach((label, i) =>
