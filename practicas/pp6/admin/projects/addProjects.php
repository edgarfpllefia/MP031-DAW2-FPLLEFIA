<?php
session_start();
require_once('../theme/config.php');

// Verificar admin
if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../login.php');
    exit();
}

$user_name = $_SESSION['user_name'];

// Procesar formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];
    $photo = $_POST['photo'];
    $link = $_POST['link'];
    
    $sql = "INSERT INTO projects (title, subtitle, description, photo, link, comments_count) VALUES ('$title', '$subtitle', '$description', '$photo', '$link', 0)";
    
    if($mysqli->query($sql)){
        header('Location: adminProjects.php');
        exit();
    } else {
        $error = 'Error al añadir el proyecto';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Proyecto - Rider Zone</title>
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
        }

        .sidebar-header {
            background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
            padding: 1.5rem;
            text-align: center;
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
            text-transform: uppercase;
            margin: 0;
        }

        .sidebar-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.75rem;
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
            text-decoration: none;
        }

        .btn-logout:hover {
            background: rgba(220, 53, 69, 1);
            color: white;
        }

        .form-container {
            background: rgba(30, 30, 30, 0.98);
            border: 1px solid rgba(255, 94, 0, 0.2);
            border-radius: 8px;
            padding: 2rem;
            max-width: 800px;
        }

        .form-title {
            color: #e0e0e0;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 2rem;
        }

        .form-title i {
            color: #ff5e00;
            margin-right: 1rem;
        }

        .form-label {
            color: #e0e0e0;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 4px;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #ff5e00;
            color: white;
        }

        textarea.form-control {
            min-height: 120px;
        }

        .alert-box {
            background: rgba(220, 53, 69, 0.1);
            border-left: 4px solid #dc3545;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 2rem;
            color: #dc3545;
        }

        .btn-submit {
            background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
            border: none;
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-submit:hover {
            opacity: 0.9;
        }

        .btn-cancel {
            background: rgba(108, 117, 125, 0.2);
            border: 1px solid #6c757d;
            color: #b0b0b0;
            padding: 0.8rem 2rem;
            border-radius: 6px;
            text-decoration: none;
            margin-left: 1rem;
        }

        .btn-cancel:hover {
            background: rgba(108, 117, 125, 0.4);
            color: white;
        }

        .form-actions {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
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

            .top-bar {
                flex-direction: column;
                gap: 1rem;
            }
        }

        .menu-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
            border: none;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 8px;
            font-size: 1.2rem;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .sidebar.active {
                width: 280px;
            }
        }
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="document.getElementById('sidebar').classList.toggle('active')">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-motorcycle"></i>
            </div>
            <h1 class="sidebar-title">Rider Zone</h1>
            <p class="sidebar-subtitle">Panel de Administración</p>
        </div>

        <div class="sidebar-menu">
            <a href="panelAdmin.php" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="adminUsers.php" class="menu-item">
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
            </a>
            <a href="adminProjects.php" class="menu-item active">
                <i class="fas fa-project-diagram"></i>
                <span>Proyectos</span>
            </a>
            <a href="adminNews.php" class="menu-item">
                <i class="fas fa-newspaper"></i>
                <span>Noticias</span>
            </a>
            <a href="adminTestimonials.php" class="menu-item">
                <i class="fas fa-comments"></i>
                <span>Testimonios</span>
            </a>
            <a href="adminComments.php" class="menu-item">
                <i class="fas fa-comment-dots"></i>
                <span>Comentarios</span>
            </a>
            
            <div class="menu-separator"></div>
            
            <a href="../logout.php" class="menu-item">
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
                <a href="../logout.php" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Salir
                </a>
            </div>
        </div>

        <div class="form-container">
            <h2 class="form-title">
                <i class="fas fa-plus-circle"></i>
                Añadir Nuevo Proyecto
            </h2>

            <?php if(isset($error)): ?>
                <div class="alert-box">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="addProjects.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Título *</label>
                    <input type="text" class="form-control" name="title" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subtítulo *</label>
                    <input type="text" class="form-control" name="subtitle" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción *</label>
                    <textarea class="form-control" name="description" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">URL de la Imagen *</label>
                    <input type="url" class="form-control" name="photo" placeholder="https://ejemplo.com/imagen.jpg" required>
                    <small style="color: #b0b0b0;">Pega la URL de una imagen</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Enlace (opcional)</label>
                    <input type="url" class="form-control" name="link" placeholder="https://ejemplo.com">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Guardar Proyecto
                    </button>
                    <a href="adminProjects.php" class="btn-cancel">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>