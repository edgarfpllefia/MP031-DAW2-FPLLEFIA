<?php
session_start();
$name = $_SESSION['user_name'];
$role = $_SESSION['user_role'];
$img = $_SESSION['user_foto'];

if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'){
    // Todo okey
}else{
    header('Location:index.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - UAB</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        
        .stats-row {
            margin-top: 20px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
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
                <h1 class="mt-3 mb-2">Bienvenido, <?= htmlspecialchars($name) ?></h1>
                <span class="role-badge">
                    <i class="bi bi-shield-check me-1"></i>
                    <?= strtoupper(htmlspecialchars($role)) ?>
                </span>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="menu-card">
                    <h2 class="menu-title">
                        <i class="bi bi-gear-fill me-2"></i>
                        Gestión
                    </h2>
                    <a href="../users/adminUsers.php" class="menu-btn">
                        <i class="bi bi-people-fill"></i>
                        Usuarios
                    </a>
                    <a href="../modulos/adminModulos.php" class="menu-btn">
                        <i class="bi bi-book-fill"></i>
                        Módulos
                    </a>
                    <a href="../notas/adminNotas.php" class="menu-btn">
                        <i class="bi bi-journal-text"></i>
                        Notas
                    </a>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4">
                <div class="menu-card">
                    <h2 class="menu-title">
                        <i class="bi bi-bar-chart-fill me-2"></i>
                        Consultas y Reportes
                    </h2>
                    <a href="../consultas/consultas.php" class="menu-btn">
                        <i class="bi bi-file-bar-graph-fill"></i>
                        Ver Consultas
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