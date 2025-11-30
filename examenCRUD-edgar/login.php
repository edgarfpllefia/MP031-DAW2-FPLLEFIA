<?php
session_start();
require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if($resultado->num_rows === 1){
        $usuario = $resultado->fetch_assoc();
    }

    if(password_verify($password, $usuario['password'])){
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_name'] = $usuario['nombre'];
        $_SESSION['user_email'] = $usuario['email'];
        $_SESSION['user_role'] = $usuario['role'];
        $_SESSION['user_foto'] = $usuario['foto'];

        if($_SESSION['user_role'] === 'admin'){
            header('Location: admin/adminDashboard.php');
            exit();
        }

        if($_SESSION['user_role'] === 'client'){
            header('Location: users/userDashboard.php');
            exit();
        }
        

    }else{
        echo "<h1 style='color: red';>Contraseña incorrecta</h1>";
    }
}

?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Alquiler de Coches</title>
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
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            max-width: 500px;
            margin: auto;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .login-header {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            padding: 50px 40px;
            text-align: center;
            position: relative;
        }
        
        .login-header::before {
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
        
        .login-header * {
            position: relative;
            z-index: 1;
        }
        
        .login-header i {
            font-size: 4rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .login-header h2 {
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .login-body {
            padding: 40px;
        }
        
        .form-label {
            font-weight: 600;
            color: #333;
        }
        
        .form-control:focus {
            border-color: #ff6b35;
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.5);
            background: linear-gradient(135deg, #f7931e 0%, #ff6b35 100%);
        }
        
        .registro-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
        }
        
        .registro-link a {
            color: #ff6b35;
            text-decoration: none;
            font-weight: 600;
        }
        
        .registro-link a:hover {
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
        
        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }
        
        .forgot-password a {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .forgot-password a:hover {
            color: #ff6b35;
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
            color: #999;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd;
        }
        
        .divider span {
            padding: 0 15px;
            font-size: 0.9rem;
        }
        
        .remember-me {
            margin-top: 15px;
        }
        
        .remember-me .form-check-input:checked {
            background-color: #ff6b35;
            border-color: #ff6b35;
        }
        
        .welcome-text {
            margin-top: 10px;
            font-size: 0.95rem;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <i class="bi bi-speedometer2"></i>
                <h2>Bienvenido a RentCar</h2>
                <p class="welcome-text mb-0">Inicia sesión para acceder a tu cuenta</p>
            </div>
            
            <div class="login-body">
                <form action="login.php" method="POST">
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="tu@email.com" required>
                        </div>
                    </div>
                    
                    <!-- Contraseña -->
                    <div class="mb-2">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Tu contraseña" required>
                        </div>
                    </div>
                    
                    <!-- Recordarme / Olvidé contraseña -->
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="remember-me">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Recordarme
                                </label>
                            </div>
                        </div>
                        <div class="forgot-password">
                            <a href="#">¿Olvidaste tu contraseña?</a>
                        </div>
                    </div>
                    
                    <!-- Botón de Login -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-login w-100">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                        </button>
                    </div>
                </form>
                
                <!-- Divider -->
                <div class="divider">
                    <span>o</span>
                </div>
                
                <!-- Enlace a Registro -->
                <div class="registro-link">
                    ¿No tienes cuenta? <a href="registro.html">Regístrate aquí</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>