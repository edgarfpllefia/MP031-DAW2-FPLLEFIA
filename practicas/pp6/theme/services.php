<?php
session_start();
require_once 'config.php';

if(!isset($_SESSION['user_role'])){
  header('Location: ../login.php');
}

$services = [];
if (isset($mysqli) && $mysqli) {
  $stmt = $mysqli->prepare("SELECT id, foto, nombre_servicio, descripcion_servicio, fecha_creacion FROM services ORDER BY fecha_creacion DESC");
  if ($stmt) {
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res) $services = $res->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
  }
}

?>

<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Agen | Bootstrap Agency Template</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  <!-- ** Plugins Needed for the Project ** -->
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

  <!-- Main Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <style>
    /* COLORES PERSONALIZADOS RIDER ZONE (copiado de index.php) */
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

    .btn-primary {
      background: var(--gradient-primary) !important;
      border: none !important;
      padding: 0.75rem 2rem;
      font-weight: 600;
      border-radius: 4px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(255, 94, 0, 0.3);
    }
  </style>
  
  <!--Favicon-->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">

</head>

<body>
  

<?php
require_once 'modules/header.php'
?>

<!-- page-title -->
<section class="page-title bg-cover" data-background="https://imgs.search.brave.com/2qDEBy5_82qNEpxrLT3JmLo7WufiSxra2Z8BsvPRVBI/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jZG4u/cGl4YWJheS5jb20v/cGhvdG8vMjAxNi8w/Mi8wMi8wNi8zOS90/aHJlZS1tb3RvcmN5/Y2xlcy0xMTc0ODYz/XzY0MC5qcGc">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">Nuestros servicios</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<!-- service -->
<section class="section">
  <div class="container">
    <div class="row">
      <?php if (!empty($services)): ?>
        <?php foreach ($services as $svc): ?>
          <?php
            $img = !empty($svc['foto']) ? htmlspecialchars($svc['foto']) : 'images/services/default.jpg';
            $name = !empty($svc['nombre_servicio']) ? htmlspecialchars($svc['nombre_servicio']) : 'Servicio';
            $desc = !empty($svc['descripcion_servicio']) ? htmlspecialchars(mb_substr(strip_tags($svc['descripcion_servicio']),0,140)) : '';
          ?>
          <div class="col-lg-4 col-sm-6 mb-4">
            <div class="card hover-bg-secondary shadow py-4">
              <div class="card-body text-center">
                <div class="position-relative">
                  <img src="<?php echo $img; ?>" alt="<?php echo $name; ?>" class="img-fluid rounded-circle mb-3" style="width:80px;height:80px;object-fit:cover;">
                </div>
                <h4 class="mb-4"><?php echo $name; ?></h4>
                <p><?php echo $desc; ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center text-muted">No hay servicios disponibles.</div>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- /service -->

<!-- feature -->
<section class="section bg-secondary position-relative">
  <div class="bg-image overlay-secondary">
    <img src="images/feature.jpg" alt="bg-image">
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <div class="row align-items-center">
          <div class="col-lg-4 mb-4 mb-lg-0">
            <img src="images/feature.jpg" alt="feature-image" class="img-fluid">
          </div>
          <div class="col-lg-7 offset-lg-1">
            <div class="row">
              <div class="col-12">
                <h2 class="text-white">We know What Bait to Use</h2>
                <div class="section-border ml-0"></div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="media">
                  <i class="icon text-gradient-primary ti-vector mr-3"></i>
                  <div class="media-body">
                    <h4 class="text-white">User Experience</h4>
                    <p class="text-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmo</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="media">
                  <i class="icon text-gradient-primary ti-layout mr-3"></i>
                  <div class="media-body">
                    <h4 class="text-white">Responsive Layout</h4>
                    <p class="text-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmo</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="media">
                  <i class="icon text-gradient-primary ti-headphone-alt mr-3"></i>
                  <div class="media-body">
                    <h4 class="text-white">Digital Solutions</h4>
                    <p class="text-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmo</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="media">
                  <i class="icon text-gradient-primary ti-ruler-pencil mr-3"></i>
                  <div class="media-body">
                    <h4 class="text-white">Bootstrap 4x</h4>
                    <p class="text-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmo</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /feature -->

<!-- call to action -->
<section class="section">
  <div class="container section-sm overlay-secondary-half bg-cover" data-background="images/backgrounds/cta-bg.jpg">
  <div class="row">
    <div class="col-lg-8 offset-lg-1">
      <h2 class="text-gradient-primary">Let's Start With Us!</h2>
      <p class="h4 font-weight-bold text-white mb-4">Lorem ipsum dolor sit amet, magna habemus ius ad</p>
      <a href="contact.html" class="btn btn-lg btn-primary">Let’s talk</a>
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
          <h4 class="text-white mb-5">About</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light d-block mb-3">Service</a></li>
            <li><a href="#" class="text-light d-block mb-3">Conatact</a></li>
            <li><a href="#" class="text-light d-block mb-3">About us</a></li>
            <li><a href="#" class="text-light d-block mb-3">Blog</a></li>
            <li><a href="#" class="text-light d-block mb-3">Support</a></li>
          </ul>
        </div>
        <div class="col-md-3 col-6">
          <h4 class="text-white mb-5">Company</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light d-block mb-3">Service</a></li>
            <li><a href="#" class="text-light d-block mb-3">Conatact</a></li>
            <li><a href="#" class="text-light d-block mb-3">About us</a></li>
            <li><a href="#" class="text-light d-block mb-3">Blog</a></li>
            <li><a href="#" class="text-light d-block mb-3">Support</a></li>
          </ul>
        </div>
        <div class="col-md-6">
          <div class="bg-white p-4">
            <h3>Contact us</h3>
            <form action="#">
              <input type="text" id="name" name="name" class="form-control mb-4 px-0" placeholder="Full name">
              <input type="text" id="name" name="name" class="form-control mb-4 px-0" placeholder="Email address">
              <textarea name="message" id="message" class="form-control mb-4 px-0" placeholder="Message"></textarea>
              <button class="btn btn-primary" type="submit">Send</button>
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
          <p class="text-light mb-0">Copyright &copy; 2019 a theme by <a class="text-gradient-primary" href="https://themefisher.com">themefisher.com</a>
          </p>
        </div>
        <div class="col-md-6">
          <ul class="list-inline text-md-right text-center">
            <li class="list-inline-item"><a class="d-block p-3 text-white" href="#"><i class="ti-facebook"></i></a></li>
            <li class="list-inline-item"><a class="d-block p-3 text-white" href="#"><i class="ti-twitter-alt"></i></a></li>
            <li class="list-inline-item"><a class="d-block p-3 text-white" href="#"><i class="ti-instagram"></i></a></li>
            <li class="list-inline-item"><a class="d-block p-3 text-white" href="#"><i class="ti-github"></i></a></li>
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
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
<script src="plugins/google-map/gmap.js"></script>

<!-- Main Script -->
<script src="js/script.js"></script>

</body>
</html>