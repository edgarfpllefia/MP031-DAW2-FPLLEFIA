<?php
session_start();
require_once '../../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../login.php');
}

$nombre = $_SESSION['user_name'];
$role = $_SESSION['user_role'];

$stmt = $mysqli->query('SELECT * FROM users ORDER BY id ASC');




?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestió de Clients - RentCar Admin</title>
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

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-avatar {
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

        .admin-info h5 {
            margin: 0;
            font-size: 0.95rem;
            color: #2c3e50;
        }

        .admin-info p {
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

        .btn-primary-custom {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
            color: white;
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

        .badge-admin {
            background: #f093fb;
            color: #6a0080;
        }

        .badge-client {
            background: #d1ecf1;
            color: #0c5460;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-edit {
            background: #e3f2fd;
            color: #1976d2;
        }

        .btn-edit:hover {
            background: #1976d2;
            color: white;
        }

        .btn-delete {
            background: #ffebee;
            color: #c62828;
        }

        .btn-delete:hover {
            background: #c62828;
            color: white;
        }

        /* Search Bar */
        .search-bar {
            position: relative;
            max-width: 300px;
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
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>
                <i class="bi bi-speedometer2"></i>
                RentCar Admin
            </h3>
            <p>Panel de Administració</p>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="dashboard-admin.html" class="nav-link">
                    <i class="bi bi-house-door"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="gestio-vehicles.html" class="nav-link">
                    <i class="bi bi-car-front"></i>
                    <span>Vehicles</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="bi bi-people"></i>
                    <span>Clients</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-calendar-check"></i>
                    <span>Lloguers</span>
                </a>
            </li>
            <li class="nav-item" style="margin-top: 40px;">
                <a href="login.html" class="nav-link">
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
            <h2>Gestió de Clients</h2>
            <div class="admin-profile">
                <div class="admin-info">
                    <h5>Admin User</h5>
                    <p>Administrador</p>
                </div>
                <div class="admin-avatar">
                    <i class="bi bi-person"></i>
                </div>
            </div>
        </div>

        <!-- Clients Table -->
        <div class="content-section">
            <div class="section-header">
                <h4><i class="bi bi-people me-2"></i>Llista de Clients</h4>
                <a href="afegir-client.html" class="btn btn-primary-custom">
                    <i class="bi bi-plus-lg me-2"></i>Afegir Client
                </a>
            </div>
            
            <div class="mb-3 search-bar">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control" placeholder="Cercar client...">
            </div>

            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Cognom</th>
                            <th>Email</th>
                            <th>Direcció</th>
                            <th>Role</th>
                            <th>Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Joan</td>
                            <td>Pérez García</td>
                            <td>joan.perez@email.com</td>
                            <td>Carrer Major, 123, Barcelona</td>
                            <td><span class="badge-custom badge-client">Client</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="editar-client.html?id=1" class="btn-action btn-edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn-action btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Maria</td>
                            <td>García López</td>
                            <td>maria.garcia@email.com</td>
                            <td>Avinguda Diagonal, 456, Barcelona</td>
                            <td><span class="badge-custom badge-admin">Admin</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="editar-client.html?id=2" class="btn-action btn-edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn-action btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Carles</td>
                            <td>López Martínez</td>
                            <td>carles.lopez@email.com</td>
                            <td>Plaça Catalunya, 78, Barcelona</td>
                            <td><span class="badge-custom badge-client">Client</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="editar-client.html?id=3" class="btn-action btn-edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn-action btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Laura</td>
                            <td>Fernández Ruiz</td>
                            <td>laura.fernandez@email.com</td>
                            <td>Carrer Aragó, 234, Barcelona</td>
                            <td><span class="badge-custom badge-client">Client</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="editar-client.html?id=4" class="btn-action btn-edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn-action btn-delete" onclick="confirmarEliminar(4)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Marc</td>
                            <td>Sánchez Vila</td>
                            <td>marc.sanchez@email.com</td>
                            <td>Passeig de Gràcia, 89, Barcelona</td>
                            <td><span class="badge-custom badge-client">Client</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="editar-client.html?id=5" class="btn-action btn-edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn-action btn-delete" onclick="confirmarEliminar(5)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>