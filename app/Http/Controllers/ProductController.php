<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Sector; 
use App\Models\Tipo;

class ProductController extends Controller
{

//public function show($sectorId)
//{
    // Encuentra el sector con sus tipos y productos relacionados
  //  $sector = Sector::with('tipos.productos')->findOrFail($sectorId);

    //return view('productos.tipos', compact('tipos'));
//}
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
    $tipo = Tipo::with('productos')->findOrFail($tipoId);
    return view('productos.productos', compact('tipo'));
}

}