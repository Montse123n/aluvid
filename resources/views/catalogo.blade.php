<!-- resources/views/catalogo.blade.php -->

@extends('layouts.app')

@section('content')
    <h1 class="catalogo-title">Catálogo de Productos</h1>
    <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">

    <!-- Itera sobre cada categoría de productos -->
    @foreach ($productosPorCategoria as $categoria => $productos)
    <h2 class="categoria-title">{{ ucfirst($categoria) }}</h2>
    <div class="catalogo-container">
        @foreach ($productos as $producto)
            <div class="producto-card">
                <div class="producto-image">
                <img src="{{ asset('storage/' . $producto->image_url) }}" alt="{{ $producto->name }}">

                </div>
                <div class="producto-details">
                    <h3>{{ $producto->name }}</h3>
                    <p class="producto-descripcion">{{ $producto->description }}</p>
                    <p class="producto-precio">Precio: ${{ $producto->price }}</p>
                </div>
            </div>
        @endforeach
        </div>
    @endforeach
@endsection
