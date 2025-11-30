<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - RentCar</title>
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

        /* Stats Cards */
        .menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .menu-card {
            background: white;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
            cursor: pointer;
        }

        .menu-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .menu-icon {
            width: 80px;
            height: 80px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
        }

        .menu-icon.vehiculos {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
        }

        .menu-icon.usuarios {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .menu-icon.reservas {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .menu-info {
            text-align: center;
        }

        .menu-info h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
        }

        .menu-info p {
            margin: 8px 0 0 0;
            color: #7f8c8d;
            font-size: 0.95rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-260px);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-container {
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
                RentCar Admin
            </h3>
            <p>Panel de Administració</p>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="dashboard-admin.html" class="nav-link active">
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
                <a href="gestio-clients.html" class="nav-link">
                    <i class="bi bi-people"></i>
                    <span>Clients</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="gestio-lloguers.html" class="nav-link">
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
            <h2>Dashboard</h2>
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

        <!-- Menu Cards -->
        <div class="menu-container">
            <a href="gestio-vehicles.html" class="menu-card">
                <div class="menu-icon vehiculos">
                    <i class="bi bi-car-front"></i>
                </div>
                <div class="menu-info">
                    <h3>Gestió de Vehicles</h3>
                    <p>Afegir, editar i eliminar vehicles</p>
                </div>
            </a>
            
            <a href="gestio-clients.html" class="menu-card">
                <div class="menu-icon usuarios">
                    <i class="bi bi-people"></i>
                </div>
                <div class="menu-info">
                    <h3>Gestió de Clients</h3>
                    <p>Administrar usuaris i clients</p>
                </div>
            </a>
            
            <a href="gestio-lloguers.html" class="menu-card">
                <div class="menu-icon reservas">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <div class="menu-info">
                    <h3>Gestió de Lloguers</h3>
                    <p>Gestionar reserves i lloguers</p>
                </div>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>