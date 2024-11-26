@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-primary mb-4">Crear Subproducto para: {{ $producto->nombre }}</h1>

    <form action="{{ route('admin.storeSubproducto', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Precio</label>
            <textarea class="form-control" id="precio" name="precio" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Subproducto</button>
    </form>
</div>
@endsection
