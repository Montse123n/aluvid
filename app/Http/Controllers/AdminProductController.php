<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sector;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    // Mostrar la página principal del administrador con sectores
    public function index()
    {
        $sectores = Sector::all();
        return view('admin.index', compact('sectores'));
    }

    // Mostrar los tipos de productos en un sector
    public function showTipos($sectorId)
    {
        $sector = Sector::findOrFail($sectorId);
        $tipos = $sector->tipos;
        return view('admin.tipos', compact('tipos', 'sector'));
    }

    // Mostrar productos específicos dentro de un tipo
    // Mostrar productos específicos dentro de un tipo
public function showProductos($tipoId)
{
    $tipo = Tipo::findOrFail($tipoId); // Encuentra el tipo seleccionado
    $productos = Product::where('tipo_id', $tipoId)->get(); // Obtiene los productos del tipo seleccionado
    return view('admin.productos', compact('tipo', 'productos'));
}

    // Mostrar formulario de creación de tipo
    public function createTipo($sectorId)
    {
        return view('admin.crear_tipo', compact('sectorId'));
    }

    // Guardar un nuevo tipo
    public function storeTipo(Request $request, $sectorId)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        Tipo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'sector_id' => $sectorId,
        ]);

        return redirect()->route('admin.showTipos', ['sectorId' => $sectorId])->with('success', 'Tipo creado con éxito.');
    }

    // Mostrar formulario de creación de producto
    public function createProducto($tipoId)
    {
        return view('admin.create_producto', compact('tipoId'));
    }

    // Guardar un nuevo producto
    public function storeProducto(Request $request, $tipoId)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'medidas' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $productData = $request->only(['nombre', 'descripcion', 'precio', 'medidas']);
        $productData['tipo_id'] = $tipoId;

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('productos', 'public');
            $productData['imagen_url'] = $path;
        }

        Product::create($productData);

        return redirect()->route('admin.showProductos', ['tipoId' => $tipoId])->with('success', 'Producto creado con éxito.');
    }

    // Editar un producto
    public function editProducto($id)
    {
        $producto = Product::findOrFail($id);
        return view('admin.edit_producto', compact('producto'));
    }

    // Actualizar un producto
    public function updateProducto(Request $request, $id)
    {
        $producto = Product::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $productData = $request->only(['nombre', 'descripcion', 'precio']);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen_url) {
                Storage::disk('public')->delete($producto->imagen_url);
            }
            $path = $request->file('imagen')->store('productos', 'public');
            $productData['imagen_url'] = $path;
        }

        $producto->update($productData);

        return redirect()->route('admin.showProductos', ['tipoId' => $producto->tipo_id])->with('success', 'Producto actualizado con éxito.');
    }

    // Eliminar un producto
    public function destroyProducto(Product $producto)
    {
        if ($producto->imagen_url) {
            Storage::disk('public')->delete($producto->imagen_url);
        }

        $producto->delete();
        return redirect()->back()->with('success', 'Producto eliminado correctamente.');
    }
    public function getSectoresConTipos()
{
    // Obtiene todos los sectores con sus tipos
    return Sector::with('tipos')->get();
}

}
