<?php
session_start();
require_once '../config.php';

if($_SESSION['user_role'] !== 'admin') exit('Sin permiso');

$id = (int) $_GET['id'];

$result = $mysqli->query("SELECT * FROM Users WHERE id = $id");
$user = $result->fetch_assoc();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $role = $_POST['role'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $foto = $_POST['foto'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password_hasheada = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("UPDATE Users SET role=?, nombre=?, apellidos=?, foto=?, email=? WHERE id=?");
    $stmt ->bind_param("sssssi", $role, $nombre, $apellido, $foto, $email, $id);
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
    <title>Editar Usuario - UAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 0;
        }
        
        .edit-container {
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
        
        .form-select:focus {
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
        
        .user-preview {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .preview-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid #667eea;
            object-fit: cover;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="edit-container">
            <div class="header-section">
                <h1 class="header-title">
                    <i class="bi bi-pencil-square me-2"></i>
                    Editar Usuario
                </h1>
            </div>
            
            <div class="user-preview">
                <img src="<?= htmlspecialchars($user['foto']) ?>" alt="Avatar" class="preview-avatar">
                <p class="text-muted mb-0">ID: <?= htmlspecialchars($user['id']) ?></p>
            </div>
            
            <form action="editUsers.php?id=<?= $id ?>" method="POST">
                <div class="mb-3">
                    <label for="role" class="form-label fw-semibold">
                        <i class="bi bi-shield-check me-1"></i>
                        Rol:
                    </label>
                    <select class="form-select" name="role" id="role" required>
                        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="profesor" <?= $user['role'] === 'profesor' ? 'selected' : '' ?>>Profesor</option>
                        <option value="alumno" <?= $user['role'] === 'alumno' ? 'selected' : '' ?>>Alumno</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="nombre" class="form-label fw-semibold">
                        <i class="bi bi-person-fill me-1"></i>
                        Nombre:
                    </label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?= htmlspecialchars($user['nombre']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="apellido" class="form-label fw-semibold">
                        <i class="bi bi-person-fill me-1"></i>
                        Apellido:
                    </label>
                    <input type="text" class="form-control" name="apellido" id="apellido" value="<?= htmlspecialchars($user['apellidos']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="foto" class="form-label fw-semibold">
                        <i class="bi bi-image-fill me-1"></i>
                        URL Foto:
                    </label>
                    <input type="text" class="form-control" name="foto" id="foto" value="<?= htmlspecialchars($user['foto']) ?>" required>
                </div>
                
                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">
                        <i class="bi bi-envelope-fill me-1"></i>
                        Email:
                    </label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-save">
                        <i class="bi bi-save-fill me-2"></i>
                        Guardar Cambios
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