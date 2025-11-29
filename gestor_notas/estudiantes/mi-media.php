<?php
session_start();
require_once '../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'alumno'){
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$nombre = $_SESSION['user_name'];

// Obtener promedio general y todas las notas
$stmt = $mysqli->prepare("
    SELECT 
        AVG(nota) as promedio_general,
        COUNT(*) as total_notas,
        MIN(nota) as nota_minima,
        MAX(nota) as nota_maxima
    FROM Notas 
    WHERE id_usuario = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stats = $stmt->get_result()->fetch_assoc();

// Obtener promedio por módulo
$stmt = $mysqli->prepare("
    SELECT 
        Modulo.nombre AS modulo,
        Modulo.foto,
        AVG(Notas.nota) AS promedio_modulo,
        COUNT(Notas.id) AS total_evaluaciones
    FROM Notas
    INNER JOIN Modulo ON Notas.id_modulo = Modulo.id
    WHERE Notas.id_usuario = ?
    GROUP BY Modulo.id
    ORDER BY promedio_modulo DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$promedios_modulos = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Media - UAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 0;
        }
        
        .media-container {
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
        
        .promedio-principal {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            padding: 50px;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
        }
        
        .promedio-number {
            font-size: 5rem;
            font-weight: bold;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .promedio-label {
            font-size: 1.5rem;
            opacity: 0.95;
        }
        
        .stat-card-small {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
        }
        
        .stat-title {
            color: #667eea;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }
        
        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .table tbody tr:hover {
            background: #f8f9fa;
        }
        
        .promedio-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 1rem;
        }
        
        .module-thumb {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
        }
        
        .section-title {
            color: #667eea;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="student-dashboard.php" class="btn-back">
            <i class="bi bi-arrow-left me-2"></i>
            Volver al Dashboard
        </a>
        
        <div class="media-container">
            <div class="header-section">
                <h1 class="header-title">
                    <i class="bi bi-calculator me-2"></i>
                    Mi Media de Notas
                </h1>
            </div>
            
            <?php if($stats['total_notas'] > 0): ?>
                <!-- Promedio General -->
                <div class="promedio-principal">
                    <div class="promedio-number"><?= number_format($stats['promedio_general'], 2) ?></div>
                    <div class="promedio-label">Promedio General</div>
                </div>
                
                <!-- Estadísticas Generales -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="stat-card-small">
                            <div class="stat-title">
                                <i class="bi bi-journal-text me-1"></i>
                                Total de Evaluaciones
                            </div>
                            <div class="stat-value"><?= $stats['total_notas'] ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card-small">
                            <div class="stat-title">
                                <i class="bi bi-arrow-down-circle me-1"></i>
                                Nota Mínima
                            </div>
                            <div class="stat-value"><?= number_format($stats['nota_minima'], 2) ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card-small">
                            <div class="stat-title">
                                <i class="bi bi-arrow-up-circle me-1"></i>
                                Nota Máxima
                            </div>
                            <div class="stat-value"><?= number_format($stats['nota_maxima'], 2) ?></div>
                        </div>
                    </div>
                </div>
                
                <!-- Promedios por Módulo -->
                <h3 class="section-title">
                    <i class="bi bi-bar-chart-fill me-2"></i>
                    Promedios por Módulo
                </h3>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>MÓDULO</th>
                                <th>IMAGEN</th>
                                <th>PROMEDIO</th>
                                <th>EVALUACIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($promedios_modulos as $pm): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($pm['modulo']) ?></strong></td>
                                <td>
                                    <img src="<?= htmlspecialchars($pm['foto']) ?>" class="module-thumb" alt="Módulo">
                                </td>
                                <td>
                                    <span class="promedio-badge">
                                        <?= number_format($pm['promedio_modulo'], 2) ?>
                                    </span>
                                </td>
                                <td><?= $pm['total_evaluaciones'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>No tienes notas registradas todavía.</strong>
                    <p class="mb-0 mt-2">Cuando tus profesores registren tus calificaciones, podrás ver tus estadísticas aquí.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>