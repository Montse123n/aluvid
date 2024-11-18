<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Nombre de la tabla en español

    // Define los nombres de las columnas en español
    protected $fillable = ['nombre', 'descripcion', 'precio', 'medidas', 'imagen_url', 'tipo_id'];

    // Relación: Un producto pertenece a un tipo
    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }
}
