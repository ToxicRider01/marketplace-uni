<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Tabla asociada (opcional si sigue la convención plural)
    protected $table = 'categorias';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'descripcion', // si quieres una descripción opcional
    ];

    // Relación inversa: una categoría tiene muchos anuncios
    public function anuncios()
    {
        return $this->hasMany(Anuncio::class);
    }
}
