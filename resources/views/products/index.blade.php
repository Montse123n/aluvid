@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6">
    <h1 class="text-2xl font-bold">Gestión de Productos</h1>

    <!-- Formulario para crear o editar un producto -->
    <div class="mt-4">
        <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST">
            @csrf
            @if(isset($product))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
                <input type="text" id="name" name="name" value="{{ isset($product) ? $product->name : '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea id="description" name="description" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">{{ isset($product) ? $product->description : '' }}</textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                <input type="number" id="price" name="price" value="{{ isset($product) ? $product->price : '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
    <label for="category" class="block text-sm font-medium text-gray-700">Categoría</label>
    <select id="category" name="category" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
        <option value="">Seleccionar categoría</option>
        <option value="Aluminio">Aluminio</option>
        <option value="Vidrio">Vidrio</option>
        <option value="Herrajes">Herrajes</option>
    </select>
</div>


            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-200 active:bg-blue-600 transition duration-150 ease-in-out">
                {{ isset($product) ? 'Actualizar Producto' : 'Agregar Producto' }}
            </button>

            @if(isset($product))
                <a href="{{ route('products.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-200 focus:bg-gray-300 focus:outline-none focus:ring focus:ring-gray-200 active:bg-gray-400 transition duration-150 ease-in-out">
                    Cancelar
                </a>
            @endif
        </form>
    </div>

    <!-- Tabla de productos -->
    <div class="mt-8">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Nombre</th>
                    <th class="py-2 px-4 border-b">Descripción</th>
                    <th class="py-2 px-4 border-b">Precio</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>${{ $product->price }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
