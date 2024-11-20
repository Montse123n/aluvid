<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Tipo;
use App\Models\Product;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    // Mostrar vista principal de cotización (con sector vidrio)
    public function showVidrioCotizacion()
    {
        $sector = Sector::where('nombre', 'vidrio')->with('tipos.productos')->firstOrFail();
        return view('productos.cotizaciones.vidrio', compact('sector'));
    }

    // Calcular cotización
    public function calcularCotizacion(Request $request)
    {
        $request->validate([
            'ancho' => 'required|numeric|min:0',
            'alto' => 'required|numeric|min:0',
            'producto_id' => 'required|exists:products,id',
        ]);

        // Recuperar producto seleccionado
        $producto = Product::findOrFail($request->producto_id);

        // Calcular precio en base a medidas
        $area = ($request->ancho / 100) * ($request->alto / 100); // Convertimos a metros cuadrados
        $precio_total = $area * $producto->precio;

        return redirect()->back()->with([
            'success' => 'Cotización calculada con éxito.',
            'producto' => $producto->nombre,
            'precio_total' => number_format($precio_total, 2),
            'medidas' => "Ancho: {$request->ancho} cm, Alto: {$request->alto} cm",
        ]);
    }
}
