<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afegir Vehicle - RentCar Admin</title>
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

        /* Content Section */
        .content-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

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

        .btn-primary-custom {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
        }

        .btn-secondary-custom {
            background: #6c757d;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-secondary-custom:hover {
            background: #5a6268;
            color: white;
        }

        /* Preview Image */
        .image-preview {
            width: 100%;
            max-width: 400px;
            height: 250px;
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

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f5f6fa;
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
            <h2><i class="bi bi-plus-circle me-2"></i>Afegir Nou Vehicle</h2>
        </div>

        <!-- Form Section -->
        <div class="content-section">
            <form action="addCoche.php" method="POST">
                <div class="row g-3">
                    <!-- Nom -->
                    <div class="col-12">
                        <label for="nombre" class="form-label">Nom del Vehicle</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ex: Tesla Model S Negre" required>
                        <small class="text-muted">Nom descriptiu del vehicle</small>
                    </div>

                    <!-- Marca -->
                    <div class="col-md-6">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca" placeholder="Ex: Tesla, BMW, Mercedes..." required>
                    </div>

                    <!-- Model -->
                    <div class="col-md-6">
                        <label for="modelo" class="form-label">Model</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Ex: Model S, Serie 3..." required>
                    </div>

                    <!-- Matrícula -->
                    <div class="col-md-6">
                        <label for="matricula" class="form-label">Matrícula</label>
                        <input type="text" class="form-control" id="matricula" name="matricula" placeholder="ABC-1234" required>
                    </div>

                    <!-- Preu per dia -->
                    <div class="col-md-6">
                        <label for="precio_dia" class="form-label">Preu per Dia (€)</label>
                        <input type="number" class="form-control" id="precio_dia" name="precio_dia" placeholder="100" min="0" step="0.01" required>
                    </div>

                    <!-- Estat -->
                    <div class="col-md-12">
                        <label for="estado" class="form-label">Estat</label>
                        <select class="form-select" id="estado" name="estado" required>
                            <option value="disponible" selected>Disponible</option>
                            <option value="alquilado">Llogat</option>
                            <option value="mantenimento">Manteniment</option>
                        </select>
                    </div>

                    <!-- Foto -->
                    <div class="col-12">
                        <label for="foto" class="form-label">URL de la Foto</label>
                        <input type="url" class="form-control" id="foto" name="foto" placeholder="https://exemple.com/imatge.jpg"  required>
                        <small class="text-muted">Introdueix la URL completa de la imatge del vehicle</small>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="bi bi-save me-2"></i>Guardar Vehicle
                    </button>
                    <a href="gestio-vehicles.html" class="btn btn-secondary-custom">
                        <i class="bi bi-x-circle me-2"></i>Cancel·lar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>