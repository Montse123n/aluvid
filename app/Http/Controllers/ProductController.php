<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen
        ]);

        // Crear un nuevo producto
        $productData = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
        ];

        // Manejo de la imagen
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public'); // Almacenar la imagen
            $productData['image_url'] = $path; // Guardar la ruta de la imagen en la base de datos
        }

        Product::create($productData); // Crear el producto con los datos

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
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen
        ]);

        // Actualizar el producto
        $productData = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            
        ];

        // Manejo de la imagen
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }
            $path = $request->file('image')->store('products', 'public'); // Almacenar la nueva imagen
            $productData['image_url'] = $path; // Guardar la nueva ruta de la imagen
        }

        $product->update($productData); // Actualizar el producto con los nuevos datos

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('products.index')->with('success', 'Producto actualizado con éxito.');
    }

    // Eliminar un producto
    public function destroy(Product $product)
    {
        // Eliminar la imagen del producto
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }

    public function showCatalog()
    {
        $productosPorCategoria = Product::all()->groupBy('category');

        return view('catalogo', compact('productosPorCategoria'));
    }
}
