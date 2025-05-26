<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Método para la categoría de Libros
    public function libros(Request $request)
    {
        $productos = $this->getProductosLibros();
        
        // Aplicar filtros específicos de libros
        if ($request->has('carrera')) {
            $carrera = $request->input('carrera');
            $productos = array_filter($productos, function($producto) use ($carrera) {
                return $producto['carrera'] == $carrera;
            });
        }
        
        if ($request->has('tipo')) {
            $tipo = $request->input('tipo');
            $productos = array_filter($productos, function($producto) use ($tipo) {
                return $producto['tipo'] == $tipo;
            });
        }
        
        if ($request->has('estado')) {
            $estado = $request->input('estado');
            $productos = array_filter($productos, function($producto) use ($estado) {
                return $producto['estado'] == $estado;
            });
        }
        
        return view('categorias.libros', [
            'productos' => $productos,
            'filtros' => $request->all()
        ]);
    }
    
    // Método para la categoría de Tecnología
    public function tecnologia(Request $request)
    {
        $productos = $this->getProductosTecnologia();
        
        // Aplicar filtros específicos de tecnología
        if ($request->has('tipo')) {
            $tipo = $request->input('tipo');
            $productos = array_filter($productos, function($producto) use ($tipo) {
                return $producto['tipo'] == $tipo;
            });
        }
        
        if ($request->has('marca')) {
            $marca = $request->input('marca');
            $productos = array_filter($productos, function($producto) use ($marca) {
                return $producto['marca'] == $marca;
            });
        }
        
        if ($request->has('estado')) {
            $estado = $request->input('estado');
            $productos = array_filter($productos, function($producto) use ($estado) {
                return $producto['estado'] == $estado;
            });
        }
        
        return view('categorias.tecnologia', [
            'productos' => $productos,
            'filtros' => $request->all()
        ]);
    }
    
    // Método para la categoría de Ropa
    public function ropa(Request $request)
    {
        $productos = $this->getProductosRopa();
        
        // Aplicar filtros específicos de ropa
        if ($request->has('tipo')) {
            $tipo = $request->input('tipo');
            $productos = array_filter($productos, function($producto) use ($tipo) {
                return $producto['tipo'] == $tipo;
            });
        }
        
        if ($request->has('talla')) {
            $talla = $request->input('talla');
            $productos = array_filter($productos, function($producto) use ($talla) {
                return $producto['talla'] == $talla;
            });
        }
        
        if ($request->has('genero')) {
            $genero = $request->input('genero');
            $productos = array_filter($productos, function($producto) use ($genero) {
                return $producto['genero'] == $genero;
            });
        }
        
        return view('categorias.ropa', [
            'productos' => $productos,
            'filtros' => $request->all()
        ]);
    }
    
    // Método para la categoría de Servicios
    public function servicios(Request $request)
    {
        $productos = $this->getProductosServicios();
        
        // Aplicar filtros específicos de servicios
        if ($request->has('tipo')) {
            $tipo = $request->input('tipo');
            $productos = array_filter($productos, function($producto) use ($tipo) {
                return $producto['tipo'] == $tipo;
            });
        }
        
        if ($request->has('modalidad')) {
            $modalidad = $request->input('modalidad');
            $productos = array_filter($productos, function($producto) use ($modalidad) {
                return $producto['modalidad'] == $modalidad;
            });
        }
        
        return view('categorias.servicios', [
            'productos' => $productos,
            'filtros' => $request->all()
        ]);
    }
    
    // Método para la categoría de Comida
    public function comida(Request $request)
    {
        $productos = $this->getProductosComida();
        
        // Aplicar filtros específicos de comida
        if ($request->has('tipo')) {
            $tipo = $request->input('tipo');
            $productos = array_filter($productos, function($producto) use ($tipo) {
                return $producto['tipo'] == $tipo;
            });
        }
        
        if ($request->has('dieta')) {
            $dieta = $request->input('dieta');
            $productos = array_filter($productos, function($producto) use ($dieta) {
                return in_array($dieta, $producto['dietas']);
            });
        }
        
        return view('categorias.comida', [
            'productos' => $productos,
            'filtros' => $request->all()
        ]);
    }
    
    // Método para la categoría de Muebles
    public function muebles(Request $request)
    {
        $productos = $this->getProductosMuebles();
        
        // Aplicar filtros específicos de muebles
        if ($request->has('tipo')) {
            $tipo = $request->input('tipo');
            $productos = array_filter($productos, function($producto) use ($tipo) {
                return $producto['tipo'] == $tipo;
            });
        }
        
        if ($request->has('estado')) {
            $estado = $request->input('estado');
            $productos = array_filter($productos, function($producto) use ($estado) {
                return $producto['estado'] == $estado;
            });
        }
        
        return view('categorias.muebles', [
            'productos' => $productos,
            'filtros' => $request->all()
        ]);
    }
    
    // Método para la categoría de Deportes
    public function deportes(Request $request)
    {
        $productos = $this->getProductosDeportes();
        
        // Aplicar filtros específicos de deportes
        if ($request->has('tipo')) {
            $tipo = $request->input('tipo');
            $productos = array_filter($productos, function($producto) use ($tipo) {
                return $producto['tipo'] == $tipo;
            });
        }
        
        if ($request->has('estado')) {
            $estado = $request->input('estado');
            $productos = array_filter($productos, function($producto) use ($estado) {
                return $producto['estado'] == $estado;
            });
        }
        
        return view('categorias.deportes', [
            'productos' => $productos,
            'filtros' => $request->all()
        ]);
    }
    
    // Datos de ejemplo para cada categoría
    private function getProductosLibros()
    {
        return [
            [
                'id' => 1,
                'titulo' => 'Libro de Cálculo Diferencial',
                'precio' => 'S/. 45.00',
                'vendedor' => 'Carlos M.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Libro de cálculo en excelente estado, usado solo un semestre. Incluye todos los ejercicios resueltos.',
                'estado' => 'bueno',
                'autor' => 'James Stewart',
                'editorial' => 'Cengage Learning',
                'edicion' => '7ma Edición',
                'carrera' => 'ingenieria',
                'tipo' => 'texto',
                'isbn' => '978-607-481-881-9'
            ],
            [
                'id' => 7,
                'titulo' => 'Fundamentos de Economía',
                'precio' => 'S/. 38.00',
                'vendedor' => 'Laura T.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Libro de economía básica, perfecto para estudiantes de primer año. Incluye resúmenes por capítulo.',
                'estado' => 'bueno',
                'autor' => 'Paul Krugman',
                'editorial' => 'Reverté',
                'edicion' => '3ra Edición',
                'carrera' => 'economia',
                'tipo' => 'texto',
                'isbn' => '978-84-291-2693-0'
            ],
            [
                'id' => 8,
                'titulo' => 'Manual de Derecho Civil',
                'precio' => 'S/. 55.00',
                'vendedor' => 'Pedro G.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Manual completo de derecho civil peruano, última edición con jurisprudencia actualizada.',
                'estado' => 'usado',
                'autor' => 'Aníbal Torres Vásquez',
                'editorial' => 'Jurista Editores',
                'edicion' => '2022',
                'carrera' => 'derecho',
                'tipo' => 'texto',
                'isbn' => '978-9972-229-35-8'
            ],
            [
                'id' => 9,
                'titulo' => 'Atlas de Anatomía Humana',
                'precio' => 'S/. 120.00',
                'vendedor' => 'María L.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Atlas completo de anatomía humana con ilustraciones a color. Ideal para estudiantes de medicina.',
                'estado' => 'bueno',
                'autor' => 'Frank H. Netter',
                'editorial' => 'Elsevier',
                'edicion' => '7ma Edición',
                'carrera' => 'medicina',
                'tipo' => 'atlas',
                'isbn' => '978-84-9113-546-3'
            ],
            [
                'id' => 10,
                'titulo' => 'Química Orgánica',
                'precio' => 'S/. 65.00',
                'vendedor' => 'Jorge P.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Libro de química orgánica con ejercicios resueltos y material complementario.',
                'estado' => 'nuevo',
                'autor' => 'John McMurry',
                'editorial' => 'Cengage Learning',
                'edicion' => '9na Edición',
                'carrera' => 'quimica',
                'tipo' => 'texto',
                'isbn' => '978-607-526-868-2'
            ]
        ];
    }
    
    private function getProductosTecnologia()
    {
        return [
            [
                'id' => 2,
                'titulo' => 'Laptop HP usada (buen estado)',
                'precio' => 'S/. 1,200.00',
                'vendedor' => 'Ana P.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Laptop HP con 8GB RAM, 256GB SSD, procesador i5. Ideal para estudiantes de ingeniería o diseño.',
                'estado' => 'bueno',
                'tipo' => 'laptop',
                'marca' => 'HP',
                'modelo' => 'Pavilion 15',
                'especificaciones' => [
                    'Procesador' => 'Intel Core i5 10th Gen',
                    'RAM' => '8GB',
                    'Almacenamiento' => '256GB SSD',
                    'Pantalla' => '15.6 pulgadas Full HD'
                ]
            ],
            [
                'id' => 5,
                'titulo' => 'Audífonos Bluetooth',
                'precio' => 'S/. 89.00',
                'vendedor' => 'Roberto Q.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Audífonos inalámbricos con cancelación de ruido, ideal para estudiar en la biblioteca o cafetería.',
                'estado' => 'usado',
                'tipo' => 'audio',
                'marca' => 'Sony',
                'modelo' => 'WH-CH510',
                'especificaciones' => [
                    'Tipo' => 'On-ear',
                    'Batería' => '35 horas',
                    'Conectividad' => 'Bluetooth 5.0'
                ]
            ],
            [
                'id' => 11,
                'titulo' => 'Tablet Samsung Galaxy Tab A',
                'precio' => 'S/. 650.00',
                'vendedor' => 'Daniela R.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Tablet Samsung en perfecto estado, ideal para tomar apuntes y leer PDFs. Incluye funda protectora.',
                'estado' => 'bueno',
                'tipo' => 'tablet',
                'marca' => 'Samsung',
                'modelo' => 'Galaxy Tab A',
                'especificaciones' => [
                    'Pantalla' => '10.1 pulgadas',
                    'Almacenamiento' => '32GB',
                    'RAM' => '2GB',
                    'Batería' => '6150mAh'
                ]
            ],
            [
                'id' => 12,
                'titulo' => 'Monitor LG 24 pulgadas',
                'precio' => 'S/. 350.00',
                'vendedor' => 'Fernando T.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Monitor LG Full HD, perfecto para estudiar o hacer trabajos desde casa. Poco uso.',
                'estado' => 'bueno',
                'tipo' => 'monitor',
                'marca' => 'LG',
                'modelo' => '24MK430H',
                'especificaciones' => [
                    'Tamaño' => '24 pulgadas',
                    'Resolución' => '1920x1080 Full HD',
                    'Tiempo de respuesta' => '5ms',
                    'Conectividad' => 'HDMI, VGA'
                ]
            ],
            [
                'id' => 13,
                'titulo' => 'Calculadora Científica Casio',
                'precio' => 'S/. 75.00',
                'vendedor' => 'Luis M.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Calculadora científica Casio fx-991LA X, perfecta para cursos de ingeniería y ciencias.',
                'estado' => 'nuevo',
                'tipo' => 'calculadora',
                'marca' => 'Casio',
                'modelo' => 'fx-991LA X',
                'especificaciones' => [
                    'Funciones' => '552 funciones',
                    'Pantalla' => 'LCD de alta resolución',
                    'Alimentación' => 'Solar y batería'
                ]
            ]
        ];
    }
    
    // Modificar en el método getProductosRopa() para actualizar las referencias a universidades
    private function getProductosRopa()
    {
        return [
            [
                'id' => 3,
                'titulo' => 'Polera UNS talla M',
                'precio' => 'S/. 35.00',
                'vendedor' => 'Miguel S.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Polera oficial de la Universidad Nacional del Santa, talla M, algodón 100%.',
                'estado' => 'nuevo',
                'tipo' => 'polera',
                'talla' => 'M',
                'color' => 'Azul',
                'genero' => 'unisex',
                'material' => 'Algodón 100%'
            ],
            [
                'id' => 14,
                'titulo' => 'Casaca universitaria USP',
                'precio' => 'S/. 120.00',
                'vendedor' => 'Carolina V.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Casaca oficial de la Universidad San Pedro, color negro con logo bordado. Usada solo un ciclo.',
                'estado' => 'bueno',
                'tipo' => 'casaca',
                'talla' => 'L',
                'color' => 'Negro',
                'genero' => 'unisex',
                'material' => 'Poliéster'
            ],
            [
                'id' => 15,
                'titulo' => 'Mochila para laptop',
                'precio' => 'S/. 65.00',
                'vendedor' => 'Rodrigo A.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Mochila resistente al agua con compartimento para laptop de hasta 15". Varios bolsillos.',
                'estado' => 'bueno',
                'tipo' => 'mochila',
                'color' => 'Gris',
                'genero' => 'unisex',
                'material' => 'Nylon resistente al agua'
            ],
            [
                'id' => 16,
                'titulo' => 'Zapatillas Adidas talla 42',
                'precio' => 'S/. 150.00',
                'vendedor' => 'Pablo N.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Zapatillas Adidas modelo Campus, usadas pero en buen estado. Talla 42 (8.5 US).',
                'estado' => 'bueno',
                'tipo' => 'calzado',
                'talla' => '42',
                'color' => 'Negro',
                'genero' => 'masculino',
                'marca' => 'Adidas'
            ],
            [
                'id' => 17,
                'titulo' => 'Polo facultad de Medicina UCV',
                'precio' => 'S/. 25.00',
                'vendedor' => 'Valeria S.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Polo de la promoción 2022 de Medicina UCV. Talla S, algodón pima.',
                'estado' => 'nuevo',
                'tipo' => 'polo',
                'talla' => 'S',
                'color' => 'Blanco',
                'genero' => 'femenino',
                'material' => 'Algodón pima'
            ]
        ];
    }
    
    private function getProductosServicios()
    {
        return [
            [
                'id' => 4,
                'titulo' => 'Clases de Programación Java',
                'precio' => 'S/. 25.00/hora',
                'vendedor' => 'Diana L.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Clases particulares de programación en Java. Experiencia en enseñanza y desarrollo de software.',
                'estado' => 'nuevo',
                'tipo' => 'clases',
                'modalidad' => 'presencial_virtual',
                'horario' => 'Flexible',
                'duracion' => '1-2 horas por sesión',
                'nivel' => 'Principiante a avanzado'
            ],
            [
                'id' => 18,
                'titulo' => 'Asesoría en tesis de Psicología',
                'precio' => 'S/. 40.00/hora',
                'vendedor' => 'Manuel G.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Asesoría especializada para tesis de pregrado y posgrado en Psicología. Experiencia en investigación cualitativa y cuantitativa.',
                'estado' => 'nuevo',
                'tipo' => 'asesoria',
                'modalidad' => 'virtual',
                'horario' => 'Lunes a viernes de 4pm a 8pm',
                'duracion' => 'Según necesidad',
                'nivel' => 'Pregrado y posgrado'
            ],
            [
                'id' => 19,
                'titulo' => 'Diseño de presentaciones PowerPoint',
                'precio' => 'S/. 30.00/presentación',
                'vendedor' => 'Andrea C.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Diseño profesional de presentaciones para exposiciones, trabajos finales o sustentaciones. Entrega en 24-48 horas.',
                'estado' => 'nuevo',
                'tipo' => 'diseno',
                'modalidad' => 'virtual',
                'horario' => 'Entrega en 24-48 horas',
                'duracion' => 'Según complejidad',
                'nivel' => 'Todos los niveles'
            ],
            [
                'id' => 20,
                'titulo' => 'Clases de Inglés para exámenes internacionales',
                'precio' => 'S/. 35.00/hora',
                'vendedor' => 'Sebastián R.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Preparación especializada para exámenes TOEFL, IELTS, Cambridge. Profesor certificado con experiencia internacional.',
                'estado' => 'nuevo',
                'tipo' => 'clases',
                'modalidad' => 'presencial_virtual',
                'horario' => 'Flexible, incluyendo fines de semana',
                'duracion' => '1-2 horas por sesión',
                'nivel' => 'Intermedio a avanzado'
            ],
            [
                'id' => 21,
                'titulo' => 'Servicio de impresión y anillado',
                'precio' => 'S/. 0.10/página B&N, S/. 0.50/página color',
                'vendedor' => 'CopyExpress',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Servicio de impresión, fotocopiado y anillado cerca al campus principal. Precios especiales para estudiantes.',
                'estado' => 'nuevo',
                'tipo' => 'impresion',
                'modalidad' => 'presencial',
                'horario' => 'Lunes a sábado 8am-8pm',
                'ubicacion' => 'A 2 cuadras de la puerta principal UNMSM',
                'nivel' => 'Todos los niveles'
            ]
        ];
    }
    
    private function getProductosComida()
    {
        return [
            [
                'id' => 6,
                'titulo' => 'Almuerzos delivery campus',
                'precio' => 'S/. 12.00',
                'vendedor' => 'Menú Universitario',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Servicio de delivery de almuerzos balanceados dentro del campus universitario. Menú diferente cada día.',
                'estado' => 'nuevo',
                'tipo' => 'menu',
                'horario' => 'Lunes a viernes 12pm-3pm',
                'dietas' => ['regular', 'vegetariano'],
                'incluye' => 'Entrada, plato de fondo, postre y refresco',
                'metodo_pago' => ['efectivo', 'yape', 'plin']
            ],
            [
                'id' => 22,
                'titulo' => 'Snacks saludables',
                'precio' => 'S/. 5.00/paquete',
                'vendedor' => 'NutriSnack',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Paquetes de snacks saludables: frutos secos, granola, frutas deshidratadas. Ideales para llevar a clases.',
                'estado' => 'nuevo',
                'tipo' => 'snack',
                'dietas' => ['regular', 'vegetariano', 'vegano', 'sin_gluten'],
                'contenido' => '50g por paquete',
                'metodo_pago' => ['efectivo', 'yape']
            ],
            [
                'id' => 23,
                'titulo' => 'Café de especialidad',
                'precio' => 'S/. 8.00',
                'vendedor' => 'CaféEstudio',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Café de especialidad peruano, preparado al momento. Entrega en la biblioteca central y facultades cercanas.',
                'estado' => 'nuevo',
                'tipo' => 'bebida',
                'horario' => 'Lunes a viernes 7am-7pm',
                'dietas' => ['regular', 'vegetariano', 'vegano'],
                'opciones' => 'Americano, latte, cappuccino, mocaccino',
                'metodo_pago' => ['efectivo', 'yape', 'plin']
            ],
            [
                'id' => 24,
                'titulo' => 'Postres caseros',
                'precio' => 'S/. 6.00 - S/. 10.00',
                'vendedor' => 'Dulce Estudio',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Postres caseros: brownies, alfajores, cheesecake, tres leches. Pedidos con 24 horas de anticipación.',
                'estado' => 'nuevo',
                'tipo' => 'postre',
                'horario' => 'Entregas de lunes a viernes',
                'dietas' => ['regular', 'sin_gluten'],
                'metodo_pago' => ['efectivo', 'yape', 'transferencia']
            ],
            [
                'id' => 25,
                'titulo' => 'Almuerzos vegetarianos',
                'precio' => 'S/. 15.00',
                'vendedor' => 'Verde Menú',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Almuerzos vegetarianos balanceados y deliciosos. Opciones veganas disponibles. Delivery a todo el campus.',
                'estado' => 'nuevo',
                'tipo' => 'menu',
                'horario' => 'Lunes a viernes 12pm-3pm',
                'dietas' => ['vegetariano', 'vegano', 'sin_gluten'],
                'incluye' => 'Entrada, plato de fondo, postre y refresco natural',
                'metodo_pago' => ['efectivo', 'yape', 'plin', 'transferencia']
            ]
        ];
    }
    
    private function getProductosMuebles()
    {
        return [
            [
                'id' => 26,
                'titulo' => 'Escritorio para estudiante',
                'precio' => 'S/. 120.00',
                'vendedor' => 'Ricardo M.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Escritorio compacto ideal para habitación de estudiante. Con cajón y espacio para laptop.',
                'estado' => 'bueno',
                'tipo' => 'escritorio',
                'material' => 'Melamina',
                'dimensiones' => '80cm x 60cm x 75cm (largo x ancho x alto)',
                'color' => 'Blanco con detalles en madera'
            ],
            [
                'id' => 27,
                'titulo' => 'Silla ergonómica de estudio',
                'precio' => 'S/. 85.00',
                'vendedor' => 'Patricia L.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Silla ergonómica con soporte lumbar, ideal para largas horas de estudio. Usada solo un semestre.',
                'estado' => 'bueno',
                'tipo' => 'silla',
                'material' => 'Malla y plástico reforzado',
                'dimensiones' => 'Altura ajustable',
                'color' => 'Negro'
            ],
            [
                'id' => 28,
                'titulo' => 'Librero pequeño',
                'precio' => 'S/. 70.00',
                'vendedor' => 'Gonzalo P.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Librero de 3 niveles, perfecto para organizar libros y materiales de estudio. Fácil de armar.',
                'estado' => 'bueno',
                'tipo' => 'librero',
                'material' => 'Melamina',
                'dimensiones' => '60cm x 30cm x 90cm (largo x ancho x alto)',
                'color' => 'Marrón oscuro'
            ],
            [
                'id' => 29,
                'titulo' => 'Mesa plegable',
                'precio' => 'S/. 50.00',
                'vendedor' => 'Lucía T.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Mesa plegable multiuso, ideal para espacios pequeños. Puede usarse como escritorio auxiliar.',
                'estado' => 'bueno',
                'tipo' => 'mesa',
                'material' => 'Metal y plástico',
                'dimensiones' => '70cm x 50cm x 70cm (largo x ancho x alto)',
                'color' => 'Blanco'
            ],
            [
                'id' => 30,
                'titulo' => 'Organizador de escritorio',
                'precio' => 'S/. 25.00',
                'vendedor' => 'Mariana C.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Organizador de escritorio con múltiples compartimentos para útiles de estudio.',
                'estado' => 'nuevo',
                'tipo' => 'organizador',
                'material' => 'Madera',
                'dimensiones' => '30cm x 15cm x 20cm (largo x ancho x alto)',
                'color' => 'Natural'
            ]
        ];
    }
    
    private function getProductosDeportes()
    {
        return [
            [
                'id' => 31,
                'titulo' => 'Pelota de fútbol Adidas',
                'precio' => 'S/. 60.00',
                'vendedor' => 'Diego R.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Pelota de fútbol Adidas, tamaño oficial. Usada pocas veces, en excelente estado.',
                'estado' => 'bueno',
                'tipo' => 'futbol',
                'marca' => 'Adidas',
                'modelo' => 'Tango Rosario',
                'tamaño' => '5 (oficial)'
            ],
            [
                'id' => 32,
                'titulo' => 'Raqueta de tenis Wilson',
                'precio' => 'S/. 120.00',
                'vendedor' => 'Alejandra M.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Raqueta Wilson en buen estado. Incluye funda protectora. Ideal para principiantes e intermedios.',
                'estado' => 'bueno',
                'tipo' => 'tenis',
                'marca' => 'Wilson',
                'modelo' => 'Federer Team',
                'peso' => '280g'
            ],
            [
                'id' => 33,
                'titulo' => 'Mancuernas 5kg (par)',
                'precio' => 'S/. 70.00',
                'vendedor' => 'Roberto A.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Par de mancuernas de 5kg cada una. Recubiertas de neopreno para mejor agarre.',
                'estado' => 'bueno',
                'tipo' => 'fitness',
                'marca' => 'Sportfitness',
                'peso' => '5kg cada una',
                'material' => 'Hierro con recubrimiento de neopreno'
            ],
            [
                'id' => 34,
                'titulo' => 'Bicicleta montañera',
                'precio' => 'S/. 450.00',
                'vendedor' => 'Javier L.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Bicicleta montañera aro 26, 21 velocidades. Usada pero en buen estado. Ideal para movilizarse al campus.',
                'estado' => 'bueno',
                'tipo' => 'ciclismo',
                'marca' => 'Oxford',
                'aro' => '26',
                'velocidades' => '21',
                'frenos' => 'Disco mecánico'
            ],
            [
                'id' => 35,
                'titulo' => 'Mat de yoga',
                'precio' => 'S/. 35.00',
                'vendedor' => 'Camila S.',
                'imagen' => 'placeholder.jpg',
                'descripcion' => 'Mat de yoga antideslizante, 6mm de grosor. Incluye correa para transportar.',
                'estado' => 'nuevo',
                'tipo' => 'yoga',
                'marca' => 'Yoga Mat',
                'dimensiones' => '173cm x 61cm x 6mm',
                'material' => 'PVC ecológico',
                'color' => 'Morado'
            ]
        ];
    }
}
