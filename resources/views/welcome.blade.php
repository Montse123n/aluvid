<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            color: #333;
            background-color: #f4f6f9;
        }

        /* Navbar */
        .navbar-custom {
            background-color: #1a1a1a;
            border-bottom: 2px solid #007bff;
        }
        .navbar-custom .nav-link {
            color: #ffffff !important;
            font-size: 1rem;
            font-weight: 500;
        }
        .navbar-custom .nav-link:hover {
            color: #007bff !important;
        }
        .navbar-custom .navbar-brand {
            color: #007bff !important;
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Header */
        .header {
            background: url('img/header-image.jpg') no-repeat center center/cover;
            color: #ffffff;
            text-align: center;
            padding: 120px 0;
        }
        .header h1 {
            font-size: 3.5rem;
            font-weight: 700;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
        }
        .header p {
            font-size: 1.5rem;
            font-weight: 400;
        }

        /* Sectores */
        .sectors-section {
            padding: 4rem 0;
            background-color: #ffffff;
        }
        .sectors-section h2 {
            color: #1a1a1a;
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
        }
        .sector-card {
            position: relative;
            width: 100%;
            border: none;
            overflow: hidden;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 300px;
        }

        .sector-card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .sector-card .sector-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sector-card .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .sector-card:hover .overlay {
            opacity: 1;
        }

        .overlay .sector-text {
            font-size: 2rem;
            font-weight: 600;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
            margin-bottom: 15px;
            color: #ffffff;
        }

        .overlay .btn {
            background-color: #007bff;
            border: none;
            font-weight: 500;
        }

        .overlay .btn:hover {
            background-color: #0056b3;
        }

        /* Footer */
        .footer {
            background-color: #1a1a1a;
            color: #f4f6f9;
            padding: 3rem 0;
            font-size: 0.9rem;
        }
        .footer h5 {
            color: #007bff;
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .footer a {
            color: #ffffff;
            text-decoration: none;
        }
        .footer a:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">Tienda de Vidrios y Aluminios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <h1>Bienvenido a la tienda de vidrios y aluminios</h1>
            <p>Explora nuestros productos y servicios</p>
        </div>
    </header>

    <!-- Sectores -->
    <section class="sectors-section">
        <div class="container">
            <h2>Nuestros Sectores</h2>
            <div class="row g-4">
                <div class="col-12">
                    <div class="sector-card">
                        <img src="img/aluminio.jpg" alt="Aluminios" class="sector-img">
                        <div class="overlay">
                            <h3 class="sector-text">Línea de Aluminios</h3>
                            <a href="{{ route('sectores.show', ['sector' => 1]) }}" class="btn btn-primary">Explorar</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="sector-card">
                        <img src="img/vidrios.jpg" alt="Vidrios" class="sector-img">
                        <div class="overlay">
                            <h3 class="sector-text">Línea de Vidrios</h3>
                            <a href="{{ route('sectores.show', ['sector' => 2]) }}" class="btn btn-primary">Explorar</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="sector-card">
                        <img src="img/herrajes.jpg" alt="Herrajes" class="sector-img">
                        <div class="overlay">
                            <h3 class="sector-text">Línea de Herrajes</h3>
                            <a href="{{ route('sectores.show', ['sector' => 3]) }}" class="btn btn-primary">Explorar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <p>1234 Calle Ejemplo, Ciudad, País</p>
                    <p>Email: contacto@empresa.com</p>
                    <p>Teléfono: +1 234 567 890</p>
                </div>
                <div class="col-md-4">
                    <h5>Síguenos</h5>
                    <a href="#">Facebook</a> | <a href="#">Twitter</a> | <a href="#">Instagram</a>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces útiles</h5>
                    <a href="#">Inicio</a><br>
                    <a href="#">Cotización</a><br>
                    <a href="#">Nosotros</a>
                </div>
            </div>
            <p class="text-center mt-4">© 2024 Tienda de Vidrios y Aluminios. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
