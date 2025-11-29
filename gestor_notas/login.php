<?php
session_start();
require_once ('config.php');


//Verifico si el formulario ha sido enviado
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Aqui preparo la consulta en base al email por eso solo tiene un ?
    $stmt = $mysqli -> prepare("SELECT id, role, nombre, apellidos, foto, email, password FROM Users WHERE email = ?");

    //Compruebao que la preparación a tenido éxito
    if(!$stmt){
        die('Error en la preparación: ' . $mysqli->error);
    }

    //Bindeo los parametros en base a lo que he preparado que es el mail
    $stmt -> bind_param('s', $email);

    //Ejecuto la consulta

    $stmt -> execute();

    //Obtengo resultado 

    $resultado = $stmt ->get_result();

    //Compruebo si se ha encontrado el usuario

    if($resultado->num_rows === 1){
        $usuario = $resultado->fetch_assoc();
    }

    //Verifico la contraseña
    if(password_verify($password, $usuario['password'])){
        //INICIO SESIÓN Y GUARDO LOS DATOS EN SESSION

        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_name'] = $usuario['nombre'];
        $_SESSION['user_email'] = $usuario['email'];
        $_SESSION['user_role'] = $usuario['role'];
        $_SESSION['user_foto'] = $usuario['foto'];


        //Redirijo a panel de admin o al panel del usuario
        if($_SESSION['user_role'] === 'admin'){
            header('Location: admin/admin-dashboard.php');
            exit();
        }if($_SESSION['user_role'] === 'alumno'){
            header('Location: estudiantes/student-dashboard.php');
            exit();
        }
    }else{
        $error = 'Contraseña incorrecta';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestor de Notas UAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            max-width: 450px;
            width: 100%;
        }
        
        .login-card {
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
        
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
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
        <div class="login-container mx-auto">
            <div class="login-card">
                <div class="logo-section">
                    <i class="bi bi-mortarboard-fill logo-icon"></i>
                    <div class="logo-text">UAB</div>
                    <div class="logo-subtitle">Gestor de Notas y Módulos</div>
                </div>
                
                <h4 class="text-center mb-4 fw-bold">Iniciar Sesión</h4>
                
                <?php if(isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
                <?php endif; ?>
                
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email:</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="tu@uab.cat" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Contraseña:</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-login">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Iniciar Sesión
                        </button>
                    </div>
                </form>
                
                <div class="divider">
                    <span>o</span>
                </div>
                
                <div class="text-center">
                    <p class="mb-2 text-muted">¿No tienes cuenta?</p>
                    <a href="registro.php" class="btn btn-outline-primary w-100">
                        <i class="bi bi-person-plus me-2"></i>
                        Registrarse
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
