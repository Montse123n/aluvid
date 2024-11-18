<!-- resources/views/admin/edit_producto.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1>Editar Producto</h1>
    <div class="mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Regresar</a>
    </div>

    <form action="{{ route('admin.updateProducto', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $producto->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" required>{{ $producto->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" id="precio" class="form-control" value="{{ $producto->precio }}" required>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
    </form>
@endsection
