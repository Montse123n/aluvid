<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $table = 'tipos';

    protected $fillable = ['nombre', 'descripcion', 'sector_id'];

    // Relación inversa con Sector
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    // Relación de uno a muchos con Producto
    public function productos()
    {
        return $this->hasMany(Product::class);
    }
}
