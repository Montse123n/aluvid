<!-- resources/views/products/catalogo.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Catálogo de Productos</h1>
    
    <div class="row">
        @foreach($productos as $producto)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ $producto->imagen }}" class="card-img-top" alt="{{ $producto->nombre }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">{{ $producto->descripcion }}</p>
                        <p class="card-text">Precio: ${{ $producto->precio }}</p>
                        <a href="#" class="btn btn-primary">Cotizar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
