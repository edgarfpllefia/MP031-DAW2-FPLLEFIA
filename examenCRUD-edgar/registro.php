<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Alquiler de Coches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=1920');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px 0;
            position: relative;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            z-index: -1;
        }
        
        .registro-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            max-width: 600px;
            margin: auto;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .registro-header {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
        }
        
        .registro-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1920');
            background-size: cover;
            background-position: center;
            opacity: 0.2;
            z-index: 0;
        }
        
        .registro-header * {
            position: relative;
            z-index: 1;
        }
        
        .registro-header i {
            font-size: 3rem;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .registro-body {
            padding: 40px;
        }
        
        .form-label {
            font-weight: 600;
            color: #333;
        }
        
        .form-control:focus,
        .form-select:focus {
            border-color: #ff6b35;
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
        }
        
        .btn-registro {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-registro:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.5);
            background: linear-gradient(135deg, #f7931e 0%, #ff6b35 100%);
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
        
        .login-link a {
            color: #ff6b35;
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link a:hover {
            text-decoration: underline;
            color: #f7931e;
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
            color: #ff6b35;
        }
        
        .input-group .form-control {
            border-left: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="registro-container">
            <div class="registro-header">
                <i class="bi bi-car-front-fill"></i>
                <h2>Únete a RentCar</h2>
                <p class="mb-0">Regístrate y accede a los mejores vehículos de alquiler</p>
            </div>
            
            <div class="registro-body">
                <form action="" method="POST">
                    <div class="row g-3">
                        <!-- Nombre -->
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre" required>
                            </div>
                        </div>
                        
                        <!-- Apellidos -->
                        <div class="col-md-6">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Tus apellidos" required>
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="col-12">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="tu@email.com" required>
                            </div>
                        </div>
                        
                        <!-- Contraseña -->
                        <div class="col-12">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Mínimo 8 caracteres" required>
                            </div>
                        </div>
                        
                        <!-- Dirección -->
                        <div class="col-12">
                            <label for="direccion" class="form-label">Dirección</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Calle, Número, Ciudad, CP" required>
                            </div>
                        </div>
                        
                        <!-- Botón de Registro -->
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary btn-registro w-100">
                                <i class="bi bi-car-front me-2"></i>Registrarse y Alquilar
                            </button>
                        </div>
                    </div>
                </form>
                
                <!-- Enlace a Login -->
                <div class="login-link">
                    ¿Ya tienes cuenta? <a href="login.html">Inicia Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>