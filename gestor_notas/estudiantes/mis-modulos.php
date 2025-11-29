<?php
session_start();
require_once '../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'alumno'){
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Obtener todos los módulos del estudiante
$stmt = $mysqli->prepare("
    SELECT DISTINCT
        Modulo.id,
        Modulo.nombre,
        Modulo.foto
    FROM Notas
    INNER JOIN Modulo ON Notas.id_modulo = Modulo.id
    WHERE Notas.id_usuario = ?
    ORDER BY Modulo.nombre ASC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$modulos = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Módulos - UAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 0;
        }
        
        .modulos-container {
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
        
        .total-modulos {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 30px;
            border-left: 4px solid #667eea;
        }
        
        .total-modulos strong {
            color: #667eea;
        }
        
        .module-card {
            background: white;
            border: 2px solid #667eea;
            border-radius: 15px;
            padding: 0;
            margin-bottom: 25px;
            transition: all 0.3s ease;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .module-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        
        .module-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .module-body {
            padding: 20px;
        }
        
        .module-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
        .module-id {
            color: #667eea;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .module-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="student-dashboard.php" class="btn-back">
            <i class="bi bi-arrow-left me-2"></i>
            Volver al Dashboard
        </a>
        
        <div class="modulos-container">
            <div class="header-section">
                <h1 class="header-title">
                    <i class="bi bi-book-fill me-2"></i>
                    Mis Módulos
                </h1>
            </div>
            
            <div class="total-modulos">
                <i class="bi bi-info-circle-fill me-2"></i>
                <strong>Total de módulos matriculados:</strong> <?= count($modulos) ?>
            </div>
            
            <?php if(count($modulos) > 0): ?>
                <div class="row">
                    <?php foreach($modulos as $modulo): ?>
                    <div class="col-md-4">
                        <div class="module-card">
                            <img src="<?= htmlspecialchars($modulo['foto']) ?>" class="module-img" alt="<?= htmlspecialchars($modulo['nombre']) ?>">
                            <div class="module-body">
                                <div class="module-title"><?= htmlspecialchars($modulo['nombre']) ?></div>
                                <div class="module-id">
                                    <i class="bi bi-hash"></i>
                                    ID: <?= htmlspecialchars($modulo['id']) ?>
                                </div>
                                <span class="module-badge">
                                    <i class="bi bi-bookmark-fill me-1"></i>
                                    Matriculado
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>No estás matriculado en ningún módulo todavía.</strong>
                    <p class="mb-0 mt-2">Contacta con tu coordinador académico para matricularte en los módulos de tu programa.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
