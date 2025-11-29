<?php
session_start();
require_once '../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'alumno'){
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

//Pillo todas las notas del estudiante con información de los modulos
$stmt = $mysqli->prepare("
    SELECT 
        Notas.id,
        Notas.nota,
        Modulo.nombre AS modulo,
        Modulo.foto AS modulo_foto
    FROM Notas
    INNER JOIN Modulo ON Notas.id_modulo = Modulo.id
    WHERE Notas.id_usuario = ?
    ORDER BY Modulo.nombre ASC
");

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$notas = $result->fetch_all(MYSQLI_ASSOC);

//Volverme a mirar esto (Lo he hecho con el chat)
$promedio = 0;
if(count($notas) > 0){
    $suma = array_sum(array_column($notas, 'nota'));
    $promedio = $suma / count($notas);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Notas - UAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 0;
        }
        
        .notas-container {
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
        
        .promedio-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .promedio-number {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .promedio-label {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .table {
            margin: 0;
        }
        
        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
        }
        
        .table tbody tr {
            transition: all 0.2s ease;
        }
        
        .table tbody tr:hover {
            background: #f8f9fa;
            transform: scale(1.01);
        }
        
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }
        
        .nota-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 1.1rem;
            display: inline-block;
        }
        
        .module-thumb {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #667eea;
        }
        
        .total-notas {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }
        
        .total-notas strong {
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="student-dashboard.php" class="btn-back">
            <i class="bi bi-arrow-left me-2"></i>
            Volver al Dashboard
        </a>
        
        <div class="notas-container">
            <div class="header-section">
                <h1 class="header-title">
                    <i class="bi bi-journal-text me-2"></i>
                    Mis Notas
                </h1>
            </div>
            
            <div class="promedio-card">
                <div class="promedio-number"><?= count($notas) > 0 ? number_format($promedio, 2) : 'N/A' ?></div>
                <div class="promedio-label">Promedio General</div>
            </div>
            
            <div class="total-notas">
                <i class="bi bi-info-circle-fill me-2"></i>
                <strong>Total de calificaciones:</strong> <?= count($notas) ?>
            </div>
            
            <?php if(count($notas) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>MÓDULO</th>
                                <th>IMAGEN</th>
                                <th>NOTA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($notas as $nota): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($nota['modulo']) ?></strong></td>
                                <td>
                                    <img src="<?= htmlspecialchars($nota['modulo_foto']) ?>" alt="Módulo" class="module-thumb">
                                </td>
                                <td>
                                    <span class="nota-badge">
                                        <?= htmlspecialchars($nota['nota']) ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>No tienes notas registradas todavía.</strong>
                    <p class="mb-0 mt-2">Cuando tus profesores registren tus calificaciones, aparecerán aquí.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>