@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <!-- Encabezado -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Publicar un producto</h1>
            <p class="text-gray-600 mt-1">Completa el formulario para publicar tu producto en UniMarket</p>
        </div>
        
        <!-- Formulario principal -->
        <form action="#" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md overflow-hidden">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                <!-- Sección de fotos - Columna izquierda en desktop -->
                <div class="md:col-span-1 p-6 border-b md:border-b-0 md:border-r border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold mb-4">Fotos del producto</h2>
                    
                    <div class="mb-4">
                        <div class="mb-2 flex justify-between items-center">
                            <label class="block text-sm font-medium text-gray-700">Sube hasta 5 fotos</label>
                            <span class="text-xs text-gray-500" id="photo-count">0/5</span>
                        </div>
                        
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center" id="drop-area">
                            <input type="file" multiple accept="image/*" class="hidden" id="file-input" name="imagenes[]">
                            <label for="file-input" class="cursor-pointer">
                                <div class="space-y-2">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                                    <p class="text-sm text-gray-500">Arrastra tus fotos aquí o haz clic para seleccionarlas</p>
                                    <p class="text-xs text-gray-400">PNG, JPG, JPEG (máx. 5MB por imagen)</p>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Vista previa de imágenes -->
                    <div class="grid grid-cols-3 gap-2 mt-4" id="image-preview-container">
                        <!-- Las vistas previas se insertarán aquí con JavaScript -->
                    </div>
                    
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">Consejos para buenas fotos:</p>
                        <ul class="text-xs text-gray-500 space-y-1 list-disc pl-4">
                            <li>Usa buena iluminación natural</li>
                            <li>Muestra el producto desde varios ángulos</li>
                            <li>Incluye fotos de detalles importantes</li>
                            <li>Evita fondos desordenados</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Detalles del producto - Columna derecha en desktop -->
                <div class="md:col-span-2 p-6">
                    <h2 class="text-lg font-semibold mb-4">Detalles del producto</h2>
                    
                    <!-- Título del producto -->
                    <div class="mb-4">
                        <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título del producto*</label>
                        <input 
                            type="text" 
                            id="titulo" 
                            name="titulo" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                            placeholder="Ej: Libro de Cálculo Diferencial en buen estado"
                            required
                        >
                        <p class="mt-1 text-xs text-gray-500">Sé específico y conciso (máx. 100 caracteres)</p>
                    </div>
                    
                    <!-- Categoría -->
                    <div class="mb-4">
                        <label for="categoria" class="block text-sm font-medium text-gray-700 mb-1">Categoría*</label>
                        <select 
                            id="categoria" 
                            name="categoria" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                            required
                        >
                            <option value="">Seleccionar categoría</option>
                            <option value="libros">Libros y material académico</option>
                            <option value="tecnologia">Tecnología y electrónicos</option>
                            <option value="ropa">Ropa y accesorios</option>
                            <option value="servicios">Servicios académicos</option>
                            <option value="comida">Comida y bebidas</option>
                            <option value="muebles">Muebles y decoración</option>
                            <option value="deportes">Deportes y fitness</option>
                            <option value="otros">Otros</option>
                        </select>
                    </div>
                    
                    <!-- Precio y negociación -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="precio" class="block text-sm font-medium text-gray-700 mb-1">Precio (S/.)*</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">S/.</span>
                                <input 
                                    type="number" 
                                    id="precio" 
                                    name="precio" 
                                    class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                                    placeholder="0.00"
                                    min="0"
                                    step="0.01"
                                    required
                                >
                            </div>
                        </div>
                        <div>
                            <label for="negociable" class="block text-sm font-medium text-gray-700 mb-1">¿Es negociable?</label>
                            <select 
                                id="negociable" 
                                name="negociable" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                            >
                                <option value="1">Sí, el precio es negociable</option>
                                <option value="0">No, precio fijo</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Estado del producto -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Estado del producto*</label>
                        <div class="grid grid-cols-3 gap-3">
                            <label class="flex items-center justify-center border border-gray-300 rounded-md p-3 cursor-pointer hover:bg-gray-50 transition-colors" id="estado-nuevo-label">
                                <input type="radio" name="estado" value="nuevo" class="hidden" required>
                                <div class="text-center">
                                    <i class="fas fa-tag text-xl mb-1 text-gray-400"></i>
                                    <p class="text-sm font-medium">Nuevo</p>
                                    <p class="text-xs text-gray-500">Sin usar</p>
                                </div>
                            </label>
                            <label class="flex items-center justify-center border border-gray-300 rounded-md p-3 cursor-pointer hover:bg-gray-50 transition-colors" id="estado-bueno-label">
                                <input type="radio" name="estado" value="bueno" class="hidden">
                                <div class="text-center">
                                    <i class="fas fa-thumbs-up text-xl mb-1 text-gray-400"></i>
                                    <p class="text-sm font-medium">Buen estado</p>
                                    <p class="text-xs text-gray-500">Usado, funcional</p>
                                </div>
                            </label>
                            <label class="flex items-center justify-center border border-gray-300 rounded-md p-3 cursor-pointer hover:bg-gray-50 transition-colors" id="estado-usado-label">
                                <input type="radio" name="estado" value="usado" class="hidden">
                                <div class="text-center">
                                    <i class="fas fa-exclamation-circle text-xl mb-1 text-gray-400"></i>
                                    <p class="text-sm font-medium">Muy usado</p>
                                    <p class="text-xs text-gray-500">Con desgaste</p>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Descripción -->
                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción*</label>
                        <textarea 
                            id="descripcion" 
                            name="descripcion" 
                            rows="4" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                            placeholder="Describe tu producto, incluye detalles como marca, modelo, tiempo de uso, razón de venta, etc."
                            required
                        ></textarea>
                        <p class="mt-1 text-xs text-gray-500"><span id="char-count">0</span>/500 caracteres</p>
                    </div>
                    
                    <!-- Ubicación -->
                    <div class="mb-4">
                        <label for="ubicacion" class="block text-sm font-medium text-gray-700 mb-1">Ubicación / Campus*</label>
                        <select 
                            id="ubicacion" 
                            name="ubicacion" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                            required
                        >
                            <option value="">Seleccionar ubicación</option>
                            <option value="uns">Universidad Nacional del Santa (UNS)</option>
                            <option value="usp">Universidad San Pedro (USP)</option>
                            <option value="ucv">Universidad César Vallejo (UCV) - Chimbote</option>
                            <option value="uladech">Universidad Católica Los Ángeles de Chimbote (ULADECH)</option>
                            <option value="uap">Universidad Alas Peruanas (UAP) - Chimbote</option>
                            <option value="otro">Otro lugar en Nuevo Chimbote</option>
                        </select>
                    </div>
                    
                    <!-- Método de entrega -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Método de entrega</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="entrega_personal" value="1" class="h-4 w-4 text-sky-500 border-gray-300 rounded focus:ring-sky-500">
                                <span class="ml-2 text-sm text-gray-700">Entrega en persona</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="entrega_delivery" value="1" class="h-4 w-4 text-sky-500 border-gray-300 rounded focus:ring-sky-500">
                                <span class="ml-2 text-sm text-gray-700">Delivery (costo adicional)</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Etiquetas -->
                    <div class="mb-6">
                        <label for="etiquetas" class="block text-sm font-medium text-gray-700 mb-1">Etiquetas (opcional)</label>
                        <input 
                            type="text" 
                            id="etiquetas" 
                            name="etiquetas" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                            placeholder="Ej: ingeniería, ciclo 2023-2, matemáticas (separadas por comas)"
                        >
                        <p class="mt-1 text-xs text-gray-500">Añade palabras clave para que tu producto sea más fácil de encontrar</p>
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
                            class="bg-green-500 text-white py-2 px-6 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                        >
                            Publicar producto
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
        const photoCount = document.getElementById('photo-count');
        const maxFiles = 5;
        let uploadedFiles = [];
        
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
            if (uploadedFiles.length + files.length > maxFiles) {
                alert(`Solo puedes subir un máximo de ${maxFiles} imágenes.`);
                return;
            }
            
            [...files].forEach(file => {
                if (file.type.startsWith('image/')) {
                    uploadedFiles.push(file);
                    previewFile(file);
                }
            });
            
            updatePhotoCount();
        }
        
        function previewFile(file) {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onloadend = function() {
                const preview = document.createElement('div');
                preview.className = 'relative';
                preview.innerHTML = `
                    <img src="${reader.result}" class="w-full h-24 object-cover rounded-md" />
                    <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                previewContainer.appendChild(preview);
                
                // Agregar evento para eliminar la imagen
                const deleteBtn = preview.querySelector('button');
                deleteBtn.addEventListener('click', function() {
                    const index = Array.from(previewContainer.children).indexOf(preview);
                    uploadedFiles.splice(index, 1);
                    preview.remove();
                    updatePhotoCount();
                });
            }
        }
        
        function updatePhotoCount() {
            photoCount.textContent = `${uploadedFiles.length}/${maxFiles}`;
        }
        
        // Contador de caracteres para la descripción
        const descripcion = document.getElementById('descripcion');
        const charCount = document.getElementById('char-count');
        
        descripcion.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count;
            
            if (count > 500) {
                charCount.classList.add('text-red-500');
                charCount.classList.add('font-bold');
            } else {
                charCount.classList.remove('text-red-500');
                charCount.classList.remove('font-bold');
            }
        });
        
        // Selección de estado del producto
        const estadoLabels = [
            document.getElementById('estado-nuevo-label'),
            document.getElementById('estado-bueno-label'),
            document.getElementById('estado-usado-label')
        ];
        
        estadoLabels.forEach(label => {
            label.addEventListener('click', function() {
                // Quitar selección de todos
                estadoLabels.forEach(l => {
                    l.classList.remove('border-sky-500', 'bg-sky-50');
                    const icon = l.querySelector('i');
                    icon.classList.remove('text-sky-500');
                    icon.classList.add('text-gray-400');
                });
                
                // Aplicar selección al actual
                this.classList.add('border-sky-500', 'bg-sky-50');
                const icon = this.querySelector('i');
                icon.classList.remove('text-gray-400');
                icon.classList.add('text-sky-500');
            });
        });
    });
</script>
@endsection
