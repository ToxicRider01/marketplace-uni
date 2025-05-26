<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;

class AnuncioApiController extends Controller
{
    /**
     * Registrar una impresión de anuncio
     */
    public function registrarImpresion(Request $request)
    {
        $request->validate([
            'anuncio_id' => 'required|exists:anuncios,id'
        ]);
        
        $anuncio = Anuncio::find($request->anuncio_id);
        $anuncio->registrarImpresion();
        
        return response()->json(['success' => true]);
    }
    
    /**
     * Registrar un clic en un anuncio
     */
    public function registrarClic(Request $request)
    {
        $request->validate([
            'anuncio_id' => 'required|exists:anuncios,id'
        ]);
        
        $anuncio = Anuncio::find($request->anuncio_id);
        $anuncio->registrarClic();
        
        return response()->json(['success' => true]);
    }
    
    /**
     * Obtener anuncios para una posición específica
     */
    public function obtenerAnuncios(Request $request)
    {
        $request->validate([
            'posicion' => 'required|in:banner_principal,sidebar,entre_productos,footer',
            'categoria_id' => 'nullable|exists:categorias,id',
            'universidad_id' => 'nullable|exists:universidades,id',
            'limite' => 'nullable|integer|min:1|max:10'
        ]);
        
        $limite = $request->limite ?? 1;
        
        $query = Anuncio::activos()->porPosicion($request->posicion);
        
        if ($request->has('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }
        
        if ($request->has('universidad_id')) {
            $query->where('universidad_id', $request->universidad_id);
        }
        
        $anuncios = $query->inRandomOrder()->limit($limite)->get();
        
        // Registrar impresiones
        foreach ($anuncios as $anuncio) {
            $anuncio->registrarImpresion();
        }
        
        return response()->json($anuncios);
    }
}
