<?php
session_start();
require_once 'config.php';

if(!isset($_SESSION['user_role'])){
  header('Location: ../login.php');
}

// Obtener métricas básicas
$newsCount = 0;
$projectsCount = 0;
$usersCount = 0;
$testimonials = [];

if(isset($mysqli) && $mysqli){
  $r = $mysqli->query("SELECT COUNT(*) AS c FROM news");
  $newsCount = $r ? (int)$r->fetch_assoc()['c'] : 0;
  $r = $mysqli->query("SELECT COUNT(*) AS c FROM projects");
  $projectsCount = $r ? (int)$r->fetch_assoc()['c'] : 0;
  $r = $mysqli->query("SELECT COUNT(*) AS c FROM users");
  $usersCount = $r ? (int)$r->fetch_assoc()['c'] : 0;

  $tres = $mysqli->query("SELECT id, name, photo, info FROM testimonials ORDER BY id DESC LIMIT 6");
  if($tres) $testimonials = $tres->fetch_all(MYSQLI_ASSOC);

  // Obtener miembros del equipo
  $teamMembers = [];
  $tr = $mysqli->query("SELECT id, name, position, photo, short_description, email, created_at FROM team ORDER BY id ASC LIMIT 4");
  if ($tr) $teamMembers = $tr->fetch_all(MYSQLI_ASSOC);
}

// Calcular porcentajes simples para las barras
$totalNP = max(1, $newsCount + $projectsCount);
$coveragePercent = $newsCount ? min(100, (int)round($newsCount / $totalNP * 100)) : 0;
$reviewsPercent = $projectsCount ? min(100, (int)round($projectsCount / $totalNP * 100)) : 0;
$guidesPercent = min(100, (int)round((($newsCount + $projectsCount) / ($totalNP * 2)) * 100));
$communityPercent = $usersCount ? min(100, (int)round($usersCount / max(1, $usersCount + 50) * 100)) : 0;

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Sobre Nosotros | Rider Zone</title>

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

    /* PAGE TITLE */
    .page-title {
      background: linear-gradient(135deg, rgba(30, 30, 30, 0.9), rgba(15, 15, 15, 0.9)), 
                  url('https://images.unsplash.com/photo-1558981806-ec527fa84c39?q=80&w=2070') center/cover !important;
      padding: 120px 0 80px;
      position: relative;
    }

    .display-1 {
      color: white !important;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
    }

    /* SECTIONS */
    .section {
      background: var(--dark-bg);
      padding: 80px 0;
    }

    .bg-secondary {
      background: var(--secondary-color) !important;
    }

    .section h2,
    .section h3,
    .section h4,
    .section h6 {
      color: #e0e0e0 !important;
    }

    .section p {
      color: #b0b0b0 !important;
    }

    .text-white {
      color: white !important;
    }

    .text-light {
      color: #b0b0b0 !important;
    }

    .section-border {
      width: 80px;
      height: 4px;
      background: var(--gradient-primary);
      margin: 2rem auto;
      border-radius: 2px;
    }

    /* PROGRESS BARS */
    .progress-block {
      margin-bottom: 2rem;
    }

    .progress {
      height: 8px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 10px;
      overflow: visible;
    }

    .progress-bar {
      background: var(--gradient-primary);
      border-radius: 10px;
      position: relative;
      transition: width 2s ease;
    }

    .skill-number {
      position: absolute;
      right: 0;
      top: -35px;
      color: var(--primary-color) !important;
      font-weight: 700;
    }

    /* VIDEO PLAYER */
    .video-player {
      position: relative;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 15px 50px rgba(0,0,0,0.5);
    }

    .overlay-secondary {
      position: relative;
    }

    .overlay-secondary::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(30, 30, 30, 0.3);
      z-index: 1;
    }

    .play-icon {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      cursor: pointer;
    }

    .icon-box-sm {
      width: 80px;
      height: 80px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--gradient-primary) !important;
      font-size: 2rem;
      transition: all 0.3s ease;
      position: relative;
    }

    .icon-box-sm:hover {
      transform: scale(1.1);
      box-shadow: 0 8px 25px rgba(255, 94, 0, 0.5);
    }

    .ripple {
      position: absolute;
      width: 100%;
      height: 100%;
      border: 2px solid var(--primary-color);
      border-radius: 50%;
      animation: ripple 1.5s infinite;
    }

    @keyframes ripple {
      0% {
        transform: scale(1);
        opacity: 1;
      }
      100% {
        transform: scale(1.5);
        opacity: 0;
      }
    }

    /* TEAM CARDS */
    .card {
      background: rgba(30, 30, 30, 0.98) !important;
      border: 1px solid rgba(255, 94, 0, 0.2) !important;
      border-radius: 8px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
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

    .hover-shadow:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(255, 94, 0, 0.2) !important;
      border-color: rgba(255, 94, 0, 0.5) !important;
    }

    .card h4 a {
      color: #e0e0e0 !important;
      transition: color 0.3s ease;
    }

    .card h4 a:hover {
      color: var(--primary-color) !important;
    }

    .card i {
      color: #b0b0b0 !important;
    }

    /* TESTIMONIAL SLIDER */
    .ui-card-slider .card {
      background: white !important;
      border: none !important;
    }

    .ui-card-slider .card::before {
      display: none;
    }

    .ui-card-slider h4 {
      color: var(--secondary-color) !important;
    }

    .ui-card-slider p {
      color: #666 !important;
    }

    .text-secondary {
      color: var(--primary-color) !important;
    }

    /* CTA SECTION */
    .overlay-secondary-half {
      background: linear-gradient(135deg, rgba(30, 30, 30, 0.95), rgba(15, 15, 15, 0.9)) !important;
      border: 1px solid rgba(255, 94, 0, 0.2);
      border-radius: 12px;
      padding: 80px 40px;
    }

    .text-gradient-primary {
      background: var(--gradient-primary);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    /* BUTTONS */
    .btn-primary {
      background: var(--gradient-primary) !important;
      border: none !important;
      padding: 0.75rem 2rem;
      font-weight: 600;
      border-radius: 4px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(255, 94, 0, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(255, 94, 0, 0.4) !important;
    }

    .btn-lg {
      padding: 1rem 2.5rem;
      font-size: 1.1rem;
    }

    /* FOOTER */
    footer.bg-secondary {
      background: rgba(30, 30, 30, 0.98) !important;
      border-top: 1px solid rgba(255, 94, 0, 0.2);
      position: relative;
    }

    footer .overlay-image {
      opacity: 0.05;
    }

    footer h4 {
      color: white !important;
    }

    footer a {
      color: #b0b0b0 !important;
      transition: all 0.3s ease;
    }

    footer a:hover {
      color: var(--primary-color) !important;
    }

    footer .form-control {
      background: rgba(255, 255, 255, 0.95);
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 0.75rem 1rem;
    }

    footer .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(255, 94, 0, 0.1);
    }

    .list-inline-item a {
      background: rgba(255, 94, 0, 0.1);
      width: 45px;
      height: 45px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      transition: all 0.3s ease;
    }

    .list-inline-item a:hover {
      background: var(--gradient-primary);
      transform: translateY(-3px);
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      .page-title {
        padding: 80px 0 50px;
      }

      .display-1 {
        font-size: 2.5rem !important;
      }
    }
  </style>
</head>

<body>

<?php
require_once 'modules/header.php'
?>

<!-- page-title -->
<section class="page-title bg-cover" data-background="images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">Sobre Rider Zone</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<!-- progressbar -->
<section class="section pb-0">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mb-4 mb-lg-0">
        <img src="images/about/about-us.png" alt="about" class="img-fluid">
      </div>
      <div class="col-md-6 col-lg-5">
        <h2 class="mb-4">Nuestra Pasión por las Motos</h2>
        <p class="mb-4">Rider Zone es la comunidad digital líder en noticias, reviews y contenido especializado sobre el mundo de las motocicletas. Desde 2015, hemos conectado a miles de moteros apasionados con información actualizada y de calidad.</p>
        
        <div class="progress-block">
          <h6 class="text-uppercase">Cobertura de Noticias</h6>
          <div class="progress">
            <div class="progress-bar" data-percent="<?php echo $coveragePercent; ?>" style="width: <?php echo $coveragePercent; ?>%">
              <span class="skill-number text-dark font-weight-bold"><span class="count"><?php echo $coveragePercent; ?></span>%</span>
            </div>
          </div>
        </div>
        <div class="progress-block">
          <h6 class="text-uppercase">Reviews de Motos</h6>
          <div class="progress">
            <div class="progress-bar" data-percent="<?php echo $reviewsPercent; ?>" style="width: <?php echo $reviewsPercent; ?>%">
              <span class="skill-number text-dark font-weight-bold"><span class="count"><?php echo $reviewsPercent; ?></span>%</span>
            </div>
          </div>
        </div>
        <div class="progress-block">
          <h6 class="text-uppercase">Guías de Rutas</h6>
          <div class="progress">
            <div class="progress-bar" data-percent="<?php echo $guidesPercent; ?>" style="width: <?php echo $guidesPercent; ?>%">
              <span class="skill-number text-dark font-weight-bold"><span class="count"><?php echo $guidesPercent; ?></span>%</span>
            </div>
          </div>
        </div>
        <div class="progress-block">
          <h6 class="text-uppercase">Comunidad Activa</h6>
          <div class="progress">
            <div class="progress-bar" data-percent="<?php echo $communityPercent; ?>" style="width: <?php echo $communityPercent; ?>%">
              <span class="skill-number text-dark font-weight-bold"><span class="count"><?php echo $communityPercent; ?></span>%</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /progressbar -->

<!-- video -->
<section class="section pb-0">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="overlay-secondary video-player">
          <img src="https://www.galgo.com/wp-content/uploads/2023/05/Las-mejores-7-motos-para-viajar-1.jpg" alt="video-thumb" class="img-fluid w-100">
          <a class="play-icon">
            <i class="text-center icon-sm icon-box-sm rounded-circle text-white bg-gradient-primary d-block ti-control-play content-center"
              data-video="https://www.youtube.com/watch?v=oR_NwwIV3x0">
              <div class="ripple"></div>
            </i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /video -->

<!-- team -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto text-center">
        <h2>Nuestro Equipo</h2>
        <p>Apasionados moteros y periodistas especializados dedicados a traerte el mejor contenido</p>
        <div class="section-border"></div>
      </div>
    </div>
    <div class="row no-gutters">
      <?php if (!empty($teamMembers)): ?>
        <?php foreach ($teamMembers as $member):
          $mphoto = !empty($member['photo']) ? htmlspecialchars($member['photo']) : 'images/team/member-1.jpg';
          $mname = !empty($member['name']) ? htmlspecialchars($member['name']) : 'Miembro';
          $mposition = !empty($member['position']) ? htmlspecialchars($member['position']) : '';
          $mdesc = !empty($member['short_description']) ? htmlspecialchars($member['short_description']) : '';
        ?>
        <div class="col-lg-3 col-sm-6">
          <div class="card hover-shadow">
            <img src="<?php echo $mphoto; ?>" alt="team-member" class="card-img-top" style="object-fit:cover; height:260px;">
            <div class="card-body text-center position-relative zindex-1 p-4">
              <h4><a class="text-white" href="team-single.php?id=<?php echo urlencode($member['id']); ?>"><?php echo $mname; ?></a></h4>
              <i class="text-light"><?php echo $mposition; ?></i>
              <?php if (!empty($mdesc)): ?>
                <p class="text-light mt-2 small"><?php echo $mdesc; ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center text-muted">No hay miembros del equipo disponibles.</div>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- /team -->

<!-- testimonial-slider -->
<!-- testimonial-slider dinámico -->
<section class="section bg-secondary">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="text-white mb-5">Lo Que Dicen Nuestros Lectores</h2>
      </div>
    </div>

    <div class="row bg-contain" data-background="images/banner/brush.png">
      <div class="col-lg-8 col-md-10 mx-auto">

        <?php if (!empty($testimonials)): ?>
        <div id="slider" class="ui-card-slider bg-contain">

          <?php foreach ($testimonials as $testimonial): ?>
          <div class="slide">
            <div class="card text-center">
              <div class="card-body px-5 py-4">

                 <!-- FOTO -->
                 <?php $photo = !empty($testimonial['photo']) ? htmlspecialchars($testimonial['photo']) : 'images/team/member-1.jpg'; ?>
                 <img src="<?php echo $photo; ?>"
                   alt="<?php echo htmlspecialchars($testimonial['name']); ?>"
                   class="img-fluid rounded-circle mb-4">

                <!-- NOMBRE -->
                <h4 class="text-secondary">
                  <?php echo htmlspecialchars($testimonial['name']); ?>
                </h4>

                <!-- TEXTO -->
                <p>
                  "<?php echo htmlspecialchars($testimonial['info']); ?>"
                </p>

              </div>
            </div>
          </div>
          <?php endforeach; ?>

        </div>
        <?php else: ?>

        <div class="text-center text-white">
          <p class="text-muted">No hay testimonios disponibles en este momento.</p>
        </div>

        <?php endif; ?>

      </div>
    </div>
  </div>
</section>
<!-- /testimonial-slider dinámico -->

<!-- /testimonial-slider -->

<!-- call to action -->
<section class="section">
  <div class="container section-sm overlay-secondary-half bg-cover" data-background="images/backgrounds/cta-bg.jpg">
  <div class="row">
    <div class="col-lg-8 offset-lg-1">
      <h2 class="text-gradient-primary">¡Únete a Nuestra Comunidad!</h2>
      <p class="h4 font-weight-bold text-white mb-4">Forma parte de la mayor comunidad de moteros en español</p>
      <a href="contact.html" class="btn btn-lg btn-primary">Contáctanos</a>
    </div>
  </div>
</div>
</section>
<!-- /call to action -->

<!-- footer -->
<footer class="bg-secondary position-relative">
  <img src="images/backgrounds/map.png" class="img-fluid overlay-image" alt="">
  <div class="section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-3 col-6">
          <h4 class="text-white mb-5">Sobre Nosotros</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light d-block mb-3">Servicios</a></li>
            <li><a href="#" class="text-light d-block mb-3">Contacto</a></li>
            <li><a href="#" class="text-light d-block mb-3">Quiénes Somos</a></li>
            <li><a href="#" class="text-light d-block mb-3">Blog</a></li>
            <li><a href="#" class="text-light d-block mb-3">Soporte</a></li>
          </ul>
        </div>
        <div class="col-md-3 col-6">
          <h4 class="text-white mb-5">Comunidad</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light d-block mb-3">Noticias</a></li>
            <li><a href="#" class="text-light d-block mb-3">Rutas</a></li>
            <li><a href="#" class="text-light d-block mb-3">Reviews</a></li>
            <li><a href="#" class="text-light d-block mb-3">Eventos</a></li>
            <li><a href="#" class="text-light d-block mb-3">Foro</a></li>
          </ul>
        </div>
        <div class="col-md-6">
          <div class="bg-white p-4">
            <h3>Contáctanos</h3>
            <form action="#">
              <input type="text" id="name" name="name" class="form-control mb-4 px-0" placeholder="Nombre completo">
              <input type="email" id="email" name="email" class="form-control mb-4 px-0" placeholder="Email">
              <textarea name="message" id="message" class="form-control mb-4 px-0" placeholder="Mensaje"></textarea>
              <button class="btn btn-primary" type="submit">Enviar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="pb-4">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-left">
          <p class="text-light mb-0">Copyright &copy; 2024 <a class="text-gradient-primary" href="#">Rider Zone</a> - Todos los derechos reservados
          </p>
        </div>
        <div class="col-md-6">
          <ul class="list-inline text-md-right text-center">
            <li class="list-inline-item"><a class="d-block p-3 text-white" href="#"><i class="ti-facebook"></i></a></li>
            <li class="list-inline-item"><a class="d-block p-3 text-white" href="#"><i class="ti-twitter-alt"></i></a></li>
            <li class="list-inline-item"><a class="d-block p-3 text-white" href="#"><i class="ti-instagram"></i></a></li>
            <li class="list-inline-item"><a class="d-block p-3 text-white" href="#"><i class="ti-youtube"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- /footer -->

<!-- jQuery -->
<script src="plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<!-- slick slider -->
<script src="plugins/slick/slick.min.js"></script>
<!-- venobox -->
<script src="plugins/venobox/venobox.min.js"></script>
<!-- shuffle -->
<script src="plugins/shuffle/shuffle.min.js"></script>
<!-- apear js -->
<script src="plugins/counto/apear.js"></script>
<!-- counter -->
<script src="plugins/counto/counTo.js"></script>
<!-- card slider -->
<script src="plugins/card-slider/js/card-slider-min.js"></script>

<!-- Main Script -->
<script src="js/script.js"></script>

</body>
</html>