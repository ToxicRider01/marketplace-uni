<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function index()
    {
        // Datos de ejemplo para productos
        $productos = $this->getProductos();
        
        return view('marketplace.index', [
            'productos' => $productos,
            'categoriaActual' => 'todos'
        ]);
    }
    
    public function porCategoria($categoria)
    {
        // Datos de ejemplo para productos
        $todosProductos = $this->getProductos();
        
        // Filtrar productos por categoría
        $productos = array_filter($todosProductos, function($producto) use ($categoria) {
            return strtolower($producto['categoria']) === strtolower($categoria);
        });
        
        return view('marketplace.index', [
            'productos' => $productos,
            'categoriaActual' => $categoria
        ]);
    }
    
    public function showPublicar()
    {
        return view('marketplace.publicar');
    }
    
    // Método para procesar la publicación de un producto
    public function publicarProducto(Request $request)
    {
        // En un entorno real, aquí validaríamos y guardaríamos los datos
        // Por ahora, solo simularemos la validación
        
        $request->validate([
            'titulo' => 'required|max:100',
            'categoria' => 'required',
            'precio' => 'required|numeric|min:0',
            'estado' => 'required|in:nuevo,bueno,usado',
            'descripcion' => 'required|max:500',
            'ubicacion' => 'required',
            'imagenes.*' => 'image|max:5120', // 5MB máximo por imagen
        ]);
        
        // Procesamiento de imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                // Aquí guardaríamos las imágenes
                // $path = $imagen->store('productos', 'public');
            }
        }
        
        // Procesamiento de etiquetas
        $etiquetas = [];
        if ($request->has('etiquetas') && !empty($request->etiquetas)) {
            $etiquetas = array_map('trim', explode(',', $request->etiquetas));
        }
        
        // Aquí guardaríamos el producto en la base de datos
        
        // Redireccionar con mensaje de éxito
        return redirect()->route('home')->with('success', '¡Tu producto ha sido publicado exitosamente!');
    }
    
    public function buscar(Request $request)
    {
        $query = $request->input('query');
        $categoria = $request->input('categoria', 'todos');
        $precioMin = $request->input('precio_min');
        $precioMax = $request->input('precio_max');
        $ordenar = $request->input('ordenar', 'recientes');
        
        // Obtener todos los productos
        $todosProductos = $this->getProductos();
        
        // Filtrar por término de búsqueda
        if ($query) {
            $todosProductos = array_filter($todosProductos, function($producto) use ($query) {
                return stripos($producto['titulo'], $query) !== false || 
                       stripos($producto['descripcion'] ?? '', $query) !== false;
            });
        }
        
        // Filtrar por categoría
        if ($categoria && $categoria != 'todos') {
            $todosProductos = array_filter($todosProductos, function($producto) use ($categoria) {
                return strtolower($producto['categoria']) === strtolower($categoria);
            });
        }
        
        // Filtrar por precio mínimo
        if ($precioMin !== null && $precioMin !== '') {
            $todosProductos = array_filter($todosProductos, function($producto) use ($precioMin) {
                // Extraer solo los números del precio (eliminar "S/. " y cualquier coma)
                $precio = (float) preg_replace('/[^0-9.]/', '', $producto['precio']);
                return $precio >= (float) $precioMin;
            });
        }
        
        // Filtrar por precio máximo
        if ($precioMax !== null && $precioMax !== '') {
            $todosProductos = array_filter($todosProductos, function($producto) use ($precioMax) {
                // Extraer solo los números del precio (eliminar "S/. " y cualquier coma)
                $precio = (float) preg_replace('/[^0-9.]/', '', $producto['precio']);
                return $precio <= (float) $precioMax;
            });
        }
        
        // Ordenar resultados
        if ($ordenar == 'precio_asc') {
            usort($todosProductos, function($a, $b) {
                $precioA = (float) preg_replace('/[^0-9.]/', '', $a['precio']);
                $precioB = (float) preg_replace('/[^0-9.]/', '', $b['precio']);
                return $precioA - $precioB;
            });
        } elseif ($ordenar == 'precio_desc') {
            usort($todosProductos, function($a, $b) {
                $precioA = (float) preg_replace('/[^0-9.]/', '', $a['precio']);
                $precioB = (float) preg_replace('/[^0-9.]/', '', $b['precio']);
                return $precioB - $precioA;
            });
        }
        
        return view('marketplace.busqueda', [
            'productos' => $todosProductos,
            'query' => $query,
            'categoria' => $categoria,
            'precioMin' => $precioMin,
            'precioMax' => $precioMax,
            'ordenar' => $ordenar
        ]);
    }

    // Método para mostrar el detalle de un producto
    public function detalleProducto($id)
    {
        // Obtener todos los productos
        $todosProductos = $this->getProductos();
        
        // Buscar el producto por ID
        $producto = null;
        foreach ($todosProductos as $p) {
            if ($p['id'] == $id) {
                $producto = $p;
                break;
            }
        }
        
        // Si no se encuentra el producto, redirigir a la página principal
        if (!$producto) {
            return redirect()->route('home')->with('error', 'Producto no encontrado');
        }
        
        // Obtener productos relacionados (misma categoría)
        $productosRelacionados = array_filter($todosProductos, function($p) use ($producto, $id) {
            return $p['categoria'] === $producto['categoria'] && $p['id'] != $id;
        });
        
        // Limitar a 3 productos relacionados
        $productosRelacionados = array_slice($productosRelacionados, 0, 3);
        
        return view('marketplace.detalle-producto', [
            'producto' => $producto,
            'productosRelacionados' => $productosRelacionados
        ]);
    }

    private function getProductos()
    {
        // Datos de ejemplo para la demostración
        return [
            [
                'id' => 1,
                'titulo' => 'Libro de Cálculo Diferencial',
                'precio' => 'S/. 45.00',
                'vendedor' => 'Carlos M.',
                'vendedor_id' => 101,
                'categoria' => 'libros',
                'imagen' => 'placeholder.jpg',
                'imagenes' => ['placeholder.jpg', 'placeholder.jpg'],
                'descripcion' => 'Libro de cálculo en excelente estado, usado solo un semestre. Incluye todos los ejercicios resueltos.',
                'estado' => 'bueno',
                'ubicacion' => 'Campus UNS',
                'fecha_publicacion' => '2023-05-10',
                'contacto' => 'carlos.m@example.com',
                'telefono' => '987654321'
            ],
            [
                'id' => 2,
                'titulo' => 'Laptop HP usada (buen estado)',
                'precio' => 'S/. 1,200.00',
                'vendedor' => 'Ana P.',
                'vendedor_id' => 102,
                'categoria' => 'tecnologia',
                'imagen' => 'placeholder.jpg',
                'imagenes' => ['placeholder.jpg', 'placeholder.jpg', 'placeholder.jpg'],
                'descripcion' => 'Laptop HP con 8GB RAM, 256GB SSD, procesador i5. Ideal para estudiantes de ingeniería o diseño.',
                'estado' => 'bueno',
                'ubicacion' => 'Campus USP',
                'fecha_publicacion' => '2023-05-12',
                'contacto' => 'ana.p@example.com',
                'telefono' => '987654322'
            ],
            [
                'id' => 3,
                'titulo' => 'Polera UNS talla M',
                'precio' => 'S/. 35.00',
                'vendedor' => 'Miguel S.',
                'vendedor_id' => 103,
                'categoria' => 'ropa',
                'imagen' => 'placeholder.jpg',
                'imagenes' => ['placeholder.jpg'],
                'descripcion' => 'Polera oficial de la Universidad Nacional del Santa, talla M, algodón 100%.',
                'estado' => 'nuevo',
                'ubicacion' => 'Campus UNS',
                'fecha_publicacion' => '2023-05-15',
                'contacto' => 'miguel.s@example.com',
                'telefono' => '987654323'
            ],
            [
                'id' => 4,
                'titulo' => 'Clases de Programación Java',
                'precio' => 'S/. 25.00/hora',
                'vendedor' => 'Diana L.',
                'vendedor_id' => 104,
                'categoria' => 'servicios',
                'imagen' => 'placeholder.jpg',
                'imagenes' => ['placeholder.jpg'],
                'descripcion' => 'Clases particulares de programación en Java. Experiencia en enseñanza y desarrollo de software.',
                'estado' => 'nuevo',
                'ubicacion' => 'Campus UNS o virtual',
                'fecha_publicacion' => '2023-05-16',
                'contacto' => 'diana.l@example.com',
                'telefono' => '987654324'
            ],
            [
                'id' => 5,
                'titulo' => 'Audífonos Bluetooth',
                'precio' => 'S/. 89.00',
                'vendedor' => 'Roberto Q.',
                'vendedor_id' => 105,
                'categoria' => 'tecnologia',
                'imagen' => 'placeholder.jpg',
                'imagenes' => ['placeholder.jpg', 'placeholder.jpg'],
                'descripcion' => 'Audífonos inalámbricos con cancelación de ruido, ideal para estudiar en la biblioteca o cafetería.',
                'estado' => 'usado',
                'ubicacion' => 'Campus USP',
                'fecha_publicacion' => '2023-05-18',
                'contacto' => 'roberto.q@example.com',
                'telefono' => '987654325'
            ],
            [
                'id' => 6,
                'titulo' => 'Almuerzos delivery campus',
                'precio' => 'S/. 12.00',
                'vendedor' => 'Menú Universitario',
                'vendedor_id' => 106,
                'categoria' => 'comida',
                'imagen' => 'placeholder.jpg',
                'imagenes' => ['placeholder.jpg'],
                'descripcion' => 'Servicio de delivery de almuerzos balanceados dentro del campus universitario. Menú diferente cada día.',
                'estado' => 'nuevo',
                'ubicacion' => 'Campus UNS y USP',
                'fecha_publicacion' => '2023-05-19',
                'contacto' => 'menu.universitario@example.com',
                'telefono' => '987654326'
            ],
            [
                'id' => 7,
                'titulo' => 'Fundamentos de Economía',
                'precio' => 'S/. 38.00',
                'vendedor' => 'Laura T.',
                'vendedor_id' => 107,
                'categoria' => 'libros',
                'imagen' => 'placeholder.jpg',
                'imagenes' => ['placeholder.jpg', 'placeholder.jpg'],
                'descripcion' => 'Libro de economía básica, perfecto para estudiantes de primer año. Incluye resúmenes por capítulo.',
                'estado' => 'bueno',
                'ubicacion' => 'Campus UNS',
                'fecha_publicacion' => '2023-05-20',
                'contacto' => 'laura.t@example.com',
                'telefono' => '987654327'
            ],
            [
                'id' => 8,
                'titulo' => 'Manual de Derecho Civil',
                'precio' => 'S/. 55.00',
                'vendedor' => 'Pedro G.',
                'vendedor_id' => 108,
                'categoria' => 'libros',
                'imagen' => 'placeholder.jpg',
                'imagenes' => ['placeholder.jpg'],
                'descripcion' => 'Manual completo de derecho civil peruano, última edición con jurisprudencia actualizada.',
                'estado' => 'usado',
                'ubicacion' => 'Campus USP',
                'fecha_publicacion' => '2023-05-21',
                'contacto' => 'pedro.g@example.com',
                'telefono' => '987654328'
            ]
        ];
    }
}
