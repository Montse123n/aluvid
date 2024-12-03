<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Product;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    public function index()
    {
        $sector = Sector::with('tipos.productos')->where('nombre', 'Vidrio')->firstOrFail();
        return view('productos.cotizaciones.vidrio', compact('sector'));
    }
    

    public function calcularCotizacion(Request $request)
    {
        $request->validate([
            'ancho' => 'required|numeric|min:1',
            'alto' => 'required|numeric|min:1',
            'producto_id' => 'required|exists:productos,id',
        ]);
    
        // Encuentra el producto
        $producto = Product::findOrFail($request->producto_id);
    
        // Calcula las medidas en metros
        $ancho_m = $request->ancho / 100;
        $alto_m = $request->alto / 100;
    
        // Calcula el precio total
        $area = $ancho_m * $alto_m;
        $precio_total = $area * $producto->precio;
    
        // Retorna la vista con el resultado
        return back()->with('resultado', [
            'producto' => $producto->nombre,
            'ancho' => $request->ancho,
            'alto' => $request->alto,
            'precio_total' => number_format($precio_total, 2),
        ]);
    }
    public function showSector($sectorId)
    {
        // Cargar el sector con sus tipos y productos
        $sector = Sector::with(['tipos.productos'])->findOrFail($sectorId);
    
        // Retornar la vista de tipos con el sector
        return view('productos.tipos', compact('sector'));
    }
    

    

}

