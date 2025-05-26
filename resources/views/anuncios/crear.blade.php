@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <!-- Encabezado -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Crear un anuncio</h1>
            <p class="text-gray-600 mt-1">Promociona tu negocio o servicio en UniMarket</p>
        </div>
        
        <!-- Formulario principal -->
        <form action="{{ route('anuncios.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md overflow-hidden">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                <!-- Sección de imagen - Columna izquierda en desktop -->
                <div class="md:col-span-1 p-6 border-b md:border-b-0 md:border-r border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold mb-4">Imagen del anuncio</h2>
                    
                    <div class="mb-4">
                        <div class="mb-2 flex justify-between items-center">
                            <label class="block text-sm font-medium text-gray-700">Sube una imagen atractiva</label>
                        </div>
                        
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center" id="drop-area">
                            <input type="file" accept="image/*" class="hidden" id="file-input" name="imagen">
                            <label for="file-input" class="cursor-pointer">
                                <div class="space-y-2">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                                    <p class="text-sm text-gray-500">Arrastra tu imagen aquí o haz clic para seleccionarla</p>
                                    <p class="text-xs text-gray-400">PNG, JPG, JPEG (máx. 2MB)</p>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Vista previa de imagen -->
                    <div class="mt-4 hidden" id="image-preview-container">
                        <img src="#" alt="Vista previa" class="w-full h-auto rounded-lg" id="image-preview">
                    </div>
                    
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">Consejos para anuncios efectivos:</p>
                        <ul class="text-xs text-gray-500 space-y-1 list-disc pl-4">
                            <li>Usa imágenes de alta calidad</li>
                            <li>Incluye un mensaje claro y conciso</li>
                            <li>Destaca los beneficios de tu producto o servicio</li>
                            <li>Incluye una llamada a la acción</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Detalles del anuncio - Columna derecha en desktop -->
                <div class="md:col-span-2 p-6">
                    <h2 class="text-lg font-semibold mb-4">Detalles del anuncio</h2>
                    
                    <!-- Título del anuncio -->
                    <div class="mb-4">
                        <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título del anuncio*</label>
                        <input 
                            type="text" 
                            id="titulo" 
                            name="titulo" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                            placeholder="Ej: Descuento especial para estudiantes"
                            required
                        >
                        <p class="mt-1 text-xs text-gray-500">Sé específico y conciso (máx. 100 caracteres)</p>
                    </div>
                    
                    <!-- Descripción -->
                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea 
                            id="descripcion" 
                            name="descripcion" 
                            rows="3" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                            placeholder="Describe brevemente tu anuncio"
                        ></textarea>
                        <p class="mt-1 text-xs text-gray-500">Máximo 255 caracteres</p>
                    </div>
                    
                    <!-- URL de destino -->
                    <div class="mb-4">
                        <label for="url" class="block text-sm font-medium text-gray-700 mb-1">URL de destino</label>
                        <input 
                            type="url" 
                            id="url" 
                            name="url" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                            placeholder="https://www.ejemplo.com"
                        >
                        <p class="mt-1 text-xs text-gray-500">Página web a la que se dirigirá el usuario al hacer clic</p>
                    </div>
                    
                    <!-- Tipo de anuncio -->
                    <div class="mb-4">
                        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de anuncio*</label>
                        <select 
                            id="tipo" 
                            name="tipo" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                            required
                        >
                            <option value="">Seleccionar tipo</option>
                            <option value="interno">Anuncio interno (imagen)</option>
                            <option value="externo">Anuncio externo (enlace)</option>
                            <option value="google_adsense">Google AdSense</option>
                        </select>
                    </div>
                    
                    <!-- Código AdSense (condicional) -->
                    <div class="mb-4 hidden" id="adsense-container">
                        <label for="codigo_adsense" class="block text-sm font-medium text-gray-700 mb-1">Código de Google AdSense</label>
                        <textarea 
                            id="codigo_adsense" 
                            name="codigo_adsense" 
                            rows="4" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 font-mono text-xs"
                            placeholder="Pega aquí el código de tu anuncio de Google AdSense"
                        ></textarea>
                    </div>
                    
                    <!-- Posición del anuncio -->
                    <div class="mb-4">
                        <label for="posicion" class="block text-sm font-medium text-gray-700 mb-1">Posición del anuncio*</label>
                        <select 
                            id="posicion" 
                            name="posicion" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                            required
                        >
                            <option value="">Seleccionar posición</option>
                            <option value="banner_principal">Banner principal (S/. 50.00 por día)</option>
                            <option value="sidebar">Barra lateral (S/. 30.00 por día)</option>
                            <option value="entre_productos">Entre productos (S/. 25.00 por día)</option>
                            <option value="footer">Pie de página (S/. 15.00 por día)</option>
                        </select>
                    </div>
                    
                    <!-- Fechas de inicio y fin -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-1">Fecha de inicio*</label>
                            <input 
                                type="date" 
                                id="fecha_inicio" 
                                name="fecha_inicio" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                                required
                                min="{{ date('Y-m-d') }}"
                            >
                        </div>
                        <div>
                            <label for="fecha_fin" class="block text-sm font-medium text-gray-700 mb-1">Fecha de fin*</label>
                            <input 
                                type="date" 
                                id="fecha_fin" 
                                name="fecha_fin" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                                required
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            >
                        </div>
                    </div>
                    
                    <!-- Universidad (opcional) -->
                    <div class="mb-4">
                        <label for="universidad_id" class="block text-sm font-medium text-gray-700 mb-1">Universidad (opcional)</label>
                        <select 
                            id="universidad_id" 
                            name="universidad_id" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="">Todas las universidades</option>
                            @foreach($universidades as $universidad)
                                <option value="{{ $universidad->id }}">{{ $universidad->nombre }}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Si seleccionas una universidad, tu anuncio solo se mostrará a usuarios de esa institución</p>
                    </div>
                    
                    <!-- Categoría (opcional) -->
                    <div class="mb-6">
                        <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-1">Categoría (opcional)</label>
                        <select 
                            id="categoria_id" 
                            name="categoria_id" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <option value="">Todas las categorías</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Si seleccionas una categoría, tu anuncio solo se mostrará en páginas de esa categoría</p>
                    </div>
                    
                    <!-- Resumen de costos -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <h3 class="font-medium text-gray-800 mb-2">Resumen de costos</h3>
                        <div class="flex justify-between text-sm mb-1">
                            <span>Costo por día:</span>
                            <span id="costo-diario">S/. 0.00</span>
                        </div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>Duración:</span>
                            <span id="duracion">0 días</span>
                        </div>
                        <div class="flex justify-between font-medium text-gray-800 pt-2 border-t border-gray-200 mt-2">
                            <span>Total:</span>
                            <span id="costo-total">S/. 0.00</span>
                        </div>
                    </div>
                    
                    <!-- Botones de acción -->
                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                        <a 
                            href="{{ route('home') }}" 
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
                        >
                            Cancelar
                        </a>
                        <button 
                            type="submit" 
                            class="bg-sky-500 text-white py-2 px-6 rounded-md hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
                        >
                            Continuar al pago
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript para interactividad -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejo de carga de imágenes
        const fileInput = document.getElementById('file-input');
        const dropArea = document.getElementById('drop-area');
        const previewContainer = document.getElementById('image-preview-container');
        const imagePreview = document.getElementById('image-preview');
        
        // Eventos para drag and drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            dropArea.classList.add('border-sky-500', 'bg-sky-50');
        }
        
        function unhighlight() {
            dropArea.classList.remove('border-sky-500', 'bg-sky-50');
        }
        
        // Manejar archivos soltados
        dropArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        }
        
        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });
        
        function handleFiles(files) {
            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
        
        // Mostrar/ocultar campo de código AdSense según el tipo seleccionado
        const tipoSelect = document.getElementById('tipo');
        const adsenseContainer = document.getElementById('adsense-container');
        
        tipoSelect.addEventListener('change', function() {
            if (this.value === 'google_adsense') {
                adsenseContainer.classList.remove('hidden');
            } else {
                adsenseContainer.classList.add('hidden');
            }
        });
        
        // Calcular costo según posición y duración
        const posicionSelect = document.getElementById('posicion');
        const fechaInicio = document.getElementById('fecha_inicio');
        const fechaFin = document.getElementById('fecha_fin');
        const costoDiario = document.getElementById('costo-diario');
        const duracionElement = document.getElementById('duracion');
        const costoTotal = document.getElementById('costo-total');
        
        function calcularCostos() {
            let precioPorDia = 0;
            
            switch (posicionSelect.value) {
                case 'banner_principal':
                    precioPorDia = 50.00;
                    break;
                case 'sidebar':
                    precioPorDia = 30.00;
                    break;
                case 'entre_productos':
                    precioPorDia = 25.00;
                    break;
                case 'footer':
                    precioPorDia = 15.00;
                    break;
                default:
                    precioPorDia = 0;
            }
            
            costoDiario.textContent = `S/. ${precioPorDia.toFixed(2)}`;
            
            // Calcular duración
            if (fechaInicio.value && fechaFin.value) {
                const inicio = new Date(fechaInicio.value);
                const fin = new Date(fechaFin.value);
                
                // Calcular diferencia en días
                const diffTime = Math.abs(fin - inicio);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                
                duracionElement.textContent = `${diffDays} días`;
                
                // Calcular costo total
                const total = precioPorDia * diffDays;
                costoTotal.textContent = `S/. ${total.toFixed(2)}`;
            }
        }
        
        posicionSelect.addEventListener('change', calcularCostos);
        fechaInicio.addEventListener('change', calcularCostos);
        fechaFin.addEventListener('change', calcularCostos);
    });
</script>
@endsection
