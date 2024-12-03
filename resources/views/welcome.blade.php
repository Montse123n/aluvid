<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALUVID Ixmiquilpan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            color: #333;
            background-color: #f4f6f9;
            padding-top: 70px; /* Compensar espacio por el menú fijo */
        }

        /* Navbar */
        .navbar-custom {
            background-color: #002f4b;
            border-bottom: 3px solid #0096d6;
        }
        .navbar-custom .nav-link {
            color: #ffffff !important;
            font-size: 1rem;
            font-weight: 500;
        }
        .navbar-custom .nav-link:hover {
            color: #0096d6 !important;
        }
        .navbar-custom .navbar-brand {
            color: #ffffff !important;
            font-size: 1.8rem;
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

        /* Nosotros */
        .about-section {
            padding: 4rem 2rem;
            background-color: #f8f9fa;
            border-bottom: 3px solid #0096d6;
        }

        .about-section h2 {
            text-align: center;
            font-weight: 700;
            color: #002f4b;
            font-size: 2.5rem;
        }

        .about-section p {
            color: #555;
            font-size: 1.1rem;
            line-height: 1.8;
            text-align: justify;
        }

        .about-section .subheading {
            font-weight: 600;
            color: #002f4b;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }

        .about-section .subheading i {
            font-size: 1.5rem;
            color: #0096d6;
        }

        .image-container img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Sectores */
        .sectors-section {
            padding: 4rem 0;
            background-color: #ffffff;
        }
        .sectors-section h2 {
            color: #002f4b;
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
            background-color: #0096d6;
            border: none;
            font-weight: 500;
            color: #ffffff;
        }
        .overlay .btn:hover {
            background-color: #0077a5;
        }

        /* Ubicación */
        .location-section {
            padding: 4rem 2rem;
            background-color: #f8f9fa;
        }
        .location-section h2 {
            color: #002f4b;
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
        }
        .location-section iframe {
            border: 0;
            width: 100%;
            height: 400px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        .footer {
            background-color: #002f4b;
            color: #f4f6f9;
            padding: 3rem 0;
            font-size: 0.9rem;
        }
        .footer h5 {
            color: #0096d6;
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .footer a {
            color: #ffffff;
            text-decoration: none;
        }
        .footer a:hover {
            color: #0096d6;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">ALUVID Ixmiquilpan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary ms-3" href="{{ route('login') }}">Iniciar Sesion</a>
                    </li>                    <li class="nav-item">
                        <a class="btn btn-primary ms-3" href="{{ route('register') }}">Registrarse</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <h1>Bienvenido a ALUVID Ixmiquilpan</h1>
            <p>Calidad y diseño en cada detalle</p>
        </div>
    </header>

    <!-- Nosotros -->
    <section class="about-section">
        <div class="container">
            <h2 class="mb-5">Sobre Nosotros</h2>
            <div class="row">
                <div class="col-md-6">
                    <p>
                    Desde 1990, nuestra empresa se ha dedicado a ofrecer soluciones de alta calidad en aluminio y vidrio, convirtiéndose en un referente de confianza y excelencia en el sector. Con más de tres décadas de experiencia, hemos trabajado con pasión para transformar espacios residenciales, comerciales e industriales, adaptándonos a las necesidades y tendencias de cada cliente.

Nos enorgullece combinar materiales de primera, tecnología innovadora y un equipo altamente capacitado para garantizar proyectos duraderos, funcionales y estéticamente impecables. Nuestra misión es crear espacios que reflejen estilo, seguridad y modernidad, siempre comprometidos con la satisfacción de quienes confían en nosotros.

En cada proyecto, reafirmamos nuestro compromiso con la calidad, el diseño y el servicio personalizado, valores que nos han acompañado desde nuestros inicios y que hoy nos permiten seguir construyendo el futuro con transparencia y fortaleza.
                    </p>
                    <div class="subheading">
                        <i class="bi bi-bullseye text-primary me-2"></i> Misión
                    </div>
                    <p>
                        Proveer soluciones de alta calidad en aluminio y vidrio, enfocándonos en la satisfacción 
                        del cliente mediante productos innovadores y duraderos.
                    </p>
                    <div class="subheading">
                        <i class="bi bi-eye text-primary me-2"></i> Visión
                    </div>
                    <p>
                        Ser una empresa líder en el mercado, destacándonos por nuestra excelencia en diseño, 
                        calidad y compromiso con la innovación en aluminio y vidrio.
                    </p>
                </div>
                <div class="col-md-6 text-center">
                    <img src="img/nosotros.jpg" alt="Sobre Nosotros" class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Sectores -->
    <section class="sectors-section">
        <div class="container">
            <h2>Nuestros productos</h2>
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

    <!-- Ubicación -->
    <section class="location-section">
    <div class="container">
        <h2>Ubicación</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3552.3748050419726!2d-99.21496830219037!3d20.4942139394509!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d3e04102743045%3A0x7d72837fc6bcbee1!2sVidrio%20Y%20Aluminio!5e1!3m2!1sen!2smx!4v1733248547118!5m2!1sen!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></section>


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <p>Lib. al Cardonal, San Nicolás, 42302 Ixmiquilpan, Hgo.</p>
                    <p>Email: aluvidixmiquilpan@gmail.com</p>
                    <p>Teléfono: 7712003391</p>
                </div>
                <div class="col-md-4">
                    <h5>Síguenos</h5>
                    <a href="#">Facebook</a> | <a href="#">Twitter</a> | <a href="#">Instagram</a>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces útiles</h5>
                    <a href="{{ route('sectores.show', ['sector' => 1]) }}">Vidrio</a><br>
                    <a href="{{ route('sectores.show', ['sector' => 3]) }}">Aluminio</a><br>
                    <a href="{{ route('sectores.show', ['sector' => 2]) }}">Herrajes</a>
                </div>
            </div>
            <p class="text-center mt-4">© 2024 ALUVID Ixmiquilpan. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
