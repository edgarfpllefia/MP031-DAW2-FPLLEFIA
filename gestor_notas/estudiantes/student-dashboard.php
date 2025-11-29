<?php
session_start();
require_once '../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'alumno'){
    header('Location: ../login.php');
    exit();
}

$nombre = $_SESSION['user_name'];
$apellidos = $_SESSION['user_apellidos'] ?? '';
$img = $_SESSION['user_foto'];
$email = $_SESSION['user_email'];
$user_id = $_SESSION['user_id'];
$role = $_SESSION['user_role'];

// Obtener estadísticas
$stmt = $mysqli->prepare("SELECT AVG(nota) as promedio, COUNT(*) as total_notas FROM Notas WHERE id_usuario = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stats = $stmt->get_result()->fetch_assoc();

// Total de módulos
$stmt = $mysqli->prepare("SELECT COUNT(DISTINCT id_modulo) as total_modulos FROM Notas WHERE id_usuario = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$modulos_stats = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Estudiante - UAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .dashboard-container {
            padding: 40px 20px;
        }
        
        .welcome-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
            margin-bottom: 30px;
        }
        
        .avatar-section {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid #667eea;
            object-fit: cover;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .role-badge {
            display: inline-block;
            background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-top: 10px;
        }
        
        .menu-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            padding: 30px;
            margin-bottom: 20px;
        }
        
        .menu-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }
        
        .menu-btn {
            display: block;
            width: 100%;
            padding: 15px 20px;
            margin-bottom: 15px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            text-align: left;
        }
        
        .menu-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .menu-btn i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .logout-btn {
            background: #dc3545;
        }
        
        .logout-btn:hover {
            background: #c82333;
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
        }
        
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            height: 100%;
        }
        
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        <div class="welcome-card">
            <div class="avatar-section">
                <img src="<?= htmlspecialchars($img) ?>" alt="Avatar" class="avatar">
                <h1 class="mt-3 mb-2">Bienvenido/a, <?= htmlspecialchars($nombre) ?></h1>
                <span class="role-badge">
                    <i class="bi bi-mortarboard-fill me-1"></i>
                    ESTUDIANTE
                </span>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <div class="stat-card">
                        <i class="bi bi-star-fill stat-icon"></i>
                        <div class="stat-number"><?= $stats['promedio'] ? number_format($stats['promedio'], 2) : 'N/A' ?></div>
                        <div class="stat-label">Promedio General</div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stat-card">
                        <i class="bi bi-journal-text stat-icon"></i>
                        <div class="stat-number"><?= $stats['total_notas'] ?></div>
                        <div class="stat-label">Total de Notas</div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stat-card">
                        <i class="bi bi-book-fill stat-icon"></i>
                        <div class="stat-number"><?= $modulos_stats['total_modulos'] ?></div>
                        <div class="stat-label">Módulos Cursados</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="menu-card">
                    <h2 class="menu-title">
                        <i class="bi bi-person-circle me-2"></i>
                        Mi Información Académica
                    </h2>
                    <a href="mis-notas.php" class="menu-btn">
                        <i class="bi bi-journal-text"></i>
                        Mis Notas
                    </a>
                    <a href="mis-modulos.php" class="menu-btn">
                        <i class="bi bi-book-fill"></i>
                        Mis Módulos
                    </a>
                    <a href="mi-media.php" class="menu-btn">
                        <i class="bi bi-calculator"></i>
                        Media de Notas
                    </a>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4">
                <div class="menu-card">
                    <h2 class="menu-title">
                        <i class="bi bi-gear-fill me-2"></i>
                        Mi Cuenta
                    </h2>
                    <a href="mi-perfil.php" class="menu-btn">
                        <i class="bi bi-person-badge-fill"></i>
                        Mi Perfil
                    </a>
                </div>
                
                <div class="menu-card mt-4">
                    <h2 class="menu-title">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Sesión
                    </h2>
                    <a href="../logout.php" class="menu-btn logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
