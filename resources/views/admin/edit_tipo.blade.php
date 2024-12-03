@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-primary mb-4">Editar Tipo</h1>
    
    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.updateTipo', ['tipoId' => $tipo->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $tipo->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $tipo->descripcion }}</textarea>
        </div>
        <div class="mb-3">
        <label for="imagen" class="form-label">Imagen del Tipo</label>
        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
        @if($tipo->imagen_url)
            <p class="mt-2">Imagen Actual:</p>
            <img src="{{ asset('storage/' . $tipo->imagen_url) }}" alt="Imagen del Tipo" style="height: 100px;">
        @endif
    </div>
        <button type="submit" class="btn btn-primary">Actualizar Tipo</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
