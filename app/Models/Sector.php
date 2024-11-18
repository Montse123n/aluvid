<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $table = 'sectores';

    protected $fillable = ['nombre','descripcion'];

    // Relación de uno a muchos con Tipo
    public function tipos()
    {
        return $this->hasMany(Tipo::class);
    }
}
