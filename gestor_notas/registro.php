<?php
session_start();
require_once ('config.php');

//Verificar si el formulario ha sido enviado

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //1. RECOGER LOS DATOS DEL FORM

    $nombre = $_POST['nombre'];
    $apellidos= $_POST['apellidos'];
    $url_foto = $_POST['foto'];
    $email =  $_POST['email'];
    $password = $_POST['password'];

    //Hasheo la contraseña

    $password_hasheada = password_hash($password, PASSWORD_DEFAULT);

    //Preparo la consula para insertar un usuario nuevo

    $stmt = $mysqli->prepare(
        "
            INSERT INTO Users (role, nombre, apellidos, foto, email, password)
            VALUES ('alumno', ?, ?, ?, ?, ?)
        "
    );

    //Compruebo que la preparacion ha tenido exito

    if(!$stmt){
        die('Error en la preparación: ' . $mysqli->error);
    }

    //Bindeo los parametros para que no puedan inyectar codigo

    $stmt->bind_param('sssss', $nombre, $apellidos, $url_foto, $email, $password_hasheada);

    //Ejecuto la consulta
    if($stmt->execute()){
        $success = 'Usuario registrado correctamente.';
    }else{
        $error = 'Error al registrar el usuario: ' . $stmt->error;
    }

    //Cerramos la conexión
    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Gestor de Notas UAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 0;
        }
        
        .register-container {
            max-width: 500px;
            width: 100%;
        }
        
        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
        }
        
        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo-icon {
            font-size: 4rem;
            color: #667eea;
            margin-bottom: 15px;
        }
        
        .logo-text {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        
        .logo-subtitle {
            color: #666;
            font-size: 0.9rem;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .input-group-text {
            background: #f8f9fa;
            border-right: none;
        }
        
        .form-control {
            border-left: none;
        }
        
        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }
        
        .divider::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #ddd;
        }
        
        .divider span {
            background: white;
            padding: 0 10px;
            position: relative;
            color: #999;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container mx-auto">
            <div class="register-card">
                <div class="logo-section">
                    <i class="bi bi-mortarboard-fill logo-icon"></i>
                    <div class="logo-text">UAB</div>
                    <div class="logo-subtitle">Gestor de Notas y Módulos</div>
                </div>
                
                <h4 class="text-center mb-3 fw-bold">Crear Cuenta</h4>
                <p class="text-center text-muted mb-4">Bienvenido al gestor de notas, regístrate para acceder</p>
                
                <?php if(isset($success)): ?>
                <div class="alert alert-success" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?= htmlspecialchars($success) ?>
                    <br>
                    <a href="login.php" class="alert-link">Iniciar sesión</a>
                </div>
                <?php endif; ?>
                
                <?php if(isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
                <?php endif; ?>
                
                <form action="registro.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-semibold">Nombre:</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="apellidos" class="form-label fw-semibold">Apellidos:</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Tus apellidos">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="foto" class="form-label fw-semibold">URL Foto:</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-image-fill"></i>
                            </span>
                            <input type="text" class="form-control" id="foto" name="foto" placeholder="https://ejemplo.com/foto.jpg">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email:</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="tu@uab.cat">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Contraseña:</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••">
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-register">
                            <i class="bi bi-person-plus me-2"></i>
                            Registrarse
                        </button>
                    </div>
                </form>
                
                <div class="divider">
                    <span>o</span>
                </div>
                
                <div class="text-center">
                    <p class="mb-2 text-muted">¿Ya tienes cuenta?</p>
                    <a href="login.php" class="btn btn-outline-primary w-100">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Iniciar Sesión
                    </a>
                </div>
                
                <div class="text-center mt-4">
                    <a href="index.php" class="text-decoration-none text-muted small">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver al inicio
                    </a>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <small class="text-white">
                    © 2024 Universidad Autónoma de Barcelona
                </small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>