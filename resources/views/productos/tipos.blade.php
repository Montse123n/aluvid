@extends('layouts.app')

@section('content')
<div class="header-section mb-5">
    <div class="header-image-container">
        <img src="{{ asset('img/sectores-header.jpg') }}" alt="Header Background" class="header-image">
    </div>
    <div class="header-content text-center">
        <h1 class="text-white fw-bold display-4">Explora Nuestros Productos</h1>
        <p class="text-white fs-5">Descubre las mejores opciones en ALUVID</p>
    </div>
</div>
<div class="container my-5">
    <!-- Botón para abrir el modal en la parte superior derecha -->
    @if(in_array(strtolower(trim($sector->nombre)), ['vidrio', 'vidrios']))
        <div class="d-flex justify-content-end mb-2">
            <button id="openCalculator" class="btn toggle-button">
                <i class="bi bi-calculator-fill"></i> Ver Cotizador
            </button>
        </div>
    @endif

    <!-- Título -->
    <div class="text-center mb-5" style="margin-top: -30px;">
        <h1 class="text-primary">Tipos en {{ $sector->nombre }}</h1>
    </div>

    <!-- Tipos de Productos -->
    <div class="row justify-content-center align-items-center">
        @if ($sector->tipos->isEmpty())
            <p class="text-center text-muted">No hay tipos disponibles para este sector.</p>
        @else
        <div class="row justify-content-center">
    @foreach($sector->tipos as $tipo)
        <div class="col-md-4 mb-4 custom-column">
            <div class="card shadow-sm h-100 transition-card custom-card">
                @if($tipo->imagen)
                    <img src="{{ asset('storage/' . $tipo->imagen) }}" 
                         alt="{{ $tipo->nombre }}" 
                         class="card-img-top">
                @endif
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title font-weight-bold">{{ $tipo->nombre }}</h5>
                    <p class="card-text">{{ $tipo->descripcion }}</p>
                    <a href="{{ route('tipo.productos', ['tipoId' => $tipo->id]) }}" class="btn btn-outline-primary mt-auto">
                        Ver Productos
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

        @endif
    </div>
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
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-check-circle"></i> Calcular Cotización</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal para mostrar el resultado de la cotización -->
@if(session('resultado'))
<div id="resultadoModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="text-white"><i class="bi bi-receipt"></i> Resultado de la Cotización</h3>
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
    const tipos = @json($sector->tipos);

    // Abrir y cerrar el modal del cotizador
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('calculatorModal');
        const openButton = document.getElementById('openCalculator');
        const closeButton = document.getElementById('closeModal');
        const resultadoModal = document.getElementById('resultadoModal');
        const closeResultadoButton = document.getElementById('closeResultadoModal');

        openButton.addEventListener('click', () => {
            modal.style.display = 'flex';
            modal.classList.add('fade-in');
        });

        closeButton.addEventListener('click', () => {
            modal.classList.remove('fade-in');
            modal.style.display = 'none';
        });

        if (resultadoModal) {
            resultadoModal.style.display = 'flex';
            closeResultadoButton.addEventListener('click', () => {
                resultadoModal.style.display = 'none';
            });
        }

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
            if (event.target === resultadoModal) {
                resultadoModal.style.display = 'none';
            }
        });
    });

    function cargarProductos(select) {
        const tipoId = select.value;
        const tipoSeleccionado = tipos.find(tipo => tipo.id == tipoId);

        const productoSelect = document.getElementById('producto_id');
        productoSelect.innerHTML = '<option value="" disabled selected>Seleccione un producto</option>';

        if (tipoSeleccionado && Array.isArray(tipoSeleccionado.productos) && tipoSeleccionado.productos.length > 0) {
            tipoSeleccionado.productos.forEach(producto => {
                const option = document.createElement('option');
                option.value = producto.id;
                option.textContent = `${producto.nombre} ($${producto.precio}/m²)`;
                productoSelect.appendChild(option);
            });
        } else {
            const option = document.createElement('option');
            option.textContent = "No hay productos disponibles";
            option.disabled = true;
            productoSelect.appendChild(option);
        }
    }
</script>

<style>
    .header-section {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
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

    /* Modal del cotizador y resultado */
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
        animation: slideDown 0.4s ease-out;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        border-bottom: 2px solid #444;
    }
    .header-section {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
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
    /* Botón superior */
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

    /* Modal */
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
        animation: slideDown 0.4s ease-out;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        border-bottom: 2px solid #444;
    }

    .modal-body {
        margin-top: 10px;
    }

    .close {
        font-size: 24px;
        cursor: pointer;
        color: white;
        transition: color 0.3s;
    }

    .close:hover {
        color: #ff4d4d;
    }
    .card {
    position: relative;
    overflow: hidden;
}
.custom-card {
    position: relative;
    overflow: hidden;
    border: none;
    border-radius: 15px; /* Bordes redondeados */
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Sombra elegante */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 500px; /* Altura fija */
}

.custom-card:hover {
    transform: translateY(-5px); /* Efecto de elevación */
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3); /* Sombra más prominente */
}

.card-img-top {
    width: 100%;
    height: 100%; /* Imagen ocupa todo el contenedor */
    object-fit: cover; /* Ajusta la imagen sin deformarla */
    filter: brightness(0.6); /* Oscurece ligeramente la imagen */
    transition: transform 0.3s ease, filter 0.3s ease; /* Suaviza el efecto */
}

.custom-card:hover .card-img-top {
    transform: scale(1.1); /* Zoom suave */
    filter: brightness(0.4); /* Oscurece más la imagen al pasar el cursor */
}

.card-body {
    position: absolute;
    bottom: 0; /* Fija el contenido en la parte inferior */
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.7); /* Fondo oscuro semitransparente */
    padding: 20px;
    text-align: center;
    color: #ffffff; /* Letras en blanco puro */
}

.card-body h5 {
    font-size: 1.8rem; /* Título más grande */
    font-weight: bold;
    margin-bottom: 10px;
    color: #ffffff; /* Blanco puro */
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 1); /* Sombra fuerte para garantizar visibilidad */
}

.card-body p {
    font-size: 1rem; /* Texto más grande */
    margin-bottom: 15px;
    color: #ffffff; /* Blanco puro */
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 1); /* Sombra fuerte */
}

.card-body .btn {
    padding: 10px 20px;
    border-radius: 30px;
    font-size: 1rem;
    background: #2575fc; /* Azul vibrante */
    color: #ffffff; /* Texto blanco */
    transition: background 0.3s ease, transform 0.3s ease;
    text-transform: uppercase;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra para el botón */
}

.card-body .btn:hover {
    background: #1e5cbf; /* Azul más oscuro */
    transform: translateY(-2px); /* Movimiento sutil */
}





/* Animación */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

    /* Animación */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20%);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
