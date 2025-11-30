<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Usuari - RentCar</title>
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

        .btn-edit-profile {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-edit-profile:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
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

        .badge-disponible {
            background: #d4edda;
            color: #155724;
        }

        /* Vehicle Image */
        .vehicle-img {
            width: 60px;
            height: 40px;
            border-radius: 6px;
            object-fit: cover;
        }

        /* Vehicle Cards */
        .vehicles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .vehicle-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            border: 1px solid #f0f0f0;
        }

        .vehicle-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .vehicle-card-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .vehicle-card-body {
            padding: 20px;
        }

        .vehicle-card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .vehicle-card-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .vehicle-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: #ff6b35;
        }

        .vehicle-price span {
            font-size: 0.8rem;
            font-weight: 400;
            color: #7f8c8d;
        }

        .btn-rent {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-rent:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #ddd;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-260px);
            }

            .main-content {
                margin-left: 0;
            }

            .vehicles-grid {
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
                <a href="userDashboard.php" class="nav-link active">
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
                <a href="userHistorial.php" class="nav-link">
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
            <h2>Benvingut, !</h2>
            <div style="display: flex; align-items: center; gap: 15px;">
                <a href="editar-perfil.html" class="btn-edit-profile">
                    <i class="bi bi-person-gear"></i>
                    Editar Perfil
                </a>
                <div class="user-profile">
                    <div class="user-info">
                        <h5>nombre</h5>
                        <p>tipo de role</p>
                    </div>
                    <div class="user-avatar">
                        avatar
                    </div>
                </div>
            </div>
        </div>

        <!-- Lloguers Actius -->
        <div class="content-section" id="actius">
            <div class="section-header">
                <h4><i class="bi bi-calendar-check me-2"></i>Els Meus Lloguers Actius</h4>
            </div>
            
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Marca</th>
                            <th>Data Inici</th>
                            <th>Data Fi</th>
                            <th>Preu Total</th>
                            <th>Estat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=200" alt="Tesla Model S" class="vehicle-img">
                                    <span>Tesla Model S Negre</span>
                                </div>
                            </td>
                            <td>Tesla</td>
                            <td>25/11/2024</td>
                            <td>28/11/2024</td>
                            <td>360€</td>
                            <td><span class="badge-custom badge-actiu">Actiu</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Vehicles Disponibles -->
        <div class="content-section" id="vehicles">
            <div class="section-header">
                <h4><i class="bi bi-car-front me-2"></i>Vehicles Disponibles</h4>
            </div>
            
            <div class="vehicles-grid">
                <!-- Vehicle Card 1 -->
                <div class="vehicle-card">
                    <img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?w=400" alt="Mercedes Classe A" class="vehicle-card-img">
                    <div class="vehicle-card-body">
                        <div class="vehicle-card-title">Mercedes Classe A Blanc</div>
                        <p style="color: #7f8c8d; margin: 0; font-size: 0.9rem;">Mercedes-Benz</p>
                        <div class="vehicle-card-info">
                            <div class="vehicle-price">95€ <span>/dia</span></div>
                            <a href="#" class="btn-rent">Llogar</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Historial de Reserves -->
        <div class="content-section" id="historial">
            <div class="section-header">
                <h4><i class="bi bi-clock-history me-2"></i>Historial de Reserves</h4>
            </div>
            
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Marca</th>
                            <th>Data Inici</th>
                            <th>Data Fi</th>
                            <th>Preu Total</th>
                            <th>Estat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <img src="https://images.unsplash.com/photo-1605559424843-9e4c228bf1c2?w=200" alt="Audi A4" class="vehicle-img">
                                    <span>Audi A4 Gris</span>
                                </div>
                            </td>
                            <td>Audi</td>
                            <td>15/11/2024</td>
                            <td>18/11/2024</td>
                            <td>315€</td>
                            <td><span class="badge-custom badge-completat">Completat</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>