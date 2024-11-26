<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Product;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    public function index()
    {
        // Obtén el sector de vidrio con sus tipos y productos relacionados
        $sector = Sector::with('tipos.productos')->where('nombre', 'vidrio')->firstOrFail();

        return view('productos.cotizaciones.vidrio', compact('sector'));
    }

    public function calcular(Request $request)
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
        return view('productos.cotizaciones.vidrio', [
            'sector' => Sector::with('tipos.productos')->where('nombre', 'Vidrio')->first(),
            'resultado' => [
                'producto' => $producto->nombre,
                'precio_total' => number_format($precio_total, 2),
                'ancho' => $request->ancho,
                'alto' => $request->alto,
            ],
        ]);
    }
    

}

