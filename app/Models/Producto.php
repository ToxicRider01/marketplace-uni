<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'precio',
        'descripcion',
        'categoria',
        'imagen',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
