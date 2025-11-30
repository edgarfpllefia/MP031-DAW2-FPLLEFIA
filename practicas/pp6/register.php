<?php
require_once ('theme/config.php');
session_start();

// Verificar si el formulario ha sido enviado
if($_SERVER['REQUEST_METHOD'] === 'POST' ){
    //1. RECOGER LOS DATOS DEL FORM
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $foto = $_POST['foto'];
    $rol = 'user'; // Rol por defecto

    //2. Hasheamos la contraseña
    $password_hasheada = password_hash($password, PASSWORD_DEFAULT);

    //3. Preparamos la consulta para insertar el nuevo usuario
    $stmt = $mysqli->prepare("
        INSERT INTO users (role, name, surname, password, email, register_date, photo)
        VALUES (?, ?, ?, ?, ?, NOW(), ?)
    ");

    //4. Comprobar que la preparación tuvo exito
    if(!$stmt){
        die('Error en la preparación: ' . $mysqli->error);
    }

    //5. Bindeamos los parametros
    $stmt->bind_param('ssssss', $rol, $name, $surname, $password_hasheada, $email, $foto);

    //6. Ejecutamos la consulta
    if($stmt->execute()){
        echo 'Usuario registrado correctamente. <a href="login.php">Iniciar sesión</a>';
    }else{
        echo 'Error al registrar el usuario: ' . $stmt->error;
    }

    //7. Cerramos conexión
    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Motero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 2rem 0;
        }

        /* ===== CAMBIA AQUÍ LA URL DE TU IMAGEN ===== */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://images.unsplash.com/photo-1558981806-ec527fa84c39?q=80&w=2070');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(8px) brightness(0.4);
            transform: scale(1.1);
            z-index: -2;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .register-container {
            max-width: 480px;
            width: 90%;
            position: relative;
            z-index: 1;
        }

        .card {
            background: rgba(30, 30, 30, 0.95);
            border: 1px solid rgba(255, 94, 0, 0.2);
            border-radius: 8px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .card-header {
            background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
            border: none;
            padding: 2rem 1.5rem 1.5rem;
            text-align: center;
            position: relative;
        }

        .brand-logo {
            font-size: 2.5rem;
            color: white;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .brand-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: 2px;
            margin: 0;
            text-transform: uppercase;
        }

        .brand-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.85rem;
            margin-top: 0.3rem;
            letter-spacing: 1px;
        }

        .card-body {
            padding: 2rem 1.5rem;
        }

        .form-label {
            color: #e0e0e0;
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #ff5e00;
            box-shadow: 0 0 0 3px rgba(255, 94, 0, 0.1);
            color: white;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #ff5e00;
            border-right: none;
        }

        .input-group .form-control {
            border-left: none;
        }

        .input-group:focus-within .input-group-text {
            border-color: #ff5e00;
            background: rgba(255, 94, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 94, 0, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 94, 0, 0.4);
            background: linear-gradient(135deg, #ff6a0d 0%, #e05500 100%);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .link-text {
            color: #ff5e00;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .link-text:hover {
            color: #ff7a2e;
            text-decoration: underline;
        }

        .footer-text {
            color: #888;
            font-size: 0.85rem;
            text-align: center;
            margin-top: 1.5rem;
        }

        .row {
            margin-left: 0;
            margin-right: 0;
        }

        @media (max-width: 576px) {
            .register-container {
                width: 95%;
            }
            
            .card-body {
                padding: 1.5rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="card">
            <div class="card-header">
                <div class="brand-logo">
                    <i class="fas fa-motorcycle"></i>
                </div>
                <h1 class="brand-title">Rider Zone</h1>
                <p class="brand-subtitle">Únete a la comunidad</p>
            </div>
            <div class="card-body">
                <form action="register.php" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" class="form-control" name="name" id="name" 
                                       placeholder="Tu nombre" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="surname" class="form-label">Apellido</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" class="form-control" name="surname" id="surname" 
                                       placeholder="Tu apellido" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control" name="email" id="email" 
                                   placeholder="tu@email.com" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control" name="password" id="password" 
                                   placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">URL Foto de perfil</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-image"></i>
                            </span>
                            <input type="text" class="form-control" name="foto" id="foto" 
                                   placeholder="https://..." required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        <i class="fas fa-user-plus me-2"></i>Registrarse
                    </button>

                    <div class="footer-text">
                        ¿Ya tienes cuenta? <a href="login.php" class="link-text">Inicia sesión</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>