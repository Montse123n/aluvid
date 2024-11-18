<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - Vidrios y Aluminios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Vidrios & Aluminios</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#nosotros">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/catalogo') }}">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ubicacion">Ubicación</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <section id="nosotros" class="mb-5">
            <h1 class="text-primary">Nosotros</h1>
            <p class="lead">En <strong>Vidrios & Aluminios</strong>, nos dedicamos a ofrecer los mejores productos de vidrio y aluminio, garantizando calidad y satisfacción a nuestros clientes. Nuestra misión es proporcionar soluciones que se adapten a sus necesidades.</p>
        </section>

        <section id="catalogo" class="mb-5">
            <h1 class="text-primary">Catálogo</h1>
            <p class="lead">Explora nuestra amplia gama de productos de vidrio y aluminio. Desde paneles de vidrio hasta estructuras de aluminio, tenemos todo lo que necesitas para tus proyectos.</p>
            <a class="btn btn-primary" href="{{ url('/catalogo') }}">Ver Catálogo</a>
        </section>

        <section id="ubicacion" class="mb-5">
            <h1 class="text-primary">Ubicación</h1>
            <p class="lead">Nos encontramos en el corazón de la ciudad. Visítanos para conocer nuestros productos y recibir asesoría personalizada.</p>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dirección</h5>
                    <p class="card-text">Av. Principal #123, Ciudad, País</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-light text-center py-4">
        <p>&copy; {{ date('Y') }} Vidrios & Aluminios. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
