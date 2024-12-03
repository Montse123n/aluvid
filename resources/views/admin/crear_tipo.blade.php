{{-- resources/views/admin/crear_tipo.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Crear Tipo de Producto</h1>
    <div class="mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Regresar</a>
    </div>
    
    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario de creación de tipo de producto --}}
    <form action="{{ route('admin.storeTipo', ['sectorId' => $sectorId]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Tipo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen del Tipo</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Tipo de Producto</button>
    </form>
</div>
@endsection
