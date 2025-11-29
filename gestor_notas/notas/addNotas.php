<?php
session_start();
require_once '../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../login.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nota = $_POST['nota'];
    $id_usuario = $_POST['id_usuario'];
    $id_modulo = $_POST['id_modulo'];

    $stmt = $mysqli->prepare("INSERT INTO Notas (nota, id_usuario, id_modulo) VALUES(?, ?, ?)");

    $stmt->bind_param("dii", $nota, $id_usuario, $id_modulo);
    $stmt->execute();

    header('Location: adminNotas.php');
    exit();
}

// Obtener lista de usuarios y módulos para los selectores
$usuarios = $mysqli->query("SELECT id, nombre, apellidos FROM Users WHERE role = 'alumno' ORDER BY nombre ASC");
$modulos = $mysqli->query("SELECT id, nombre FROM Modulo ORDER BY nombre ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nota - UAB</title>
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
        
        .form-control:focus, .form-select:focus {
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
                    <i class="bi bi-plus-circle-fill me-2"></i>
                    Agregar Nota
                </h1>
            </div>
            
            <form action="addNotas.php" method="POST">
                <div class="mb-3">
                    <label for="id_usuario" class="form-label fw-semibold">
                        <i class="bi bi-person-fill me-1"></i>
                        Alumno:
                    </label>
                    <select class="form-select" name="id_usuario" id="id_usuario" required>
                        <option value="">Selecciona un alumno</option>
                        <?php while($usuario = $usuarios->fetch_assoc()): ?>
                            <option value="<?= $usuario['id'] ?>">
                                <?= htmlspecialchars($usuario['nombre']) ?> 
                                <?= htmlspecialchars($usuario['apellidos']) ?>
                                (ID: <?= $usuario['id'] ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="id_modulo" class="form-label fw-semibold">
                        <i class="bi bi-book-fill me-1"></i>
                        Módulo:
                    </label>
                    <select class="form-select" name="id_modulo" id="id_modulo" required>
                        <option value="">Selecciona un módulo</option>
                        <?php while($modulo = $modulos->fetch_assoc()): ?>
                            <option value="<?= $modulo['id'] ?>">
                                <?= htmlspecialchars($modulo['nombre']) ?>
                                (ID: <?= $modulo['id'] ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="nota" class="form-label fw-semibold">
                        <i class="bi bi-star-fill me-1"></i>
                        Nota:
                    </label>
                    <input type="number" 
                           class="form-control" 
                           step="0.01" 
                           name="nota" 
                           id="nota" 
                           min="0" 
                           max="10" 
                           placeholder="Ej: 8.50" 
                           required>
                    <small class="text-muted">Introduce una nota entre 0 y 10</small>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-save">
                        <i class="bi bi-save-fill me-2"></i>
                        Crear Nota
                    </button>
                    <a href="adminNotas.php" class="btn btn-back">
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