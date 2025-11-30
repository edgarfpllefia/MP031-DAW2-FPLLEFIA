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
                <a href="dashboard-admin.html" class="nav-link">
                    <i class="bi bi-house-door"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="bi bi-car-front"></i>
                    <span>Vehicles</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
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
                <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addVehicleModal">
                    <i class="bi bi-plus-lg me-2"></i>Afegir Vehicle
                </button>
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
                                    <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editVehicleModal">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn-action btn-delete" onclick="confirmarEliminar()">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#V002</td>
                            <td><img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?w=200" alt="Mercedes" class="vehicle-img"></td>
                            <td>Mercedes-Benz</td>
                            <td>Classe A</td>
                            <td>DEF-5678</td>
                            <td>2022</td>
                            <td>Blanc</td>
                            <td>95€</td>
                            <td><span class="badge-custom badge-danger">Llogat</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editVehicleModal">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn-action btn-delete" onclick="confirmarEliminar()">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#V003</td>
                            <td><img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=200" alt="BMW" class="vehicle-img"></td>
                            <td>BMW</td>
                            <td>Sèrie 3</td>
                            <td>GHI-9012</td>
                            <td>2023</td>
                            <td>Blau</td>
                            <td>110€</td>
                            <td><span class="badge-custom badge-warning">Manteniment</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editVehicleModal">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn-action btn-delete" onclick="confirmarEliminar()">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#V004</td>
                            <td><img src="https://images.unsplash.com/photo-1605559424843-9e4c228bf1c2?w=200" alt="Audi" class="vehicle-img"></td>
                            <td>Audi</td>
                            <td>A4</td>
                            <td>JKL-3456</td>
                            <td>2024</td>
                            <td>Gris</td>
                            <td>105€</td>
                            <td><span class="badge-custom badge-success">Disponible</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editVehicleModal">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn-action btn-delete" onclick="confirmarEliminar()">
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

    <!-- Modal Afegir Vehicle -->
    <div class="modal fade" id="addVehicleModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Afegir Nou Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">
                            <!-- Marca -->
                            <div class="col-md-6">
                                <label for="marca" class="form-label">Marca</label>
                                <input type="text" class="form-control" id="marca" name="marca" placeholder="Ex: Tesla, BMW, Mercedes..." required>
                            </div>

                            <!-- Model -->
                            <div class="col-md-6">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" class="form-control" id="model" name="model" placeholder="Ex: Model S, Serie 3..." required>
                            </div>

                            <!-- Matrícula -->
                            <div class="col-md-6">
                                <label for="matricula" class="form-label">Matrícula</label>
                                <input type="text" class="form-control" id="matricula" name="matricula" placeholder="ABC-1234" required>
                            </div>

                            <!-- Any -->
                            <div class="col-md-6">
                                <label for="any" class="form-label">Any</label>
                                <input type="number" class="form-control" id="any" name="any" placeholder="2024" min="1990" max="2025" required>
                            </div>

                            <!-- Color -->
                            <div class="col-md-6">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" class="form-control" id="color" name="color" placeholder="Negre, Blanc, Gris..." required>
                            </div>

                            <!-- Preu per dia -->
                            <div class="col-md-6">
                                <label for="preu" class="form-label">Preu per Dia (€)</label>
                                <input type="number" class="form-control" id="preu" name="preu" placeholder="100" min="0" step="0.01" required>
                            </div>

                            <!-- Tipus de Vehicle -->
                            <div class="col-md-6">
                                <label for="tipus" class="form-label">Tipus de Vehicle</label>
                                <select class="form-select" id="tipus" name="tipus" required>
                                    <option value="">Selecciona un tipus</option>
                                    <option value="sedan">Sedán</option>
                                    <option value="suv">SUV</option>
                                    <option value="compacte">Compacte</option>
                                    <option value="esportiu">Esportiu</option>
                                    <option value="furgoneta">Furgoneta</option>
                                    <option value="electric">Elèctric</option>
                                </select>
                            </div>

                            <!-- Combustible -->
                            <div class="col-md-6">
                                <label for="combustible" class="form-label">Combustible</label>
                                <select class="form-select" id="combustible" name="combustible" required>
                                    <option value="">Selecciona tipus</option>
                                    <option value="gasolina">Gasolina</option>
                                    <option value="diesel">Dièsel</option>
                                    <option value="electric">Elèctric</option>
                                    <option value="hibrid">Híbrid</option>
                                </select>
                            </div>

                            <!-- Places -->
                            <div class="col-md-6">
                                <label for="places" class="form-label">Nombre de Places</label>
                                <input type="number" class="form-control" id="places" name="places" placeholder="5" min="1" max="12" required>
                            </div>

                            <!-- Transmissió -->
                            <div class="col-md-6">
                                <label for="transmissio" class="form-label">Transmissió</label>
                                <select class="form-select" id="transmissio" name="transmissio" required>
                                    <option value="">Selecciona tipus</option>
                                    <option value="manual">Manual</option>
                                    <option value="automatica">Automàtica</option>
                                </select>
                            </div>

                            <!-- Estat -->
                            <div class="col-md-12">
                                <label for="estat" class="form-label">Estat</label>
                                <select class="form-select" id="estat" name="estat" required>
                                    <option value="disponible">Disponible</option>
                                    <option value="llogat">Llogat</option>
                                    <option value="manteniment">Manteniment</option>
                                </select>
                            </div>

                            <!-- Descripció -->
                            <div class="col-12">
                                <label for="descripcio" class="form-label">Descripció</label>
                                <textarea class="form-control" id="descripcio" name="descripcio" rows="3" placeholder="Descripció del vehicle..."></textarea>
                            </div>

                            <!-- Imatge -->
                            <div class="col-12">
                                <label for="imatge" class="form-label">Imatge del Vehicle</label>
                                <input type="file" class="form-control" id="imatge" name="imatge" accept="image/*" onchange="previewImage(event)">
                                <div class="image-preview" id="imagePreview">
                                    <div class="image-preview-placeholder">
                                        <i class="bi bi-image" style="font-size: 3rem;"></i>
                                        <p>Previsualització de la imatge</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-custom" data-bs-dismiss="modal">Cancel·lar</button>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="bi bi-save me-2"></i>Guardar Vehicle
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Vehicle -->
    <div class="modal fade" id="editVehicleModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Editar Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="vehicle_id" value="1">
                        <div class="row g-3">
                            <!-- Marca -->
                            <div class="col-md-6">
                                <label for="edit_marca" class="form-label">Marca</label>
                                <input type="text" class="form-control" id="edit_marca" name="marca" value="Tesla" required>
                            </div>

                            <!-- Model -->
                            <div class="col-md-6">
                                <label for="edit_model" class="form-label">Model</label>
                                <input type="text" class="form-control" id="edit_model" name="model" value="Model S" required>
                            </div>

                            <!-- Matrícula -->
                            <div class="col-md-6">
                                <label for="edit_matricula" class="form-label">Matrícula</label>
                                <input type="text" class="form-control" id="edit_matricula" name="matricula" value="ABC-1234" required>
                            </div>

                            <!-- Any -->
                            <div class="col-md-6">
                                <label for="edit_any" class="form-label">Any</label>
                                <input type="number" class="form-control" id="edit_any" name="any" value="2023" min="1990" max="2025" required>
                            </div>

                            <!-- Color -->
                            <div class="col-md-6">
                                <label for="edit_color" class="form-label">Color</label>
                                <input type="text" class="form-control" id="edit_color" name="color" value="Negre" required>
                            </div>

                            <!-- Preu per dia -->
                            <div class="col-md-6">
                                <label for="edit_preu" class="form-label">Preu per Dia (€)</label>
                                <input type="number" class="form-control" id="edit_preu" name="preu" value="120" min="0" step="0.01" required>
                            </div>

                            <!-- Tipus de Vehicle -->
                            <div class="col-md-6">
                                <label for="edit_tipus" class="form-label">Tipus de Vehicle</label>
                                <select class="form-select" id="edit_tipus" name="tipus" required>
                                    <option value="sedan">Sedán</option>
                                    <option value="suv">SUV</option>
                                    <option value="compacte">Compacte</option>
                                    <option value="esportiu">Esportiu</option>
                                    <option value="furgoneta">Furgoneta</option>
                                    <option value="electric" selected>Elèctric</option>
                                </select>
                            </div>

                            <!-- Combustible -->
                            <div class="col-md-6">
                                <label for="edit_combustible" class="form-label">Combustible</label>
                                <select class="form-select" id="edit_combustible" name="combustible" required>
                                    <option value="gasolina">Gasolina</option>
                                    <option value="diesel">Dièsel</option>
                                    <option value="electric" selected>Elèctric</option>
                                    <option value="hibrid">Híbrid</option>
                                </select>
                            </div>

                            <!-- Places -->
                            <div class="col-md-6">
                                <label for="edit_places" class="form-label">Nombre de Places</label>
                                <input type="number" class="form-control" id="edit_places" name="places" value="5" min="1" max="12" required>
                            </div>

                            <!-- Transmissió -->
                            <div class="col-md-6">
                                <label for="edit_transmissio" class="form-label">Transmissió</label>
                                <select class="form-select" id="edit_transmissio" name="transmissio" required>
                                    <option value="manual">Manual</option>
                                    <option value="automatica" selected>Automàtica</option>
                                </select>
                            </div>

                            <!-- Estat -->
                            <div class="col-md-12">
                                <label for="edit_estat" class="form-label">Estat</label>
                                <select class="form-select" id="edit_estat" name="estat" required>
                                    <option value="disponible" selected>Disponible</option>
                                    <option value="llogat">Llogat</option>
                                    <option value="manteniment">Manteniment</option>
                                </select>
                            </div>

                            <!-- Descripció -->
                            <div class="col-12">
                                <label for="edit_descripcio" class="form-label">Descripció</label>
                                <textarea class="form-control" id="edit_descripcio" name="descripcio" rows="3">Vehicle elèctric d'alta gamma amb autonomia de 600km.</textarea>
                            </div>

                            <!-- Imatge -->
                            <div class="col-12">
                                <label for="edit_imatge" class="form-label">Canviar Imatge</label>
                                <input type="file" class="form-control" id="edit_imatge" name="imatge" accept="image/*" onchange="previewEditImage(event)">
                                <div class="image-preview" id="editImagePreview">
                                    <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=400" alt="Vehicle actual">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-custom" data-bs-dismiss="modal">Cancel·lar</button>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="bi bi-save me-2"></i>Actualitzar Vehicle
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview image when adding vehicle
        function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                }
                reader.readAsDataURL(file);
            }
        }

        // Preview image when editing vehicle
        function previewEditImage(event) {
            const preview = document.getElementById('editImagePreview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                }
                reader.readAsDataURL(file);
            }
        }

        // Confirm delete
        function confirmarEliminar() {
            if (confirm('Estàs segur que vols eliminar aquest vehicle?')) {
                // Aquí irá la lógica PHP para eliminar
                alert('Vehicle eliminat correctament');
            }
        }
    </script>
</body>
</html>