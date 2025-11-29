<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Notas y Módulos - UAB</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .hero-section {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .hero-left {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 40px;
        }
        
        .hero-right {
            padding: 60px 40px;
        }
        
        .logo-uab {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .feature-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 15px;
        }
        
        .btn-custom {
            padding: 15px 40px;
            font-size: 1.1rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-login {
            background: #667eea;
            border: none;
            color: white;
        }
        
        .btn-login:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-register {
            background: white;
            border: 2px solid #667eea;
            color: #667eea;
        }
        
        .btn-register:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .feature-card {
            text-align: center;
            padding: 20px;
            margin: 10px 0;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        @media (max-width: 768px) {
            .hero-left {
                padding: 40px 20px;
            }
            .hero-right {
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row hero-section">
            <!-- Lado Izquierdo - Información -->
            <div class="col-lg-6 hero-left">
                <div class="logo-uab">
                    <i class="bi bi-mortarboard-fill"></i> UAB
                </div>
                <h1 class="display-4 fw-bold mb-4">Gestor de Notas y Módulos</h1>
                <p class="lead mb-5">
                    La plataforma completa para la gestión académica de la Universidad Autónoma de Barcelona
                </p>
                
                <div class="row mt-5">
                    <div class="col-md-6 feature-card">
                        <i class="bi bi-journal-bookmark feature-icon"></i>
                        <h5>Gestión de Notas</h5>
                        <p class="text-white-50">Consulta y administra calificaciones fácilmente</p>
                    </div>
                    <div class="col-md-6 feature-card">
                        <i class="bi bi-book feature-icon"></i>
                        <h5>Módulos</h5>
                        <p class="text-white-50">Organiza y accede a tus módulos académicos</p>
                    </div>
                    <div class="col-md-6 feature-card">
                        <i class="bi bi-graph-up feature-icon"></i>
                        <h5>Estadísticas</h5>
                        <p class="text-white-50">Visualiza tu progreso académico</p>
                    </div>
                    <div class="col-md-6 feature-card">
                        <i class="bi bi-shield-check feature-icon"></i>
                        <h5>Seguro</h5>
                        <p class="text-white-50">Tus datos están protegidos</p>
                    </div>
                </div>
            </div>
            
            <!-- Lado Derecho - Acceso -->
            <div class="col-lg-6 hero-right">
                <div class="text-center mb-5">
                    <h2 class="fw-bold mb-3">Bienvenido/a</h2>
                    <p class="text-muted">Accede a tu cuenta o crea una nueva para comenzar</p>
                </div>
                
                <!-- Botones de Acceso -->
                <div class="d-grid gap-3 mb-4">
                    <a href="login.php" class="btn btn-custom btn-login">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Iniciar Sesión
                    </a>
                    <a href="registro.php" class="btn btn-custom btn-register">
                        <i class="bi bi-person-plus me-2"></i>
                        Registrarse
                    </a>
                </div>
                
                <hr class="my-4">
                
                <!-- Información Adicional -->
                <div class="alert alert-info" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>¿Eres estudiante nuevo?</strong> Crea tu cuenta con tu email institucional de la UAB.
                </div>
                
                <div class="text-center mt-4">
                    <small class="text-muted">
                        ¿Problemas para acceder? 
                        <a href="#" class="text-decoration-none">Contacta con soporte</a>
                    </small>
                </div>
                
                <!-- Footer -->
                <div class="text-center mt-5 pt-4 border-top">
                    <p class="text-muted small mb-0">
                        © 2024 Universidad Autónoma de Barcelona
                    </p>
                    <p class="text-muted small">
                        <a href="#" class="text-decoration-none me-3">Términos</a>
                        <a href="#" class="text-decoration-none me-3">Privacidad</a>
                        <a href="#" class="text-decoration-none">Ayuda</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
