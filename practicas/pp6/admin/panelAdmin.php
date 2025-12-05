<?php
session_start();
require_once('../theme/config.php');

// Verificar que el usuario sea admin
if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: /login.php');
    exit();
}

$user_name = $_SESSION['user_name'] ?? 'Admin';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Rider Zone</title>
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

        /* SIDEBAR */
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

        /* MAIN CONTENT */
        .main-content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
            background: #0f0f0f;
        }

        /* TOP BAR */
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

        /* ADMIN BUTTONS GRID */
        .admin-buttons-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .admin-button-card {
            background: rgba(30, 30, 30, 0.98);
            border: 1px solid rgba(255, 94, 0, 0.2);
            border-radius: 12px;
            padding: 2.5rem;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .admin-button-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ff5e00 0%, #d84e00 100%);
        }

        .admin-button-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(255, 94, 0, 0.3);
            border-color: rgba(255, 94, 0, 0.5);
            background: rgba(40, 40, 40, 0.98);
        }

        .admin-button-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 94, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: #ff5e00;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .admin-button-card:hover .admin-button-icon {
            background: rgba(255, 94, 0, 0.2);
            transform: scale(1.1);
        }

        .admin-button-title {
            color: white;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .admin-button-description {
            color: #b0b0b0;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .admin-button-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .sidebar.active {
                width: 280px;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .admin-buttons-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .top-bar {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }

        /* MOBILE MENU TOGGLE */
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
            box-shadow: 0 4px 15px rgba(255, 94, 0, 0.3);
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
        }

        /* INFO SECTION */
        .info-section {
            background: rgba(30, 30, 30, 0.98);
            border: 1px solid rgba(255, 94, 0, 0.2);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .info-title {
            color: #e0e0e0;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .info-title i {
            color: #ff5e00;
        }

        .info-text {
            color: #b0b0b0;
            line-height: 1.8;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Toggle -->
    <button class="menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-motorcycle"></i>
            </div>
            <h1 class="sidebar-title">Rider Zone</h1>
            <p class="sidebar-subtitle">Panel de Administración</p>
        </div>

        <div class="sidebar-menu">
            <a href="panelAdmin.php" class="menu-item active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="users/adminUsers.php" class="menu-item">
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
            </a>
            <a href="projects/adminProjects.php" class="menu-item">
                <i class="fas fa-project-diagram"></i>
                <span>Proyectos</span>
            </a>
            <a href="news/adminNews.php" class="menu-item">
                <i class="fas fa-newspaper"></i>
                <span>Noticias</span>
            </a>
            <a href="testimonials/adminTestimonials.php" class="menu-item">
                <i class="fas fa-comments"></i>
                <span>Testimonios</span>
            </a>
            <a href="comments/adminComments.php" class="menu-item">
                <i class="fas fa-comments-dollar"></i>
                <span>Comentarios</span>
            </a>
            
            <div class="menu-separator"></div>
            
            <a href="../logout.php" class="menu-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Cerrar Sesión</span>
            </a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- TOP BAR -->
        <div class="top-bar">
            <div class="welcome-text">
                Bienvenido, <span><?php echo htmlspecialchars($user_name); ?></span>
            </div>
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo strtoupper(substr($user_name, 0, 1)); ?>
                </div>
                <a href="logout.php" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i>Salir
                </a>
            </div>
        </div>

        <!-- INFO SECTION -->
        <div class="info-section">
            <h2 class="info-title">
                <i class="fas fa-info-circle"></i>
                Panel de Control
            </h2>
            <p class="info-text">
                Selecciona una de las opciones siguientes para gestionar el contenido de tu sitio web. 
                Desde aquí puedes administrar usuarios, proyectos, noticias y testimonios de forma fácil y rápida.
            </p>
        </div>

        <!-- ADMIN BUTTONS -->
        <div class="admin-buttons-grid">
            <!-- USUARIOS -->
            <a href="usuarios.php" class="admin-button-card">
                <span class="admin-button-badge">Gestión</span>
                <div class="admin-button-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="admin-button-title">Usuarios</h3>
                <p class="admin-button-description">
                    Administra los usuarios registrados, edita roles y permisos
                </p>
            </a>

            <!-- PROYECTOS -->
            <a href="proyectos.php" class="admin-button-card">
                <span class="admin-button-badge">Contenido</span>
                <div class="admin-button-icon">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <h3 class="admin-button-title">Proyectos</h3>
                <p class="admin-button-description">
                    Crea y gestiona proyectos, rutas y experiencias moteras
                </p>
            </a>

            <!-- NOTICIAS -->
            <a href="noticias.php" class="admin-button-card">
                <span class="admin-button-badge">Publicar</span>
                <div class="admin-button-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3 class="admin-button-title">Noticias</h3>
                <p class="admin-button-description">
                    Publica y edita noticias, artículos y novedades
                </p>
            </a>

            <!-- TESTIMONIOS -->
            <a href="testimonios.php" class="admin-button-card">
                <span class="admin-button-badge">Opiniones</span>
                <div class="admin-button-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3 class="admin-button-title">Testimonios</h3>
                <p class="admin-button-description">
                    Gestiona las opiniones y comentarios de los usuarios
                </p>
            </a>

            <!-- COMENTARIOS -->
            <a href="comments/adminComments.php" class="admin-button-card">
                <span class="admin-button-badge">Moderar</span>
                <div class="admin-button-icon">
                    <i class="fas fa-comments-dollar"></i>
                </div>
                <h3 class="admin-button-title">Comentarios</h3>
                <p class="admin-button-description">
                    Aprueba, rechaza o elimina comentarios en noticias
                </p>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.menu-toggle');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
    </script>
</body>
</html>