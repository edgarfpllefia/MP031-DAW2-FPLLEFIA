<?php
session_start();
require_once 'config.php';

if(!isset($_SESSION['user_role'])){
  header('Location: ../login.php');
}

// Obtener miembros del equipo
$teamMembers = [];
$tr = $mysqli->query("SELECT id, name, position, photo, short_description, email, created_at FROM team ORDER BY id ASC");
if ($tr) $teamMembers = $tr->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Nuestro Equipo | Rider Zone</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  <!-- Bootstrap -->
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <!-- slick slider -->
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
  <!-- venobox css -->
  <link rel="stylesheet" href="plugins/venobox/venobox.css">
  <!-- card slider -->
  <link rel="stylesheet" href="plugins/card-slider/css/style.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Main Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  
  <!--Favicon-->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">

  <style>
    /* COLORES PERSONALIZADOS RIDER ZONE */
    :root {
      --primary-color: #ff5e00;
      --primary-dark: #d84e00;
      --secondary-color: #1e1e1e;
      --dark-bg: #0f0f0f;
      --gradient-primary: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
    }

    body {
      background: var(--dark-bg);
      color: #e0e0e0;
    }

    /* NAVIGATION */
    .navigation {
      background: rgba(30, 30, 30, 0.98) !important;
      border-bottom: 1px solid rgba(255, 94, 0, 0.2);
      backdrop-filter: blur(10px);
    }

    .navbar-brand {
      color: white !important;
      font-weight: 700;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .navbar-brand i {
      color: var(--primary-color);
      font-size: 2rem;
    }

    .navbar-nav .nav-link {
      color: #b0b0b0 !important;
      font-weight: 500;
      transition: all 0.3s ease;
      position: relative;
      padding: 0.5rem 1rem !important;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
      color: var(--primary-color) !important;
    }

    .navbar-nav .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 1rem;
      right: 1rem;
      height: 2px;
      background: var(--gradient-primary);
    }

    /* BANNER */
    .page-title {
      background: linear-gradient(135deg, rgba(30, 30, 30, 0.9), rgba(15, 15, 15, 0.9)), 
                  url('https://images.unsplash.com/photo-1558981806-ec527fa84c39?q=80&w=2070') center/cover !important;
      position: relative;
      padding: 150px 0 80px;
    }

    .page-title::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h100v100H0z" fill="none"/><circle cx="50" cy="50" r="30" fill="rgba(255,94,0,0.03)"/></svg>');
    }

    .page-title h1 {
      color: white !important;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
      font-weight: 700;
    }

    /* SECTIONS */
    .section {
      background: var(--dark-bg);
      padding: 80px 0;
    }

    .section-title,
    .section h2 {
      color: #e0e0e0 !important;
      font-weight: 700;
    }

    .lead,
    .section p {
      color: #b0b0b0 !important;
    }

    .section-border {
      width: 80px;
      height: 4px;
      background: var(--gradient-primary);
      margin: 2rem auto;
      border-radius: 2px;
    }

    /* TEAM CARDS */
    .card {
      background: rgba(30, 30, 30, 0.98) !important;
      border: 1px solid rgba(255, 94, 0, 0.2) !important;
      border-radius: 8px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      position: relative;
    }

    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: var(--gradient-primary);
      border-radius: 8px 8px 0 0;
    }

    .card h4,
    .card-title {
      color: #e0e0e0 !important;
    }

    .card p,
    .card i {
      color: #b0b0b0 !important;
    }

    .card a {
      color: #e0e0e0 !important;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .card a:hover {
      color: var(--primary-color) !important;
    }

    .hover-shadow:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(255, 94, 0, 0.2) !important;
      border-color: rgba(255, 94, 0, 0.5) !important;
    }

    .card-img-top {
      border-radius: 0;
      object-fit: cover;
      height: 280px;
    }

    /* CLIENT LOGOS */
    .client-logo-slider {
      padding: 40px 0;
    }

    .client-logo-slider a {
      display: inline-block;
      padding: 1rem;
      opacity: 0.6;
      transition: all 0.3s ease;
    }

    .client-logo-slider a:hover {
      opacity: 1;
      transform: scale(1.1);
    }

    .client-logo-slider img {
      filter: brightness(0) invert(1);
      max-height: 60px;
    }

    /* FOOTER */
    footer {
      background: rgba(30, 30, 30, 0.98);
      border-top: 1px solid rgba(255, 94, 0, 0.2);
      color: #b0b0b0;
      padding: 60px 0 20px;
    }

    footer h4,
    footer h3 {
      color: white;
      margin-bottom: 1.5rem;
    }

    footer a {
      color: #b0b0b0;
      transition: all 0.3s ease;
    }

    footer a:hover {
      color: var(--primary-color);
      text-decoration: none;
    }

    footer .social-icons a {
      width: 40px;
      height: 40px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: rgba(255, 94, 0, 0.1);
      border-radius: 50%;
      margin: 0 0.3rem;
      transition: all 0.3s ease;
    }

    footer .social-icons a:hover {
      background: var(--gradient-primary);
      color: white;
      transform: translateY(-3px);
    }

    footer .bg-white {
      background: white !important;
      border-radius: 8px;
      border-top: 3px solid var(--primary-color);
    }

    footer .bg-white h3 {
      color: var(--secondary-color) !important;
    }

    footer .form-control {
      background: rgba(255, 255, 255, 0.95);
      border: none;
      border-bottom: 2px solid #e0e0e0;
      border-radius: 0;
      color: #1e1e1e;
      padding: 0.75rem 0;
      transition: all 0.3s ease;
    }

    footer .form-control:focus {
      background: white;
      border-bottom-color: var(--primary-color);
      box-shadow: none;
      outline: none;
    }

    footer .btn-primary {
      background: var(--gradient-primary);
      border: none;
      padding: 0.75rem 2rem;
      font-weight: 600;
      border-radius: 4px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(255, 94, 0, 0.3);
    }

    footer .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(255, 94, 0, 0.4);
    }

    footer .text-gradient-primary {
      background: var(--gradient-primary);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    /* EMPTY STATE */
    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: #b0b0b0;
    }

    .empty-state i {
      font-size: 4rem;
      color: rgba(255, 94, 0, 0.3);
      margin-bottom: 1rem;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      .page-title {
        padding: 100px 0 60px;
      }

      .page-title h1 {
        font-size: 2.5rem !important;
      }

      .card-img-top {
        height: 220px;
      }
    }
  </style>
</head>

<body>
  
<?php require_once 'modules/header.php' ?>

<!-- page title -->
<section class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1">Nuestro Equipo</h1>
        <p class="lead" style="color: #b0b0b0;">Apasionados moteros y periodistas dedicados a traerte el mejor contenido</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- team -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto text-center">
        <h2>Conoce a Nuestro Equipo</h2>
        <p>Riders experimentados que viven y respiran motocicletas</p>
        <div class="section-border"></div>
      </div>
    </div>
    <div class="row">
      <?php if (!empty($teamMembers)): ?>
        <?php foreach ($teamMembers as $member):
          $mphoto = !empty($member['photo']) ? htmlspecialchars($member['photo']) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800';
          $mname = !empty($member['name']) ? htmlspecialchars($member['name']) : 'Miembro';
          $mposition = !empty($member['position']) ? htmlspecialchars($member['position']) : 'Colaborador';
          $mdesc = !empty($member['short_description']) ? htmlspecialchars($member['short_description']) : '';
        ?>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card hover-shadow">
            <img src="<?php echo $mphoto; ?>" alt="<?php echo $mname; ?>" class="card-img-top">
            <div class="card-body text-center position-relative zindex-1">
              <h4><a href="team-single.php?id=<?php echo urlencode($member['id']); ?>"><?php echo $mname; ?></a></h4>
              <i class="d-block mb-2"><?php echo $mposition; ?></i>
              <?php if (!empty($mdesc)): ?>
                <p class="small mt-2"><?php echo $mdesc; ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="empty-state">
            <i class="fas fa-users"></i>
            <h3 style="color: #e0e0e0;">No hay miembros del equipo disponibles</h3>
            <p>Pronto agregaremos información sobre nuestro equipo</p>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- /team -->

<!-- client logos -->
<section class="section bg-secondary">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center mb-4">
        <h3 style="color: #e0e0e0;">Colaboramos Con</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="client-logo-slider d-flex align-items-center justify-content-center flex-wrap">
          <?php for($i=1;$i<=5;$i++): ?>
            <a href="#" class="text-center d-block outline-0">
              <img class="d-unset img-fluid" src="images/clients-logo/clients-logo-<?= $i ?>.png" alt="partner-logo">
            </a>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /client logos -->

<!-- footer -->
<footer class="bg-secondary position-relative">
  <img src="images/backgrounds/map.png" class="img-fluid overlay-image" alt="" style="opacity: 0.05;">
  <div class="section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-3 col-6">
          <h4 class="text-white mb-5">Rider Zone</h4>
          <ul class="list-unstyled">
            <li><a href="services.php" class="text-light d-block mb-3">Servicios</a></li>
            <li><a href="contact.php" class="text-light d-block mb-3">Contacto</a></li>
            <li><a href="about.php" class="text-light d-block mb-3">Nosotros</a></li>
            <li><a href="blog.php" class="text-light d-block mb-3">Noticias</a></li>
            <li><a href="faqs.php" class="text-light d-block mb-3">Soporte</a></li>
          </ul>
        </div>
        <div class="col-md-3 col-6">
          <h4 class="text-white mb-5">Comunidad</h4>
          <ul class="list-unstyled">
            <li><a href="team.php" class="text-light d-block mb-3">Equipo</a></li>
            <li><a href="career.php" class="text-light d-block mb-3">Carreras</a></li>
            <li><a href="pricing.php" class="text-light d-block mb-3">Precios</a></li>
            <li><a href="blog.php" class="text-light d-block mb-3">Blog</a></li>
            <li><a href="faqs.php" class="text-light d-block mb-3">FAQ's</a></li>
          </ul>
        </div>
        <div class="col-md-6">
          <div class="bg-white p-4">
            <h3>Contáctanos</h3>
            <form action="contact.php" method="POST">
              <input type="text" name="name" class="form-control mb-4 px-0" placeholder="Nombre completo" required>
              <input type="email" name="email" class="form-control mb-4 px-0" placeholder="Correo electrónico" required>
              <textarea name="message" class="form-control mb-4 px-0" placeholder="