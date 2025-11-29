<?php
session_start();
require_once '../config.php';

if($_SESSION['user_role'] !== 'admin') exit('Sin permiso');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $foto = $_POST['foto'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password_hasheada = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO Users (role, nombre, apellidos, foto, email, password) VALUES ('alumno', ?, ?, ?, ?, ?)");

    $stmt->bind_param('sssss', $nombre, $apellido, $foto, $email, $password_hasheada);
    $stmt->execute();

    header('Location: adminUsers.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario - UAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 0;
        }
        
        .add-container {
            max-width: 600px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
            margin: 0 auto;
        }
        
        .header-section {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #667eea;
        }
        
        .header-title {
            margin: 0;
            color: #333;
            font-weight: bold;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-save {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-back {
            background: white;
            border: 2px solid #667eea;
            color: #667eea;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-back:hover {
            background: #667eea;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="add-container">
            <div class="header-section">
                <h1 class="header-title">
                    <i class="bi bi-person-plus-fill me-2"></i>
                    Agregar Usuario
                </h1>
            </div>
            
            <form action="addUsers.php" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label fw-semibold">
                        <i class="bi bi-person-fill me-1"></i>
                        Nombre:
                    </label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre" required>
                </div>
                
                <div class="mb-3">
                    <label for="apellido" class="form-label fw-semibold">
                        <i class="bi bi-person-fill me-1"></i>
                        Apellidos:
                    </label>
                    <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingresa los apellidos" required>
                </div>
                
                <div class="mb-3">
                    <label for="foto" class="form-label fw-semibold">
                        <i class="bi bi-image-fill me-1"></i>
                        URL Foto:
                    </label>
                    <input type="text" class="form-control" name="foto" id="foto" placeholder="https://ejemplo.com/foto.jpg" required>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">
                        <i class="bi bi-envelope-fill me-1"></i>
                        Email:
                    </label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="usuario@uab.cat" required>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">
                        <i class="bi bi-lock-fill me-1"></i>
                        Contraseña:
                    </label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="••••••••" required>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-save">
                        <i class="bi bi-save-fill me-2"></i>
                        Crear Usuario
                    </button>
                    <a href="adminUsers.php" class="btn btn-back">
                        <i class="bi bi-arrow-left me-2"></i>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>