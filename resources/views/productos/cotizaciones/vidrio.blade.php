@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-primary mb-4">Cotización - Vidrio</h1>

    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            <strong>{{ session('success') }}</strong>
            <p><strong>Producto:</strong> {{ session('producto') }}</p>
            <p><strong>Precio Total:</strong> ${{ session('precio_total') }}</p>
            <p><strong>Medidas:</strong> {{ session('medidas') }}</p>
        </div>
    @endif

    <!-- Formulario de cotización -->
    <form action="{{ route('cotizaciones.calcular') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="ancho" class="form-label">Ancho (cm)</label>
            <input type="number" class="form-control" id="ancho" name="ancho" placeholder="Ingrese el ancho en cm" required>
        </div>

        <div class="mb-3">
            <label for="alto" class="form-label">Alto (cm)</label>
            <input type="number" class="form-control" id="alto" name="alto" placeholder="Ingrese el alto en cm" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Seleccione un Tipo</label>
            <select class="form-select" id="tipo" onchange="cargarProductos(this)">
                <option value="" disabled selected>Seleccione un tipo</option>
                @foreach($sector->tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="producto_id" class="form-label">Seleccione un Producto</label>
            <select class="form-select" id="producto_id" name="producto_id" required>
                <option value="" disabled selected>Seleccione un producto</option>
                <!-- Productos cargados dinámicamente -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Calcular Cotización</button>
    </form>
</div>

<script>
    const tipos = @json($sector->tipos);

    function cargarProductos(select) {
        const tipoId = select.value;
        const productos = tipos.find(tipo => tipo.id == tipoId)?.productos || [];
        const productoSelect = document.getElementById('producto_id');
        productoSelect.innerHTML = '<option value="" disabled selected>Seleccione un producto</option>';

        productos.forEach(producto => {
            const option = document.createElement('option');
            option.value = producto.id;
            option.textContent = `${producto.nombre} ($${producto.precio}/m²)`;
            productoSelect.appendChild(option);
        });
    }
</script>
@endsection
