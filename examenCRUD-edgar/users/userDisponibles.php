<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles Disponibles - RentCar</title>
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

        /* Search Bar */
        .search-bar {
            position: relative;
            max-width: 400px;
            margin-bottom: 30px;
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

        /* Vehicle Cards */
        .vehicles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
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
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .vehicle-card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .vehicle-card-body {
            padding: 20px;
        }

        .vehicle-card-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .vehicle-card-brand {
            color: #7f8c8d;
            margin: 0 0 15px 0;
            font-size: 0.95rem;
        }

        .vehicle-card-details {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f5f6fa;
        }

        .vehicle-detail {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        .vehicle-detail i {
            color: #ff6b35;
        }

        .vehicle-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .vehicle-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ff6b35;
        }

        .vehicle-price span {
            font-size: 0.85rem;
            font-weight: 400;
            color: #7f8c8d;
        }

        .btn-rent {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            border: none;
            padding: 10px 25px;
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

        .badge-disponible {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #28a745;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
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
                <a href="userDisponibles.php" class="nav-link active">
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
            <h2>Vehicles Disponibles</h2>
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

        <!-- Content Section -->
        <div class="content-section">
            <div class="section-header">
                <h4><i class="bi bi-car-front me-2"></i>Tots els Vehicles Disponibles</h4>
            </div>

            <!-- Search Bar -->
            <div class="search-bar">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control" placeholder="Cercar per marca, model o matrícula...">
            </div>
            
            <!-- Vehicles Grid -->
            <div class="vehicles-grid">
                <!-- Vehicle Card 1 -->
                <div class="vehicle-card">
                    <div style="position: relative;">
                        <img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?w=400" alt="Mercedes Classe A" class="vehicle-card-img">
                        <span class="badge-disponible">Disponible</span>
                    </div>
                    <div class="vehicle-card-body">
                        <div class="vehicle-card-title">Mercedes Classe A Blanc</div>
                        <p class="vehicle-card-brand">Mercedes-Benz • Model: Classe A</p>
                        <div class="vehicle-card-details">
                            <div class="vehicle-detail">
                                <i class="bi bi-credit-card"></i>
                                <span>DEF-5678</span>
                            </div>
                        </div>
                        <div class="vehicle-card-footer">
                            <div class="vehicle-price">95€ <span>/dia</span></div>
                            <a href="#" class="btn-rent">Llogar</a>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Card 2 -->
                <div class="vehicle-card">
                    <div style="position: relative;">
                        <img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=400" alt="BMW Sèrie 3" class="vehicle-card-img">
                        <span class="badge-disponible">Disponible</span>
                    </div>
                    <div class="vehicle-card-body">
                        <div class="vehicle-card-title">BMW Sèrie 3 Blau</div>
                        <p class="vehicle-card-brand">BMW • Model: Sèrie 3</p>
                        <div class="vehicle-card-details">
                            <div class="vehicle-detail">
                                <i class="bi bi-credit-card"></i>
                                <span>GHI-9012</span>
                            </div>
                        </div>
                        <div class="vehicle-card-footer">
                            <div class="vehicle-price">110€ <span>/dia</span></div>
                            <a href="#" class="btn-rent">Llogar</a>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Card 3 -->
                <div class="vehicle-card">
                    <div style="position: relative;">
                        <img src="https://images.unsplash.com/photo-1605559424843-9e4c228bf1c2?w=400" alt="Audi A4" class="vehicle-card-img">
                        <span class="badge-disponible">Disponible</span>
                    </div>
                    <div class="vehicle-card-body">
                        <div class="vehicle-card-title">Audi A4 Gris</div>
                        <p class="vehicle-card-brand">Audi • Model: A4</p>
                        <div class="vehicle-card-details">
                            <div class="vehicle-detail">
                                <i class="bi bi-credit-card"></i>
                                <span>JKL-3456</span>
                            </div>
                        </div>
                        <div class="vehicle-card-footer">
                            <div class="vehicle-price">105€ <span>/dia</span></div>
                            <a href="#" class="btn-rent">Llogar</a>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Card 4 -->
                <div class="vehicle-card">
                    <div style="position: relative;">
                        <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=400" alt="Tesla Model S" class="vehicle-card-img">
                        <span class="badge-disponible">Disponible</span>
                    </div>
                    <div class="vehicle-card-body">
                        <div class="vehicle-card-title">Tesla Model S Negre</div>
                        <p class="vehicle-card-brand">Tesla • Model: Model S</p>
                        <div class="vehicle-card-details">
                            <div class="vehicle-detail">
                                <i class="bi bi-credit-card"></i>
                                <span>ABC-1234</span>
                            </div>
                        </div>
                        <div class="vehicle-card-footer">
                            <div class="vehicle-price">120€ <span>/dia</span></div>
                            <a href="#" class="btn-rent">Llogar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>