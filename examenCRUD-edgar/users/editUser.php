<?php
session_start();
require_once '../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user'){
    header('Location: ../login.php');
    exit();
}

$nombre = $_SESSION['user_name'];
$apellido = $_SESSION['user_apellido'];
$role = $_SESSION['user_role'];
$direccion = $_SESSION['user_direccion'];
$email = $_SESSION['user_email'];

$stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();
$user = $resultado ->fetch_assoc();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $direccion = $_POST['direccion'];

    $password_hasheada = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("UPDATE users SET role = ?, nombre= ?, apellido= ?, email = ?, password = ?, direccion = ?, WHERE id = ?");

    if(!$stmt){
        die("Error en la preparacion" . $mysqli->error);
    }

    $stmt->bind_param('ssssssi',$role, $nombre, $apellido, $email, $password_hasheada, $direccion, $id);

    if($stmt->execute()){
        $stmt->close();
        $mysqli->close();
        header('Location: adminUsuario.php');
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - RentCar</title>
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

        /* Content Section */
        .content-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
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

        .info-row {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid #f5f6fa;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #2c3e50;
            width: 200px;
        }

        .info-value {
            color: #7f8c8d;
            flex: 1;
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .form-control:focus {
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

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f5f6fa;
        }

        .password-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .password-section h5 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 1rem;
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
            <h2><i class="bi bi-person-gear me-2"></i>El Meu Perfil</h2>
        </div>

        <!-- Datos del Usuario -->
        <div class="content-section">
            <div class="section-header">
                <h4><i class="bi bi-person-circle me-2"></i>Dades Personals</h4>
            </div>

            <div class="info-row">
                <div class="info-label">Nom:</div>
                <div class="info-value"><?= $nombre ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Cognom:</div>
                <div class="info-value"><?= $apellido ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Correu Electrònic:</div>
                <div class="info-value"><?= $email ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Direcció:</div>
                <div class="info-value"><?= $direccion ?></div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="content-section" id="editar">
            <div class="section-header">
                <h4><i class="bi bi-pencil-square me-2"></i>Editar Dades</h4>
            </div>

            <form action="" method="POST">
                <div class="row g-3">
                    <!-- Nom -->
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $user['nombre'] ?>" required>
                    </div>

                    <!-- Cognom -->
                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Cognom</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?= $user['apellido'] ?>" required>
                    </div>

                    <!-- Email -->
                    <div class="col-12">
                        <label for="email" class="form-label">Correu Electrònic</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
                    </div>

                    <!-- Direcció -->
                    <div class="col-12">
                        <label for="direccion" class="form-label">Direcció</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $user['direccion'] ?>" required>
                    </div>
                </div>

                <!-- Password Section (Optional) -->
                <div class="password-section">
                    <h5><i class="bi bi-key me-2"></i>Canviar Contrasenya (Opcional)</h5>
                    <p class="text-muted mb-3" style="font-size: 0.9rem;">Deixa els camps en blanc si no vols canviar la contrasenya</p>
                    
                    <div class="row g-3">
                        <!-- Contrasenya Actual -->
                        <div class="col-md-12">
                            <label for="current_password" class="form-label">Contrasenya Actual</label>
                            <input type="password" class="form-control" id="current_password" name="current_password"  value="<?= $user['password'] ?>" placeholder="Introdueix la teva contrasenya actual">
                        </div>

                        
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="bi bi-save me-2"></i>Guardar Canvis
                    </button>
                    <a href="dashboard-user.html" class="btn btn-secondary-custom">
                        <i class="bi bi-x-circle me-2"></i>Cancel·lar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>