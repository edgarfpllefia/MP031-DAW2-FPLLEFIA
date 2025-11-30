<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lloguers Actius - RentCar</title>
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
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
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

        /* Active Rental Cards */
        .active-rentals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .rental-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            border: 2px solid #d1ecf1;
        }

        .rental-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .rental-card-header {
            position: relative;
        }

        .rental-card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .badge-actiu {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #0c5460;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .rental-card-body {
            padding: 20px;
        }

        .rental-card-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .rental-card-brand {
            color: #7f8c8d;
            margin: 0 0 15px 0;
            font-size: 0.95rem;
        }

        .rental-info-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid #f5f6fa;
        }

        .rental-info-row:last-child {
            border-bottom: none;
        }

        .rental-info-icon {
            color: #ff6b35;
            font-size: 1.1rem;
            width: 25px;
        }

        .rental-info-label {
            font-weight: 600;
            color: #2c3e50;
            width: 120px;
        }

        .rental-info-value {
            color: #7f8c8d;
            flex: 1;
        }

        .rental-card-footer {
            background: #f8f9fa;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .rental-total {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ff6b35;
        }

        .rental-days {
            background: #d1ecf1;
            color: #0c5460;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #7f8c8d;
        }

        .empty-state i {
            font-size: 5rem;
            margin-bottom: 20px;
            color: #ddd;
        }

        .empty-state h3 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #7f8c8d;
            margin-bottom: 30px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
            color: white;
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

            .active-rentals-grid {
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
                <a href="userActivos.php" class="nav-link active">
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
            <h2>Lloguers Actius</h2>
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
                <div class="info-card-icon">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <div class="info-card-content">
                    <h3>1</h3>
                    <p>Lloguer Actiu</p>
                </div>
            </div>
            <div class="info-card">
                <div class="info-card-icon">
                    <i class="bi bi-cash-coin"></i>
                </div>
                <div class="info-card-content">
                    <h3>360€</h3>
                    <p>Total en Curs</p>
                </div>
            </div>
        </div>

        <!-- Active Rentals Section -->
        <div class="content-section">
            <div class="section-header">
                <h4><i class="bi bi-calendar-check me-2"></i>Els Meus Lloguers Actius</h4>
            </div>
            
            <div class="active-rentals-grid">
                <!-- Rental Card 1 -->
                <div class="rental-card">
                    <div class="rental-card-header">
                        <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=400" alt="Tesla Model S" class="rental-card-img">
                        <span class="badge-actiu">Actiu</span>
                    </div>
                    <div class="rental-card-body">
                        <div class="rental-card-title">Tesla Model S Negre</div>
                        <p class="rental-card-brand">Tesla • Model S</p>
                        
                        <div class="rental-info-row">
                            <i class="bi bi-credit-card rental-info-icon"></i>
                            <div class="rental-info-label">Matrícula:</div>
                            <div class="rental-info-value">ABC-1234</div>
                        </div>
                        
                        <div class="rental-info-row">
                            <i class="bi bi-calendar-event rental-info-icon"></i>
                            <div class="rental-info-label">Data Inici:</div>
                            <div class="rental-info-value">25/11/2024</div>
                        </div>
                        
                        <div class="rental-info-row">
                            <i class="bi bi-calendar-x rental-info-icon"></i>
                            <div class="rental-info-label">Data Fi:</div>
                            <div class="rental-info-value">28/11/2024</div>
                        </div>
                        
                        <div class="rental-info-row">
                            <i class="bi bi-cash rental-info-icon"></i>
                            <div class="rental-info-label">Preu/Dia:</div>
                            <div class="rental-info-value">120€</div>
                        </div>
                    </div>
                    <div class="rental-card-footer">
                        <div class="rental-total">360€</div>
                        <div class="rental-days">3 dies</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>