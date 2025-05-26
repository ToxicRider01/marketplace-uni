<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anuncio;
use Illuminate\Http\Request;

class AnuncioAdminController extends Controller
{
    // Mostrar lista de anuncios con paginación
    public function index()
    {
        $anuncios = Anuncio::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.anuncios.index', compact('anuncios'));
    }

    // Mostrar formulario para crear un nuevo anuncio
    public function create()
    {
        return view('admin.anuncios.create');
    }

    // Guardar un nuevo anuncio
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $anuncio = new Anuncio();
        $anuncio->titulo = $request->titulo;
        $anuncio->descripcion = $request->descripcion;

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('anuncios', 'public');
            $anuncio->imagen = $path;
        }

        $anuncio->save();

        return redirect()->route('admin.anuncios.index')->with('success', 'Anuncio creado correctamente.');
    }

    // Mostrar formulario para editar un anuncio
    public function edit($id)
    {
        $anuncio = Anuncio::findOrFail($id);
        return view('admin.anuncios.edit', compact('anuncio'));
    }

    // Actualizar anuncio existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $anuncio = Anuncio::findOrFail($id);
        $anuncio->titulo = $request->titulo;
        $anuncio->descripcion = $request->descripcion;

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('anuncios', 'public');
            $anuncio->imagen = $path;
        }

        $anuncio->save();

        return redirect()->route('admin.anuncios.index')->with('success', 'Anuncio actualizado correctamente.');
    }

    // Eliminar un anuncio
    public function destroy($id)
    {
        $anuncio = Anuncio::findOrFail($id);
        $anuncio->delete();

        return redirect()->route('admin.anuncios.index')->with('success', 'Anuncio eliminado correctamente.');
    }
}
