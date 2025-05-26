<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'url',
        'posicion',
        'tipo',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'precio',
        'impresiones',
        'clics',
        'user_id',
        'universidad_id',
        'categoria_id'
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'estado' => 'boolean',
    ];

    // Relación con el usuario anunciante
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con la universidad (si aplica)
    public function universidad()
    {
        return $this->belongsTo(Universidad::class);
    }

    // Relación con la categoría (si aplica)
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Scope para anuncios activos
    public function scopeActivos($query)
    {
        return $query->where('estado', true)
                    ->where('fecha_inicio', '<=', now())
                    ->where('fecha_fin', '>=', now());
    }

    // Scope para anuncios por posición
    public function scopePorPosicion($query, $posicion)
    {
        return $query->where('posicion', $posicion);
    }

    // Scope para anuncios por tipo
    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    // Incrementar contador de impresiones
    public function registrarImpresion()
    {
        $this->increment('impresiones');
    }

    // Incrementar contador de clics
    public function registrarClic()
    {
        $this->increment('clics');
    }

    // Calcular CTR (Click-Through Rate)
    public function getCtrAttribute()
    {
        if ($this->impresiones == 0) {
            return 0;
        }
        
        return round(($this->clics / $this->impresiones) * 100, 2);
    }
}
