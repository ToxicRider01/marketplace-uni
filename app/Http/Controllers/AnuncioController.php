<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Models\Universidad;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnuncioController extends Controller
{
    /**
     * Mostrar el formulario para crear un anuncio
     */
    public function crear()
    {
        $universidades = Universidad::all();
        $categorias = Categoria::all();
        
        return view('anuncios.crear', [
            'universidades' => $universidades,
            'categorias' => $categorias
        ]);
    }
    
    /**
     * Almacenar un nuevo anuncio
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:100',
            'descripcion' => 'nullable|max:255',
            'imagen' => 'required|image|max:2048',
            'url' => 'nullable|url',
            'posicion' => 'required|in:banner_principal,sidebar,entre_productos,footer',
            'tipo' => 'required|in:interno,externo,google_adsense',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'universidad_id' => 'nullable|exists:universidades,id',
            'categoria_id' => 'nullable|exists:categorias,id',
            'codigo_adsense' => 'nullable|required_if:tipo,google_adsense'
        ]);
        
        // Procesar la imagen
        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('anuncios', 'public');
        }
        
        // Calcular precio según posición y duración
        $fechaInicio = new \DateTime($request->fecha_inicio);
        $fechaFin = new \DateTime($request->fecha_fin);
        $diasDuracion = $fechaInicio->diff($fechaFin)->days;
        
        $precioPorDia = $this->calcularPrecioPorDia($request->posicion);
        $precioTotal = $precioPorDia * $diasDuracion;
        
        // Crear el anuncio
        $anuncio = Anuncio::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $imagenPath,
            'url' => $request->url,
            'posicion' => $request->posicion,
            'tipo' => $request->tipo,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'estado' => false, // Inicia inactivo hasta que se confirme el pago
            'precio' => $precioTotal,
            'user_id' => auth()->id(),
            'universidad_id' => $request->universidad_id,
            'categoria_id' => $request->categoria_id,
            'codigo_adsense' => $request->codigo_adsense
        ]);
        
        // Redirigir a la página de pago
        return redirect()->route('anuncios.pago', $anuncio->id)
                         ->with('success', 'Anuncio creado correctamente. Por favor, complete el pago para activarlo.');
    }
    
    /**
     * Mostrar página de pago del anuncio
     */
    public function pago(Anuncio $anuncio)
    {
        // Verificar que el anuncio pertenezca al usuario actual
        if ($anuncio->user_id != auth()->id()) {
            abort(403);
        }
        
        return view('anuncios.pago', [
            'anuncio' => $anuncio
        ]);
    }
    
    /**
     * Procesar el pago del anuncio
     */
    public function procesarPago(Request $request, Anuncio $anuncio)
    {
        // Verificar que el anuncio pertenezca al usuario actual
        if ($anuncio->user_id != auth()->id()) {
            abort(403);
        }
        
        $request->validate([
            'metodo_pago' => 'required|in:tarjeta,yape,plin,transferencia'
        ]);
        
        // Aquí iría la lógica de procesamiento de pago con una pasarela
        // Por ahora, simplemente activamos el anuncio
        
        $anuncio->update([
            'estado' => true
        ]);
        
        return redirect()->route('anuncios.mis-anuncios')
                         ->with('success', 'Pago procesado correctamente. Su anuncio está ahora activo.');
    }
    
    /**
     * Mostrar los anuncios del usuario actual
     */
    public function misAnuncios()
    {
        $anuncios = Anuncio::where('user_id', auth()->id())
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);
        
        return view('anuncios.mis-anuncios', [
            'anuncios' => $anuncios
        ]);
    }
    
    /**
     * Mostrar estadísticas de un anuncio
     */
    public function estadisticas(Anuncio $anuncio)
    {
        // Verificar que el anuncio pertenezca al usuario actual
        if ($anuncio->user_id != auth()->id()) {
            abort(403);
        }
        
        return view('anuncios.estadisticas', [
            'anuncio' => $anuncio
        ]);
    }
    
    /**
     * Calcular el precio por día según la posición
     */
    private function calcularPrecioPorDia($posicion)
    {
        switch ($posicion) {
            case 'banner_principal':
                return 50.00; // S/. 50 por día
            case 'sidebar':
                return 30.00; // S/. 30 por día
            case 'entre_productos':
                return 25.00; // S/. 25 por día
            case 'footer':
                return 15.00; // S/. 15 por día
            default:
                return 20.00; // Precio por defecto
        }
    }
}
