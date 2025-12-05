<?php
session_start();
require_once('../../theme/config.php');

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../../login.php');
    exit();
}

$user_name = $_SESSION['user_name'];

// Obtener usuarios
$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $mysqli->query($sql);
$users = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Rider Zone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: #1a1a1a;
            position: relative;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 280px;
            background: rgba(30, 30, 30, 0.98);
            border-right: 1px solid rgba(255, 94, 0, 0.2);
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 94, 0, 0.3);
        }

        .sidebar-logo {
            font-size: 2rem;
            color: white;
            margin-bottom: 0.5rem;
        }

        .sidebar-title {
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin: 0;
        }

        .sidebar-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.75rem;
            letter-spacing: 1px;
            margin-top: 0.2rem;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-item {
            padding: 0.9rem 1.5rem;
            color: #b0b0b0;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background: rgba(255, 94, 0, 0.1);
            color: #ff5e00;
            border-left-color: #ff5e00;
        }

        .menu-item.active {
            background: rgba(255, 94, 0, 0.15);
            color: #ff5e00;
            border-left-color: #ff5e00;
            font-weight: 600;
        }

        .menu-item i {
            width: 25px;
            margin-right: 1rem;
            font-size: 1.1rem;
        }

        .menu-separator {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 1rem 1.5rem;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
            background: #0f0f0f;
        }

        .top-bar {
            background: rgba(30, 30, 30, 0.98);
            border: 1px solid rgba(255, 94, 0, 0.2);
            border-radius: 8px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .welcome-text {
            color: #e0e0e0;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .welcome-text span {
            color: #ff5e00;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .btn-logout {
            background: rgba(220, 53, 69, 0.8);
            border: none;
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-logout:hover {
            background: rgba(220, 53, 69, 1);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
            color: white;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .header-title {
            color: #e0e0e0;
            font-size: 2rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-title i {
            color: #ff5e00;
        }

        .btn-new-user {
            background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
            border: none;
            color: white;
            padding: 0.8rem 1.8rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            box-shadow: 0 4px 15px rgba(255, 94, 0, 0.3);
        }

        .btn-new-user:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 94, 0, 0.5);
            color: white;
            text-decoration: none;
        }

        .alert-box {
            background: rgba(30, 30, 30, 0.98);
            border: 1px solid rgba(255, 94, 0, 0.2);
            border-radius: 8px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .alert-box.success {
            border-left: 4px solid #28a745;
            background: rgba(40, 167, 69, 0.1);
        }

        .alert-box.error {
            border-left: 4px solid #dc3545;
            background: rgba(220, 53, 69, 0.1);
        }

        .alert-icon {
            font-size: 1.3rem;
        }

        .alert-box.success .alert-icon {
            color: #28a745;
        }

        .alert-box.error .alert-icon {
            color: #dc3545;
        }

        .alert-text {
            color: #e0e0e0;
        }

        .table-container {
            background: rgba(30, 30, 30, 0.98);
            border: 1px solid rgba(255, 94, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .users-table {
            margin: 0;
            color: #e0e0e0;
        }

        .users-table thead {
            background: rgba(255, 94, 0, 0.1);
            border-bottom: 1px solid rgba(255, 94, 0, 0.3);
        }

        .users-table thead th {
            color: #ff5e00;
            font-weight: 600;
            border: none;
            padding: 1rem 1.5rem;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .users-table tbody tr {
            border-bottom: 1px solid rgba(255, 94, 0, 0.1);
            transition: all 0.3s ease;
        }

        .users-table tbody tr:hover {
            background: rgba(255, 94, 0, 0.05);
        }

        .users-table tbody td {
            color: #b0b0b0;
            padding: 1rem 1.5rem;
            vertical-align: middle;
        }

        .user-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 94, 0, 0.2);
        }

        .user-name {
            color: #e0e0e0;
            font-weight: 600;
        }

        .badge {
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .badge-admin {
            background: rgba(255, 94, 0, 0.3);
            color: #ff5e00;
        }

        .badge-user {
            background: rgba(108, 117, 125, 0.3);
            color: #6c757d;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.85rem;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            margin: 0.2rem;
        }

        .btn-edit {
            background: rgba(23, 162, 184, 0.2);
            color: #17a2b8;
        }

        .btn-edit:hover {
            background: rgba(23, 162, 184, 0.4);
            color: #17a2b8;
        }

        .btn-delete {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }

        .btn-delete:hover {
            background: rgba(220, 53, 69, 0.4);
            color: #dc3545;
        }

        .empty-state {
            background: rgba(30, 30, 30, 0.98);
            border: 1px solid rgba(255, 94, 0, 0.2);
            border-radius: 8px;
            padding: 4rem 2rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .empty-state-icon {
            font-size: 4rem;
            color: rgba(255, 94, 0, 0.3);
            margin-bottom: 1rem;
        }

        .empty-state-title {
            color: #e0e0e0;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .empty-state-text {
            color: #b0b0b0;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .header-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-title {
                font-size: 1.5rem;
            }

            .btn-new-user {
                width: 100%;
                justify-content: center;
            }

            .top-bar {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .table-wrapper {
                overflow-x: auto;
            }

            .btn-action {
                display: block;
                width: 100%;
                margin-bottom: 0.5rem;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-motorcycle"></i>
            </div>
            <h1 class="sidebar-title">Rider Zone</h1>
            <p class="sidebar-subtitle">Panel de Administración</p>
        </div>

        <div class="sidebar-menu">
            <a href="../panelAdmin.php" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="adminUsers.php" class="menu-item active">
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
            </a>
            <a href="../projects/adminProjects.php" class="menu-item">
                <i class="fas fa-project-diagram"></i>
                <span>Proyectos</span>
            </a>
            <a href="../news/adminNews.php" class="menu-item">
                <i class="fas fa-newspaper"></i>
                <span>Noticias</span>
            </a>
            <a href="../testimonials/adminTestimonials.php" class="menu-item">
                <i class="fas fa-comments"></i>
                <span>Testimonios</span>
            </a>
            <a href="../comments/adminComments.php" class="menu-item">
                <i class="fas fa-comment-dots"></i>
                <span>Comentarios</span>
            </a>
            
            <div class="menu-separator"></div>
            
            <a href="../../logout.php" class="menu-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Cerrar Sesión</span>
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="welcome-text">
                Bienvenido, <span><?php echo $user_name; ?></span>
            </div>
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo strtoupper(substr($user_name, 0, 1)); ?>
                </div>
                <a href="../../logout.php" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i>Salir
                </a>
            </div>
        </div>

        <div class="header-section">
            <h2 class="header-title">
                <i class="fas fa-users"></i>
                Gestión de Usuarios
            </h2>
            <a href="addUsers.php" class="btn-new-user">
                <i class="fas fa-plus"></i>
                Nuevo Usuario
            </a>
        </div>

        <?php if(isset($_GET['message'])): ?>
            <div class="alert-box success">
                <div class="alert-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="alert-text">
                    <?php echo $_GET['message']; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['error'])): ?>
            <div class="alert-box error">
                <div class="alert-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="alert-text">
                    <?php echo $_GET['error']; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if(empty($users)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="empty-state-title">Sin usuarios</h3>
                <p class="empty-state-text">No hay usuarios registrados todavía.</p>
                <a href="addUser.php" class="btn-new-user">
                    <i class="fas fa-plus"></i>
                    Crear Primer Usuario
                </a>
            </div>
        <?php else: ?>
            <div class="table-container">
                <div class="table-wrapper">
                    <table class="table users-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Foto</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $u): ?>
                                <tr>
                                    <td><?php echo $u['id']; ?></td>
                                    <td>
                                        <?php if(!empty($u['photo'])): ?>
                                            <img src="<?php echo $u['photo']; ?>" alt="<?php echo $u['name']; ?>" class="user-image">
                                        <?php else: ?>
                                            <img src="https://via.placeholder.com/50" alt="Sin foto" class="user-image">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="user-name"><?php echo $u['name']; ?> <?php echo $u['surname']; ?></div>
                                    </td>
                                    <td><?php echo $u['email']; ?></td>
                                    <td>
                                        <?php if($u['role'] == 'admin'): ?>
                                            <span class="badge badge-admin">Admin</span>
                                        <?php else: ?>
                                            <span class="badge badge-user">Usuario</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo date('d/m/Y', strtotime($u['register_date'])); ?></td>
                                    <td>
                                        <a href="editUsers.php?id=<?php echo $u['id']; ?>" class="btn-action btn-edit">
                                            <i class="fas fa-edit"></i>
                                            Editar
                                        </a>
                                        <a href="deleteUsers.php?id=<?php echo $u['id']; ?>" class="btn-action btn-delete">
                                            <i class="fas fa-trash"></i>
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>