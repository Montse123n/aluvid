@extends('layouts.app')

@section('content')
<!-- Header Mejorado -->
<div class="header-section mb-5">
    <div class="header-image-container">
        <img src="{{ asset('img/sectores-header.jpg') }}" alt="Header Background" class="header-image">
    </div>
    <div class="header-content text-center">
        <h1 class="text-white fw-bold display-4">Explora Nuestros Productos</h1>
        <p class="text-white fs-5">Descubre las mejores opciones en {{ $tipo->sector->nombre }}</p>
        <a href="{{ route('sector.tipos', ['sectorId' => $tipo->sector->id]) }}" class="btn btn-outline-light btn-lg mt-3">
            Ver Tipos de Productos
        </a>
    </div>
</div>

<div class="container my-5">
    @if(strtolower($tipo->sector->nombre) === 'vidrio')
        <div class="d-flex justify-content-end mb-3">
            <button id="openCalculator" class="btn toggle-button">
                <i class="bi bi-calculator-fill"></i> Ver Cotizador
            </button>
        </div>
    @endif

    <h1 class="text-center text-primary mb-4">Productos de {{ $tipo->nombre }}</h1>

    @if($productos->isEmpty())
        <p class="text-muted text-center">No hay productos disponibles en este tipo.</p>
    @else
        <div class="row">
            @foreach($productos as $producto)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 custom-card">
                        @if($producto->imagen_url)
                            <img src="{{ asset('storage/' . $producto->imagen_url) }}" 
                                 alt="{{ $producto->nombre }}" 
                                 class="card-img-top">
                        @endif

                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title font-weight-bold">{{ $producto->nombre }}</h5>
                            <p class="card-text text-muted">{{ $producto->descripcion }}</p>
                            @if($tipo->sector->nombre === 'Vidrio')
                                <p class="fw-bold text-primary">Precio: ${{ number_format($producto->precio, 2) }}</p>
                            @endif
                        </div>

                        @if(isset($producto->subproductos) && $producto->subproductos->isNotEmpty())
                            <div class="card-footer bg-light">
                                <h6 class="text-primary fw-bold mb-3">Subproductos</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach($producto->subproductos as $subproducto)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                @if($subproducto->imagen_url)
                                                    <img src="{{ asset('storage/' . $subproducto->imagen_url) }}" 
                                                         alt="{{ $subproducto->nombre }}" 
                                                         class="img-thumbnail me-3" 
                                                         style="height: 50px; width: 50px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('default-placeholder.png') }}" 
                                                         alt="Sin imagen" 
                                                         class="img-thumbnail me-3" 
                                                         style="height: 50px; width: 50px; object-fit: cover;">
                                                @endif
                                                <span>
                                                    <strong>{{ $subproducto->nombre }}</strong>
                                                    <p class="mb-0 text-muted small">{{ $subproducto->descripcion }}</p>
                                                </span>
                                            </div>
                                            <span class="fw-bold text-primary">
                                                ${{ number_format($subproducto->precio, 2) }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Modal del Cotizador -->
<div id="calculatorModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="text-white"><i class="bi bi-calculator"></i> Cotizador de Vidrio</h3>
            <span id="closeModal" class="close">&times;</span>
        </div>
        <div class="modal-body">
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
                    <label for="producto_id" class="form-label">Seleccione un Producto</label>
                    <select class="form-select" id="producto_id" name="producto_id" required>
                        <option value="" disabled selected>Seleccione un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre }} (${{ number_format($producto->precio, 2) }}/m²)</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-check-circle"></i> Calcular Cotización</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Resultado -->
@if(session('resultado'))
<div id="resultadoModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="text-white"><i class="bi bi-info-circle"></i> Resultado de Cotización</h3>
            <span id="closeResultadoModal" class="close">&times;</span>
        </div>
        <div class="modal-body">
            <p><strong>Producto:</strong> {{ session('resultado')['producto'] }}</p>
            <p><strong>Dimensiones:</strong> {{ session('resultado')['ancho'] }} cm x {{ session('resultado')['alto'] }} cm</p>
            <p><strong>Precio Total:</strong> ${{ session('resultado')['precio_total'] }}</p>
        </div>
    </div>
</div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Modal para Cotizador
        const modal = document.getElementById('calculatorModal');
        const openButton = document.getElementById('openCalculator');
        const closeButton = document.getElementById('closeModal');

        openButton.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        closeButton.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Modal para Resultado
        const resultadoModal = document.getElementById('resultadoModal');
        if (resultadoModal) {
            resultadoModal.style.display = 'flex';
            const closeResultado = document.getElementById('closeResultadoModal');
            closeResultado.addEventListener('click', () => {
                resultadoModal.style.display = 'none';
            });
        }
    });
</script>

<style>
    .header-section {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        margin-bottom: 50px;
    }

    .header-image-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    .header-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.5);
    }

    .header-content {
        padding: 100px 20px;
        color: white;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
    }

    .toggle-button {
        background: linear-gradient(135deg, #1e1e1e, #2575fc);
        color: white;
        font-weight: bold;
        border: none;
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 16px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transition: all 0.4s ease;
    }

    .toggle-button:hover {
        background: linear-gradient(135deg, #2575fc, #1e1e1e);
        transform: scale(1.1);
    }

    .custom-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .custom-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(30, 30, 30, 0.9);
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background-color: #2b2b2b;
        border-radius: 15px;
        padding: 20px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        color: white;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        border-bottom: 2px solid #444;
    }

    .close {
        font-size: 24px;
        cursor: pointer;
        color: white;
    }

    .close:hover {
        color: #ff4d4d;
    }
</style>
@endsection
