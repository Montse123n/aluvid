<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Mostrar lista de productos y formulario para crear/editar
    public function index()
    {
        $products = Product::all(); // Obtener todos los productos
        return view('products.index', compact('products')); // Pasar los productos a la vista
    }

    // Crear un nuevo producto
    public function store(Request $request)
    {
        
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string', // Guarda la categoría
        ]);

        // Crear un nuevo producto
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category, // Guarda la categoría
        ]);

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('products.index')->with('success', 'Producto creado con éxito.');
    }

    // Editar un producto
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Obtener el producto
        $products = Product::all(); // Obtener todos los productos
        return view('products.index', compact('product', 'products')); // Pasar a la vista
    }

    // Actualizar un producto
    public function update(Request $request, Product $product)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string', // Guarda la categoría
        ]);

        // Actualizar el producto
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,  // Guarda la categoría
        ]);

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('products.index')->with('success', 'Producto actualizado con éxito.');
    }

    // Eliminar un producto
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }
}
