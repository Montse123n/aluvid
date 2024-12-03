<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sector;
use App\Models\Subproducto;
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
public function showProductos($tipoId)
{
    $tipo = Tipo::findOrFail($tipoId);

    // Ordenar los productos por nombre
    $productos = Product::where('tipo_id', $tipoId)
        ->orderBy('nombre', 'asc') // Ordenar por nombre en orden ascendente
        ->get();

    // Asegurar que los subproductos de cada producto estén ordenados
    foreach ($productos as $producto) {
        $producto->subproductos = $producto->subproductos()->orderBy('nombre', 'asc')->get();
    }

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
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $tipoData = [
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'sector_id' => $sectorId,
    ];

    // Manejar la subida de la imagen
    if ($request->hasFile('imagen')) {
        $path = $request->file('imagen')->store('tipos', 'public');
        $tipoData['imagen'] = $path;
    }

    Tipo::create($tipoData);

    return redirect()->route('admin.showTipos', ['sectorId' => $sectorId])
        ->with('success', 'Tipo creado con éxito.');
}
    public function editTipo($tipoId)
    {
        $tipo = Tipo::findOrFail($tipoId);
        return view('admin.edit_tipo', compact('tipo'));
    }

    // Actualizar un tipo existente
    public function updateTipo(Request $request, $tipoId)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $tipo = Tipo::findOrFail($tipoId);
        $tipo->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);
        // Manejar la subida de la imagen
    if ($request->hasFile('imagen')) {
        // Eliminar la imagen anterior si existe
        if ($tipo->imagen) {
            Storage::disk('public')->delete($tipo->imagen);
        }
        $path = $request->file('imagen')->store('tipos', 'public');
        $tipoData['imagen'] = $path;
    }


        return redirect()->route('admin.showTipos', ['sectorId' => $tipo->sector_id])
            ->with('success', 'Tipo actualizado con éxito.');
    }

    // Eliminar un tipo
    public function destroyTipo($tipoId)
{
    $tipo = Tipo::findOrFail($tipoId);
    $tipo->delete();

    return redirect()->route('admin.showTipos', ['sectorId' => $tipo->sector_id])
        ->with('success', 'Tipo eliminado con éxito.');
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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $productData = $request->only(['nombre', 'descripcion', 'precio']);
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
    public function showSubproductos($productoId)
{
    $producto = Product::with('subproductos')->findOrFail($productoId);
    return view('admin.subproductos', compact('producto'));
}
public function createSubproducto($productoId)
{
    $producto = Product::findOrFail($productoId);
    return view('admin.create_subproducto', compact('producto'));
}

public function storeSubproducto(Request $request, $productoId)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'nullable|numeric|min:0', // Validación para precio
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $subproductoData = $request->only(['nombre', 'descripcion', 'precio']); // Incluir precio en los datos
    $subproductoData['producto_id'] = $productoId;

    if ($request->hasFile('imagen')) {
        $path = $request->file('imagen')->store('subproductos', 'public');
        $subproductoData['imagen_url'] = $path;
    }

    Subproducto::create($subproductoData);

    return redirect()->route('admin.showProductos', ['tipoId' => Product::findOrFail($productoId)->tipo_id])
        ->with('success', 'Subproducto creado con éxito.');
}


public function editSubproducto($id)
{
    $subproducto = Subproducto::findOrFail($id);
    return view('admin.edit_subproducto', compact('subproducto'));
}


public function updateSubproducto(Request $request, $id)
{
    $subproducto = Subproducto::findOrFail($id);

    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'nullable|numeric|min:0', // Validación para precio
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $subproductoData = $request->only(['nombre', 'descripcion', 'precio']); // Incluir precio en los datos

    if ($request->hasFile('imagen')) {
        if ($subproducto->imagen_url) {
            Storage::disk('public')->delete($subproducto->imagen_url);
        }
        $path = $request->file('imagen')->store('subproductos', 'public');
        $subproductoData['imagen_url'] = $path;
    }

    $subproducto->update($subproductoData);

    return redirect()->route('admin.showProductos', ['tipoId' => $subproducto->producto->tipo_id])
        ->with('success', 'Subproducto actualizado con éxito.');
}


public function destroySubproducto($id)
{
    $subproducto = Subproducto::findOrFail($id);

    if ($subproducto->imagen_url) {
        Storage::disk('public')->delete($subproducto->imagen_url);
    }

    $subproducto->delete();

    return redirect()->back()->with('success', 'Subproducto eliminado correctamente.');
}



}
