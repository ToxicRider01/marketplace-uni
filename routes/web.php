<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\AnuncioApiController;
use App\Http\Controllers\Admin\AnuncioAdminController;
use App\Http\Controllers\ChatController;

Route::get('/', [MarketplaceController::class, 'index'])->name('home');
Route::get('/categoria/{categoria}', [MarketplaceController::class, 'porCategoria'])->name('categoria');

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/registro', [AuthController::class, 'showRegistro'])->name('registro');
Route::post('/registro', [AuthController::class, 'registrar'])->name('registro.store');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas para publicar productos
Route::get('/publicar', [MarketplaceController::class, 'showPublicar'])->name('publicar');
Route::post('/publicar', [MarketplaceController::class, 'publicarProducto'])->name('publicar.store');

// Ruta para búsqueda
Route::get('/buscar', [MarketplaceController::class, 'buscar'])->name('buscar');

// Ruta para detalle de producto (asegúrate de que esté antes de otras rutas más específicas)
Route::get('/producto/{id}', [MarketplaceController::class, 'detalleProducto'])->name('producto.detalle');

// Rutas específicas para cada categoría
Route::get('/libros', [CategoriaController::class, 'libros'])->name('categoria.libros');
Route::get('/tecnologia', [CategoriaController::class, 'tecnologia'])->name('categoria.tecnologia');
Route::get('/ropa', [CategoriaController::class, 'ropa'])->name('categoria.ropa');
Route::get('/servicios', [CategoriaController::class, 'servicios'])->name('categoria.servicios');
Route::get('/comida', [CategoriaController::class, 'comida'])->name('categoria.comida');
Route::get('/muebles', [CategoriaController::class, 'muebles'])->name('categoria.muebles');
Route::get('/deportes', [CategoriaController::class, 'deportes'])->name('categoria.deportes');

// Rutas para anuncios (requieren autenticación)
Route::middleware(['auth'])->group(function () {
    Route::get('/anuncios/crear', [AnuncioController::class, 'crear'])->name('anuncios.crear');
    Route::post('/anuncios', [AnuncioController::class, 'store'])->name('anuncios.store');
    Route::get('/anuncios/pago/{anuncio}', [AnuncioController::class, 'pago'])->name('anuncios.pago');
    Route::post('/anuncios/pago/{anuncio}', [AnuncioController::class, 'procesarPago'])->name('anuncios.procesar-pago');
    Route::get('/mis-anuncios', [AnuncioController::class, 'misAnuncios'])->name('anuncios.mis-anuncios');
    Route::get('/anuncios/{anuncio}/estadisticas', [AnuncioController::class, 'estadisticas'])->name('anuncios.estadisticas');
    
    // Rutas para el chat
    Route::get('/chat/{vendedor_id}/{producto_id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/enviar', [ChatController::class, 'enviarMensaje'])->name('chat.enviar');
    Route::get('/mis-chats', [ChatController::class, 'misChats'])->name('chat.mis-chats');
});

// API para anuncios
Route::post('/api/anuncios/impresion', [AnuncioApiController::class, 'registrarImpresion'])->name('api.anuncios.impresion');
Route::post('/api/anuncios/clic', [AnuncioApiController::class, 'registrarClic'])->name('api.anuncios.clic');
Route::get('/api/anuncios', [AnuncioApiController::class, 'obtenerAnuncios'])->name('api.anuncios.obtener');

// Rutas de administración (requieren autenticación y rol de admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/anuncios', [AnuncioAdminController::class, 'index'])->name('admin.anuncios.index');
    Route::get('/anuncios/crear', [AnuncioAdminController::class, 'create'])->name('admin.anuncios.create');
    Route::post('/anuncios', [AnuncioAdminController::class, 'store'])->name('admin.anuncios.store');
    Route::get('/anuncios/{anuncio}/edit', [AnuncioAdminController::class, 'edit'])->name('admin.anuncios.edit');
    Route::put('/anuncios/{anuncio}', [AnuncioAdminController::class, 'update'])->name('admin.anuncios.update');
    Route::delete('/anuncios/{anuncio}', [AnuncioAdminController::class, 'destroy'])->name('admin.anuncios.destroy');
    Route::get('/anuncios/estadisticas', [AnuncioAdminController::class, 'estadisticas'])->name('admin.anuncios.estadisticas');
});
