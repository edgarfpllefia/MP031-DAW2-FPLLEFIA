<?php
session_start();
require_once '../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user'){
    header('Location: ../login.php');
    exit();
}

$nombre = $_SESSION['user_name'];
$role = $_SESSION['user_role'];
$email = $_SESSION['user_email'];

$stmt = $mysqli("SELECT a.id,
       v.nombre AS vehiculo,
       v.marca,
       v.modelo,
       a.fecha_inicio,
       a.fecha_fin,
       a.precio_total,
       a.estado
FROM alquileres a
JOIN users u ON a.id_user = u.id
JOIN vehiculos v ON a.id_vehiculo = v.id
WHERE u.email = ?
  AND a.estado = 'completado';");

$stmt ->bind_param("s", $email);
$stmt->execute();
$prepare = $stmt->get_result();
$historial = $prepare->fetch_all(MYSQLI_ASSOC);

?>



<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Reserves - RentCar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f6fa;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            padding: 20px 0;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 0 20px 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-header h3 {
            color: white;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-header h3 i {
            color: #ff6b35;
        }

        .sidebar-header p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.85rem;
            margin: 5px 0 0 0;
        }

        .nav-item {
            list-style: none;
            padding: 0 15px;
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background: rgba(255, 107, 53, 0.1);
            color: #ff6b35;
        }

        .nav-link.active {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
        }

        .nav-link i {
            font-size: 1.2rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 20px;
            min-height: 100vh;
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar h2 {
            margin: 0;
            color: #2c3e50;
            font-weight: 700;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .user-info h5 {
            margin: 0;
            font-size: 0.95rem;
            color: #2c3e50;
        }

        .user-info p {
            margin: 0;
            font-size: 0.8rem;
            color: #7f8c8d;
        }

        /* Content Section */
        .content-section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f5f6fa;
        }

        .section-header h4 {
            margin: 0;
            color: #2c3e50;
            font-weight: 700;
        }

        /* Info Cards */
        .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .info-card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .info-card-icon.total {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .info-card-icon.completat {
            background: linear-gradient(135deg, #56ab2f 0%, #a8e063 100%);
            color: white;
        }

        .info-card-icon.cancelat {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
            color: white;
        }

        .info-card-content h3 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
        }

        .info-card-content p {
            margin: 5px 0 0 0;
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        /* Tables */
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }

        .custom-table {
            margin: 0;
        }

        .custom-table thead {
            background: #f8f9fa;
        }

        .custom-table thead th {
            border: none;
            color: #2c3e50;
            font-weight: 600;
            padding: 15px;
        }

        .custom-table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f5f6fa;
        }

        .custom-table tbody tr:last-child td {
            border-bottom: none;
        }

        .custom-table tbody tr:hover {
            background: #f8f9fa;
        }

        .badge-custom {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-actiu {
            background: #d1ecf1;
            color: #0c5460;
        }

        .badge-completat {
            background: #d4edda;
            color: #155724;
        }

        .badge-cancelat {
            background: #f8d7da;
            color: #721c24;
        }

        /* Vehicle Image */
        .vehicle-img {
            width: 80px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }

        /* Search Bar */
        .search-bar {
            position: relative;
            max-width: 400px;
            margin-bottom: 20px;
        }

        .search-bar input {
            padding-left: 40px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .search-bar i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-260px);
            }

            .main-content {
                margin-left: 0;
            }

            .info-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>
                <i class="bi bi-speedometer2"></i>
                RentCar
            </h3>
            <p>Panel d'Usuari</p>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="userDashboard.php" class="nav-link">
                    <i class="bi bi-house-door"></i>
                    <span>Inici</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="userActivos.php" class="nav-link">
                    <i class="bi bi-calendar-check"></i>
                    <span>Lloguers Actius</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="userDisponibles.php" class="nav-link">
                    <i class="bi bi-car-front"></i>
                    <span>Vehicles Disponibles</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="userHistorial.php" class="nav-link active">
                    <i class="bi bi-clock-history"></i>
                    <span>Historial</span>
                </a>
            </li>
            <li class="nav-item" style="margin-top: 40px;">
                <a href="../logout.php" class="nav-link">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Tancar Sessió</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <h2>Historial de Reserves</h2>
            <div class="user-profile">
                <div class="user-info">
                    <h5>Joan Pérez</h5>
                    <p>Client</p>
                </div>
                <div class="user-avatar">
                    JP
                </div>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="info-cards">
            <div class="info-card">
                <div class="info-card-icon total">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <div class="info-card-content">
                    <h3>4</h3>
                    <p>Total Reserves</p>
                </div>
            </div>
            <div class="info-card">
                <div class="info-card-icon completat">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="info-card-content">
                    <h3>3</h3>
                    <p>Completades</p>
                </div>
            </div>
            <div class="info-card">
                <div class="info-card-icon cancelat">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div class="info-card-content">
                    <h3>1</h3>
                    <p>Cancel·lades</p>
                </div>
            </div>
        </div>

        <!-- Historial Table -->
        <div class="content-section">
            <div class="section-header">
                <h4><i class="bi bi-clock-history me-2"></i>Totes les Meves Reserves</h4>
            </div>

            <!-- Search Bar -->
            <div class="search-bar">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control" placeholder="Cercar per vehicle, marca o dates...">
            </div>
            
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vehicle</th>
                            <th>Marca / Model</th>
                            <th>Data Inici</th>
                            <th>Data Fi</th>
                            <th>Dies</th>
                            <th>Preu Total</th>
                            <th>Estat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($historial as $h):?>
                        <tr>
                            <td>1</td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <img src="<?= $h['foto'] ?>" alt="Tesla Model S" class="vehicle-img">
                                    <strong><?= $h['nombre'] ?></strong>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <strong>Tesla</strong><br>
                                    <small style="color: #7f8c8d;"><?= $h['modelo'] ?></small>
                                </div>
                            </td>
                            <td><?= $h['fecha_inicio'] ?></td>
                            <td><?= $h['fecha_fin'] ?></td>
                            <td>3 dies</td>
                            <td><strong style="color: #ff6b35;"><?= $h['precio_dia'] ?></strong></td>
                            <td><span class="badge-custom badge-actiu"><?= $h['estado'] ?></span></td>
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