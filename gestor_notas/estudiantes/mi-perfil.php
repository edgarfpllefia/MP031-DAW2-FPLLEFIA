<?php
session_start();
require_once '../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'alumno'){
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$mensaje = '';
$tipo_mensaje = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $foto = $_POST['foto'];
    $password = $_POST['password'];
    
    if(!empty($password)){
        $password_hasheada = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("UPDATE Users SET nombre=?, apellidos=?, email=?, foto=?, password=? WHERE id=?");
        $stmt->bind_param("sssssi", $nombre, $apellidos, $email, $foto, $password_hasheada, $user_id);
    } else {
        $stmt = $mysqli->prepare("UPDATE Users SET nombre=?, apellidos=?, email=?, foto=? WHERE id=?");
        $stmt->bind_param("ssssi", $nombre, $apellidos, $email, $foto, $user_id);
    }
    
    if($stmt->execute()){

        $_SESSION['user_name'] = $nombre;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_foto'] = $foto;
        
        $mensaje = "Perfil actualizado correctamente.";
        $tipo_mensaje = "success";
    } else {
        $mensaje = "Error al actualizar el perfil.";
        $tipo_mensaje = "danger";
    }
}

$stmt = $mysqli->prepare("SELECT * FROM Users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - UAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 0;
        }
        
        .perfil-container {
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
        
        .btn-back {
            background: white;
            border: 2px solid #667eea;
            padding: 10px 20px;
            border-radius: 10px;
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .btn-back:hover {
            background: #667eea;
            color: white;
        }
        
        .avatar-section {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .avatar-large {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid #667eea;
            object-fit: cover;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        
        .role-badge {
            display: inline-block;
            background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-save {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .section-title {
            color: #667eea;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }
        
        .info-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
            margin-bottom: 20px;
        }
        
        .info-label {
            font-weight: 600;
            color: #667eea;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="student-dashboard.php" class="btn-back">
            <i class="bi bi-arrow-left me-2"></i>
            Volver al Dashboard
        </a>
        
        <div class="perfil-container">
            <div class="header-section">
                <h1 class="header-title">
                    <i class="bi bi-person-badge-fill me-2"></i>
                    Mi Perfil
                </h1>
            </div>
            
            <?php if($mensaje): ?>
                <div class="alert alert-<?= $tipo_mensaje ?> alert-dismissible fade show" role="alert">
                    <i class="bi bi-<?= $tipo_mensaje === 'success' ? 'check-circle' : 'exclamation-triangle' ?>-fill me-2"></i>
                    <?= htmlspecialchars($mensaje) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <div class="avatar-section">
                <img src="<?= htmlspecialchars($usuario['foto']) ?>" alt="Avatar" class="avatar-large" id="preview-avatar">
                <h2><?= htmlspecialchars($usuario['nombre']) ?> <?= htmlspecialchars($usuario['apellidos']) ?></h2>
                <span class="role-badge">
                    <i class="bi bi-mortarboard-fill me-1"></i>
                    <?= strtoupper(htmlspecialchars($usuario['role'])) ?>
                </span>
            </div>
            
            <div class="info-box">
                <div class="info-label">
                    <i class="bi bi-key-fill me-2"></i>ID de Usuario
                </div>
                <div><?= htmlspecialchars($usuario['id']) ?></div>
            </div>
            

            <h3 class="section-title">
                <i class="bi bi-pencil-square me-2"></i>
                Editar Información
            </h3>
            
            <form method="POST" action="mi-perfil.php">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label fw-semibold">
                            <i class="bi bi-person-fill me-1"></i>Nombre:
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="nombre" 
                               name="nombre" 
                               value="<?= htmlspecialchars($usuario['nombre']) ?>" 
                               required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="apellidos" class="form-label fw-semibold">
                            <i class="bi bi-person-fill me-1"></i>Apellidos:
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="apellidos" 
                               name="apellidos" 
                               value="<?= htmlspecialchars($usuario['apellidos']) ?>" 
                               required>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label for="email" class="form-label fw-semibold">
                            <i class="bi bi-envelope-fill me-1"></i>Email:
                        </label>
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email" 
                               value="<?= htmlspecialchars($usuario['email']) ?>" 
                               required>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label for="foto" class="form-label fw-semibold">
                            <i class="bi bi-image-fill me-1"></i>URL de Foto:
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="foto" 
                               name="foto" 
                               value="<?= htmlspecialchars($usuario['foto']) ?>" 
                               oninput="document.getElementById('preview-avatar').src = this.value"
                               required>
                        <small class="text-muted">La foto se actualizará en tiempo real arriba</small>
                    </div>
                    
                    <div class="col-md-12 mb-4">
                        <label for="password" class="form-label fw-semibold">
                            <i class="bi bi-lock-fill me-1"></i>Nueva Contraseña:
                        </label>
                        <input type="password" 
                               class="form-control" 
                               id="password" 
                               name="password" 
                               placeholder="Dejar vacío si no deseas cambiarla">
                        <small class="text-muted">Solo completa este campo si quieres cambiar tu contraseña</small>
                    </div>
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-save">
                        <i class="bi bi-save-fill me-2"></i>
                        Guardar Cambios
                    </button>
                </div>
            </form>
            
           
            <div class="alert alert-info mt-4">
                <i class="bi bi-info-circle-fill me-2"></i>
                <strong>Nota:</strong> Los cambios se aplicarán inmediatamente. Asegúrate de que la información sea correcta antes de guardar.
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>