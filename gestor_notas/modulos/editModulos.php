<?php
session_start();
require_once '../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../login.php');
    exit();
}

$id = (int) $_GET['id'];

$result = $mysqli->query("SELECT * FROM Modulo WHERE id = $id");
$modulo = $result->fetch_assoc();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $nombre = $_POST['nombre'];
    $foto = $_POST['foto'];

    $stmt = $mysqli->prepare("UPDATE Modulo SET nombre=?, foto=? WHERE id = ?");
    $stmt -> bind_param('ssi', $nombre, $foto, $id);
    $stmt -> execute();

    header('Location: adminModulos.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Módulo - UAB</title>
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
        
        .module-preview {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .preview-image {
            width: 150px;
            height: 150px;
            border-radius: 10px;
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
                    Editar Módulo
                </h1>
            </div>
            
            <div class="module-preview">
                <img src="<?= htmlspecialchars($modulo['foto']) ?>" alt="Módulo" class="preview-image">
                <p class="text-muted mb-0">ID: <?= htmlspecialchars($modulo['id']) ?></p>
            </div>
            
            <form action="editModulos.php?id=<?= $id ?>" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label fw-semibold">
                        <i class="bi bi-book-fill me-1"></i>
                        Nombre del Módulo:
                    </label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?= htmlspecialchars($modulo['nombre']) ?>" required>
                </div>
                
                <div class="mb-4">
                    <label for="foto" class="form-label fw-semibold">
                        <i class="bi bi-image-fill me-1"></i>
                        URL Foto:
                    </label>
                    <input type="text" class="form-control" name="foto" id="foto" value="<?= htmlspecialchars($modulo['foto']) ?>" required>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-save">
                        <i class="bi bi-save-fill me-2"></i>
                        Guardar Cambios
                    </button>
                    <a href="adminModulos.php" class="btn btn-back">
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