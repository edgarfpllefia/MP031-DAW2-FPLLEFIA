<?php
session_start();
require_once 'config.php';

if(!isset($_SESSION['user_role'])){
  header('Location: ../login.php');
}

$usuario = $_SESSION['user_name'];
$email = $_SESSION['user_email'];


//Consulta para obtener lo de la tabla que consideres. Formato de la salida ->
$users = $mysqli ->query("SELECT * FROM users");
$testimonials = $mysqli ->query("SELECT * FROM testimonials");
$projects = $mysqli ->query("SELECT * FROM projects");
$news = $mysqli ->query("SELECT * FROM news");

$resultUsers = $users ->fetch_all(MYSQLI_ASSOC);
$resultTestimonials = $testimonials -> fetch_all(MYSQLI_ASSOC);
$resultdoProjects = $projects -> fetch_all(MYSQLI_ASSOC);
$resultNews = $news -> fetch_all(MYSQLI_ASSOC);



?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Rider Zone | Creative Motorcycle Agency</title>

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
    .banner {
      background: linear-gradient(135deg, rgba(30, 30, 30, 0.9), rgba(15, 15, 15, 0.9)), 
                  url('https://images.unsplash.com/photo-1558981806-ec527fa84c39?q=80&w=2070') center/cover !important;
      position: relative;
      padding: 150px 0;
    }

    .banner::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h100v100H0z" fill="none"/><circle cx="50" cy="50" r="30" fill="rgba(255,94,0,0.03)"/></svg>');
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

    /* CARDS */
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

    .card h4,
    .card-title {
      color: #e0e0e0 !important;
    }

    .card p,
    .card i {
      color: #b0b0b0 !important;
    }

    .hover-bg-secondary:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(255, 94, 0, 0.2) !important;
      border-color: rgba(255, 94, 0, 0.5) !important;
    }

    .hover-bg-secondary.active,
    .hover-bg-secondary:hover {
      background: var(--secondary-color) !important;
    }

    .hover-bg-secondary.active *,
    .hover-bg-secondary:hover * {
      color: white !important;
    }

    /* ICONS */
    .icon-box {
      background: var(--gradient-primary) !important;
    }

    .bg-gradient-primary {
      background: var(--gradient-primary) !important;
    }

    .text-gradient-primary {
      background: var(--gradient-primary);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .icon-watermark {
      color: rgba(255, 94, 0, 0.1) !important;
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

    .btn-outline-light {
      border: 2px solid white;
      color: white;
      font-weight: 600;
      padding: 0.75rem 2rem;
      transition: all 0.3s ease;
    }

    .btn-outline-light:hover {
      background: white;
      color: var(--primary-color);
      transform: translateY(-2px);
    }

    .btn-transparent {
      color: var(--primary-color) !important;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-transparent:hover {
      color: var(--primary-dark) !important;
      transform: translateX(5px);
    }

    /* FEATURE SECTION */
    .bg-secondary {
      background: var(--secondary-color) !important;
    }

    .overlay-secondary {
      background: rgba(30, 30, 30, 0.9) !important;
    }

    .text-white {
      color: white !important;
    }

    .text-light {
      color: #b0b0b0 !important;
    }

    .icon {
      color: var(--primary-color) !important;
      font-size: 2rem;
    }

    /* TEAM CARDS */
    .hover-shadow:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(255, 94, 0, 0.2) !important;
    }

    .card a:hover {
      color: var(--primary-color) !important;
    }

    /* ABOUT SECTION */
    .section-lg {
      background: linear-gradient(135deg, rgba(30, 30, 30, 0.95), rgba(15, 15, 15, 0.95)), 
                  url('images/backgrounds/about-bg.jpg') center/cover !important;
      padding: 100px 0;
    }

    .overlay-image {
      opacity: 0.1;
    }

    .venobox i {
      background: var(--gradient-primary) !important;
      width: 80px;
      height: 80px;
      line-height: 80px;
      font-size: 2rem;
    }

    .venobox:hover i {
      transform: scale(1.1);
      box-shadow: 0 8px 25px rgba(255, 94, 0, 0.4);
    }

    /* PROJECT ITEMS */
    .project-item {
      position: relative;
      overflow: hidden;
    }

    .project-item img {
      width: 100%;
      display: block;
      height: 300px;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .project-item:hover img {
      transform: scale(1.05);
    }

    .project-hover {
      background: linear-gradient(180deg, rgba(15,15,15,0.85), rgba(20,20,20,0.95)) !important;
      border-top: 3px solid var(--primary-color);
      position: absolute;
      left: 0;
      right: 0;
      bottom: 0;
      transform: translateY(100%);
      transition: transform 0.35s ease, opacity 0.35s ease;
      z-index: 4;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 25px;
      min-height: 80px;
      opacity: 0.98;
    }

    .project-item:hover .project-hover {
      transform: translateY(0);
    }

    .project-hover a {
      color: white !important;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .project-hover a:hover {
      color: var(--primary-color) !important;
    }

    .project-hover i {
      color: var(--primary-color) !important;
      font-size: 1.3rem;
    }

    /* Mobile: show overlay by default */
    @media (max-width: 767px) {
      .project-hover {
        position: relative;
        transform: translateY(0) !important;
        opacity: 1 !important;
        display: block;
        padding: 15px 20px;
      }
      .project-item img {
        height: auto;
      }
    }

    /* CTA SECTION */
    .overlay-secondary-half {
      background: linear-gradient(135deg, rgba(30, 30, 30, 0.95), rgba(15, 15, 15, 0.9)) !important;
      border: 1px solid rgba(255, 94, 0, 0.2);
      border-radius: 12px;
      padding: 80px 40px;
    }

    /* PRICING */
    .bottom-shape {
      position: relative;
      background: rgba(30, 30, 30, 0.98) !important;
      border: 1px solid rgba(255, 94, 0, 0.2) !important;
    }

    .bottom-shape::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: var(--gradient-primary);
    }

    .bottom-shape:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(255, 94, 0, 0.2);
      border-color: rgba(255, 94, 0, 0.5) !important;
    }

    /* BLOG */
    .card-img-top {
      border-radius: 8px 8px 0 0;
    }

    article.card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(255, 94, 0, 0.2) !important;
      border-color: rgba(255, 94, 0, 0.5) !important;
    }

    time {
      color: var(--primary-color) !important;
      font-weight: 600;
    }

    .hover-text-underline:hover {
      color: var(--primary-color) !important;
      text-decoration: underline;
    }

    /* FOOTER */
    footer {
      background: rgba(30, 30, 30, 0.98);
      border-top: 1px solid rgba(255, 94, 0, 0.2);
      color: #b0b0b0;
      padding: 60px 0 20px;
    }

    footer h4 {
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

    .empty-state h3 {
      color: #e0e0e0;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      .banner {
        padding: 100px 0;
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

<!-- banner -->
<section class="banner bg-cover position-relative d-flex justify-content-center align-items-center"
  data-background="images/banner/banner2.jpg">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">Rider Zone Agency</h1>
      </div>
    </div>
  </div>
</section>
<!-- /banner -->

<!-- Noticias-->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto text-center">
        <h2>Últimas Noticias</h2>
        <div class="section-border"></div>
      </div>
    </div>
    <div class="row">
      <?php
      // Mostrar solo las 3 noticias más recientes
      $noticias = [];
      if (isset($mysqli) && $mysqli) {
        $stmt = $mysqli->prepare("SELECT id, date_publication, image, title, subtitle, description FROM news ORDER BY date_publication DESC LIMIT 3");
        if ($stmt) {
          $stmt->execute();
          $res = $stmt->get_result();
          if ($res) $noticias = $res->fetch_all(MYSQLI_ASSOC);
          $stmt->close();
        }
      }
      
      if (!empty($noticias)):
        foreach ($noticias as $n):
          $img = !empty($n['image']) ? htmlspecialchars($n['image']) : 'images/blog/post-1.jpg';
          $date = !empty($n['date_publication']) ? date('d/m/Y', strtotime($n['date_publication'])) : '';
          $title = !empty($n['title']) ? htmlspecialchars($n['title']) : '';
          $excerpt = '';
          if (!empty($n['subtitle'])) {
            $excerpt = htmlspecialchars($n['subtitle']);
          } elseif (!empty($n['description'])) {
            $excerpt = htmlspecialchars(mb_substr(strip_tags($n['description']),0,140));
          }
      ?>
      <div class="col-lg-4 col-md-6 mb-4">
        <article class="card hover-shadow">
          <img src="<?php echo $img; ?>" alt="noticia" class="card-img-top mb-2 p-2" style="object-fit: cover; height: 300px;">
          <div class="card-body p-4">
            <time><?php echo $date; ?></time>
            <a href="blog-single.php?id=<?php echo urlencode($n['id']); ?>" class="h4 card-title d-block my-3 hover-text-underline"><?php echo $title; ?></a>
            <p class="card-text text-light"><?php echo $excerpt; ?></p>
            <a href="blog-single.php?id=<?php echo urlencode($n['id']); ?>" class="btn btn-transparent">Leer más</a>
          </div>
        </article>
      </div>
      <?php 
        endforeach;
      else:
      ?>
      <div class="col-12">
        <div class="empty-state">
          <i class="fas fa-newspaper"></i>
          <h3>No hay noticias disponibles</h3>
          <p>Pronto publicaremos nuevas noticias</p>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- /Noticias -->

<!-- team -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto text-center">
        <h2>Nuestro Equipo</h2>
        <p>Apasionados moteros y periodistas dedicados a traerte el mejor contenido</p>
        <div class="section-border"></div>
      </div>
    </div>
    <div class="row no-gutters">
      <?php
      $teamMembers = [];
      if (isset($mysqli) && $mysqli) {
        $tr = $mysqli->query("SELECT id, name, position, photo, short_description, email, created_at FROM team ORDER BY id ASC LIMIT 4");
        if ($tr) $teamMembers = $tr->fetch_all(MYSQLI_ASSOC);
      }
      if (!empty($teamMembers)):
        foreach ($teamMembers as $member):
          $mphoto = !empty($member['photo']) ? htmlspecialchars($member['photo']) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800';
          $mname = !empty($member['name']) ? htmlspecialchars($member['name']) : 'Miembro';
          $mposition = !empty($member['position']) ? htmlspecialchars($member['position']) : '';
        ?>
        <div class="col-lg-3 col-sm-6">
          <div class="card hover-shadow">
            <img src="<?php echo $mphoto; ?>" alt="team-member" class="card-img-top" style="object-fit:cover; height:260px;">
            <div class="card-body text-center position-relative zindex-1 p-4">
              <h4><a class="text-white" href="team-single.php?id=<?php echo urlencode($member['id']); ?>"><?php echo $mname; ?></a></h4>
              <i class="text-light"><?php echo $mposition; ?></i>
            </div>
          </div>
        </div>
        <?php endforeach;
      else: ?>
        <div class="col-12">
          <div class="empty-state">
            <i class="fas fa-users"></i>
            <h3>No hay miembros del equipo disponibles</h3>
            <p>Pronto presentaremos a nuestro equipo</p>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- /team -->

<!-- about -->
<section class="section-lg position-relative bg-cover" data-background="">
  <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?q=80&w=2070" alt="" class="overlay-image img-fluid">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-6 col-md-8 col-sm-7 col-8">
        <h2 class="text-white mb-4">Quiénes Somos</h2>
        <p class="text-light mb-4">Somos una comunidad digital líder en noticias, reviews y contenido especializado sobre motocicletas. Desde 2015, nos hemos dedicado a proporcionar información de calidad para riders apasionados como tú.</p>
        <a href="about.php" class="btn btn-primary">Leer Más</a>
      </div>
      <div class="col-md-2 col-sm-4 col-4 text-right align-self-end">
        <a class="venobox" data-autoplay="true" data-vbtype="video"
          href="https://www.youtube.com/watch?v=3JZ_D3ELwOQ"><i
            class="text-center icon-sm icon-box rounded-circle text-white bg-gradient-primary d-block ti-control-play"></i></a>
      </div>
    </div>
  </div>
</section>
<!-- /about -->

<!-- project -->
<section class="section">
  <div class="container-fluid px-0">
    <div class="row">
      <div class="col-lg-10 mx-auto text-center mb-5">
        <h2>Nuestros Proyectos</h2>
        <div class="section-border"></div>
      </div>
    </div>

    <div class="row no-gutters shuffle-wrapper">
      <?php
      // Obtener proyectos
      $projectsList = [];
      if (!empty($mysqli)) {
        if ($stmt = $mysqli->prepare("SELECT id, title, subtitle, description, photo, link, comments_count FROM projects ORDER BY id DESC LIMIT 6")) {
          $stmt->execute();
          $projectsList = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
          $stmt->close();
        }
      }

      // Mostrar proyectos
      if (!empty($projectsList)):
        foreach ($projectsList as $proj):
          $pimg  = htmlspecialchars($proj['photo'] ?? 'images/project/project-1.jpg');
          $ptitle = htmlspecialchars($proj['title'] ?? 'Proyecto');
          $plink  = htmlspecialchars($proj['link'] ?? '#');
      ?>
      <div class="col-lg-4 col-md-6 shuffle-item">
        <div class="project-item">
          <img src="<?php echo $pimg; ?>" alt="<?php echo $ptitle; ?>">
          <div class="project-hover">
            <a href="<?php echo $plink; ?>" class="h4 text-white" target="_blank"><?php echo $ptitle; ?></a>
            <a href="<?php echo $plink; ?>" target="_blank"><i class="ti-link icon-xs"></i></a>
          </div>
        </div>
      </div>
      <?php 
        endforeach; 
      else: 
      ?>
      <div class="col-12">
        <div class="empty-state">
          <i class="fas fa-folder-open"></i>
          <h3>No hay proyectos disponibles</h3>
          <p>Pronto agregaremos nuevos proyectos</p>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- /project -->

<!-- call to action -->
<section>
  <div class="container section-sm overlay-secondary-half bg-cover" data-background="images/backgrounds/cta-bg.jpg">
    <div class="row">
      <div class="col-lg-8 offset-lg-1">
        <h2 class="text-gradient-primary">¡Comencemos Juntos!</h2>
        <p class="h4 font-weight-bold text-white mb-4">Únete a la comunidad motera más grande de habla hispana</p>
        <a href="contact.php" class="btn btn-lg btn-primary">Hablemos</a>
      </div>
    </div>
  </div>
</section>
<!-- /call to action -->

<!-- blog -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto text-center">
        <h2>Blog Reciente</h2>
        <div class="section-border"></div>
      </div>
    </div>
    <div class="row">
      <?php
      $newsItems = [];
      if (isset($mysqli) && $mysqli) {
        $stmt = $mysqli->prepare("SELECT id, date_publication, image, title, subtitle, description FROM news ORDER BY date_publication DESC LIMIT 3");
        if ($stmt) {
          $stmt->execute();
          $res = $stmt->get_result();
          if ($res) $newsItems = $res->fetch_all(MYSQLI_ASSOC);
          $stmt->close();
        }
      }

      if (!empty($newsItems)):
        foreach($newsItems as $item): 
          $itemImg = !empty($item['image']) ? htmlspecialchars($item['image']) : 'images/blog/post-1.jpg';
          $itemDate = !empty($item['date_publication']) ? date('d/m/Y', strtotime($item['date_publication'])) : '';
          $itemTitle = !empty($item['title']) ? htmlspecialchars($item['title']) : '';
      ?>
      <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
        <article class="card hover-shadow">
          <img src="<?php echo $itemImg; ?>" alt="post-thumb" class="card-img-top mb-2" style="object-fit: cover; height: 250px;">
          <div class="card-body p-4">
            <time><?php echo $itemDate; ?></time>
            <a href="blog-single.php?id=<?php echo urlencode($item['id']); ?>" class="h4 card-title d-block my-3 hover-text-underline"><?php echo $itemTitle; ?></a>
            <a href="blog-single.php?id=<?php echo urlencode($item['id']); ?>" class="btn btn-transparent">Leer más</a>
          </div>
        </article>
      </div>
      <?php 
        endforeach;
      else:
      ?>
      <div class="col-12">
        <div class="empty-state">
          <i class="fas fa-newspaper"></i>
          <h3>No hay artículos de blog disponibles</h3>
          <p>Pronto publicaremos nuevo contenido</p>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- /blog -->
 
<?php
include_once 'modules/footer.php'
?>

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