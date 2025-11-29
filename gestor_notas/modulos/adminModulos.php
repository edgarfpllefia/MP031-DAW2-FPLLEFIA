<?php
session_start();
require_once '../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../login.php');
    exit();
}

$result = $mysqli->query("SELECT id, nombre, foto FROM Modulo ORDER BY id ASC");
$modulos = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin Módulos - UAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 0;
        }
        
        .admin-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
            margin: 0 auto;
        }
        
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #667eea;
        }
        
        .header-title {
            margin: 0;
            color: #333;
            font-weight: bold;
        }
        
        .btn-add {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
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
        
        .module-thumb {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #667eea;
        }
        
        .btn-action {
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.2s ease;
            display: inline-block;
            margin: 0 3px;
        }
        
        .btn-edit {
            background: #0dcaf0;
            color: white;
        }
        
        .btn-edit:hover {
            background: #0aa2c0;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        
        .btn-delete:hover {
            background: #bb2d3b;
            color: white;
            transform: translateY(-2px);
        }
        
        .total-modules {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }
        
        .total-modules strong {
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="../admin/admin-dashboard.php" class="btn-back">
            <i class="bi bi-arrow-left me-2"></i>
            Volver al Dashboard
        </a>
        
        <div class="admin-container">
            <div class="header-section">
                <h1 class="header-title">
                    <i class="bi bi-book-fill me-2"></i>
                    Gestionar Módulos
                </h1>
                <a href="addModulos.php" class="btn-add">
                    <i class="bi bi-plus-circle-fill me-2"></i>
                    Agregar Módulo
                </a>
            </div>
            
            <div class="total-modules">
                <i class="bi bi-info-circle-fill me-2"></i>
                <strong>Total de módulos:</strong> <?= count($modulos) ?>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>FOTO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($modulos as $modulo): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($modulo['id']) ?></strong></td>
                                <td><?= htmlspecialchars($modulo['nombre']) ?></td>
                                <td>
                                    <img src="<?= htmlspecialchars($modulo['foto']) ?>" alt="Módulo" class="module-thumb">
                                </td>
                                <td>
                                    <a href="editModulos.php?id=<?= $modulo['id'] ?>" class="btn-action btn-edit">
                                        <i class="bi bi-pencil-fill"></i> Editar
                                    </a>
                                    <a href="deleteModulos.php?id=<?= $modulo['id'] ?>" class="btn-action btn-delete">
                                        <i class="bi bi-trash-fill"></i> Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>