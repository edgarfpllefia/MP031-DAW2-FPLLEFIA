<header class="navigation fixed-top">
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.php">
      <i class="fas fa-motorcycle" style="color: #ff5e00; font-size: 2rem; margin-right: 0.5rem;"></i>
      <span style="color: white; font-weight: 700; font-size: 1.3rem;">RIDER ZONE</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
      aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse text-center" id="navigation">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="services.php">Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.php">Noticias</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Más</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="team.php">Equipo</a>
            <a class="dropdown-item" href="career.php">Trabaja con nosotros</a>
            <a class="dropdown-item" href="faqs.php">FAQ's</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contacto</a>
        </li>
      </ul>
      
      <!-- Botones de Login y Registro -->
      <div class="auth-buttons ml-lg-3 d-flex align-items-center">
        <a href="../../login.php" class="btn-login">
          <i class="fas fa-sign-in-alt"></i> Login
        </a>
        <a href="../../register.php" class="btn-register">
          <i class="fas fa-user-plus"></i> Registro
        </a>
      </div>
    </div>
  </nav>
</header>

<style>
  .navigation {
    background: rgba(30, 30, 30, 0.98) !important;
    border-bottom: 1px solid rgba(255, 94, 0, 0.2);
    backdrop-filter: blur(10px);
    padding: 1rem 0;
  }

  .navbar-brand {
    display: flex;
    align-items: center;
    text-decoration: none;
  }

  .navbar-nav .nav-link {
    color: #b0b0b0 !important;
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
    padding: 0.5rem 1rem !important;
  }

  .navbar-nav .nav-link:hover,
  .navbar-nav .nav-link.active,
  .navbar-nav .nav-item.active .nav-link {
    color: #ff5e00 !important;
  }

  .navbar-nav .nav-item.active .nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 1rem;
    right: 1rem;
    height: 2px;
    background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
  }

  .dropdown-menu {
    background: rgba(30, 30, 30, 0.98) !important;
    border: 1px solid rgba(255, 94, 0, 0.2);
    border-radius: 8px;
    padding: 0.5rem 0;
    margin-top: 0.5rem;
  }

  .dropdown-item {
    color: #b0b0b0 !important;
    padding: 0.7rem 1.5rem;
    transition: all 0.3s ease;
  }

  .dropdown-item:hover {
    background: rgba(255, 94, 0, 0.1) !important;
    color: #ff5e00 !important;
  }

  .navbar-toggler {
    border: 2px solid #ff5e00;
  }

  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 94, 0, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
  }

  .navbar-toggler:focus {
    box-shadow: 0 0 0 0.2rem rgba(255, 94, 0, 0.25);
  }

  /* AUTH BUTTONS */
  .auth-buttons {
    gap: 0.5rem;
  }

  .btn-login {
    color: #b0b0b0;
    background: transparent;
    border: 1px solid rgba(255, 94, 0, 0.3);
    padding: 0.5rem 1.2rem;
    border-radius: 4px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .btn-login:hover {
    color: white;
    background: rgba(255, 94, 0, 0.1);
    border-color: #ff5e00;
    text-decoration: none;
  }

  .btn-register {
    color: white;
    background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
    border: none;
    padding: 0.5rem 1.2rem;
    border-radius: 4px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 10px rgba(255, 94, 0, 0.3);
  }

  .btn-register:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 94, 0, 0.4);
    text-decoration: none;
  }

  /* RESPONSIVE */
  @media (max-width: 991px) {
    .auth-buttons {
      margin-top: 1rem;
      justify-content: center;
      width: 100%;
    }

    .btn-login,
    .btn-register {
      flex: 1;
      justify-content: center;
    }
  }
</style>