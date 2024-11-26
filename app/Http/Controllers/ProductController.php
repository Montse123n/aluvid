<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Sector; 
use App\Models\Tipo;

class ProductController extends Controller
{

public function showSectores()
{
    $sectores = Sector::all();
    return view('productos.sectores', compact('sectores'));
}

public function showTipos($sectorId)
{
    $sector = Sector::with('tipos')->findOrFail($sectorId);
    return view('productos.tipos', compact('sector'));
}


public function showProductos($tipoId)
{
    $tipo = Tipo::findOrFail($tipoId);

    // Obtener los productos asociados al tipo
    $productos = Product::where('tipo_id', $tipoId)
        ->orderBy('nombre', 'asc') // Ordenar productos alfabéticamente
        ->get();

    // Si el sector es "Aluminio" o "Herrajes", cargar los subproductos
    if (in_array($tipo->sector->nombre, ['Aluminio', 'Herrajes'])) {
        foreach ($productos as $producto) {
            $producto->subproductos = $producto->subproductos()->orderBy('nombre', 'asc')->get();
        }
    }

    // Pasar los datos a la vista
    return view('productos.productos', compact('tipo', 'productos'));
}



}