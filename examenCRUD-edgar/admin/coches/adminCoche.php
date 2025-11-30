<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestió de Vehicles - RentCar Admin</title>
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
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
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

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
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

        /* Vehicle Image */
        .vehicle-img {
            width: 60px;
            height: 40px;
            border-radius: 6px;
            object-fit: cover;
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

        /* Form Styles */
        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #ff6b35;
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
        }

        /* Modal Custom */
        .modal-header {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            border-radius: 12px 12px 0 0;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-content {
            border-radius: 12px;
            border: none;
        }

        .btn-secondary-custom {
            background: #6c757d;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
        }

        /* Preview Image */
        .image-preview {
            width: 100%;
            max-width: 300px;
            height: 200px;
            border: 2px dashed #ddd;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
            overflow: hidden;
            background: #f8f9fa;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-preview-placeholder {
            color: #adb5bd;
            text-align: center;
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
                <a href="../adminDashboard.php" class="nav-link">
                    <i class="bi bi-house-door"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../coches/adminCoche.php" class="nav-link active">
                    <i class="bi bi-car-front"></i>
                    <span>Vehicles</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../usuarios/adminUsuario.php" class="nav-link">
                    <i class="bi bi-people"></i>
                    <span>Clients</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../alquiler/adminAlquiler.php" class="nav-link">
                    <i class="bi bi-calendar-check"></i>
                    <span>Lloguers</span>
                </a>
            </li>
            <li class="nav-item" style="margin-top: 40px;">
                <a href="../../logout.php" class="nav-link">
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
            <h2>Gestió de Vehicles</h2>
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

        <!-- Vehicles Table -->
        <div class="content-section">
            <div class="section-header">
                <h4><i class="bi bi-car-front me-2"></i>Llista de Vehicles</h4>
                <a href="addCoche.php"><button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addVehicleModal">
                    <i class="bi bi-plus-lg me-2"></i>Afegir Vehicle
                </button></a>
            </div>
            
            <div class="mb-3 search-bar">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control" placeholder="Cercar vehicle...">
            </div>

            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imatge</th>
                            <th>Marca</th>
                            <th>Model</th>
                            <th>Matrícula</th>
                            <th>Any</th>
                            <th>Color</th>
                            <th>Preu/Dia</th>
                            <th>Estat</th>
                            <th>Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#V001</td>
                            <td><img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=200" alt="Tesla" class="vehicle-img"></td>
                            <td>Tesla</td>
                            <td>Model S</td>
                            <td>ABC-1234</td>
                            <td>2023</td>
                            <td>Negre</td>
                            <td>120€</td>
                            <td><span class="badge-custom badge-success">Disponible</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="editCoche.php?id="><button class="btn-action btn-edit">
                                        <i class="bi bi-pencil"></i>
                                    </button></a>
                                    <a href="deleteCoche.php?id="><button class="btn-action btn-delete" >
                                        <i class="bi bi-trash"></i>
                                    </button></a>
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