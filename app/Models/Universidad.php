<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universidad extends Model
{
    use HasFactory;

    protected $table = 'universidades';

    protected $fillable = [
        'nombre',
        'siglas',
        'logo',
        'ciudad',
        'direccion',
        'sitio_web'
    ];

    // Relación con anuncios
    public function anuncios()
    {
        return $this->hasMany(Anuncio::class);
    }
}
