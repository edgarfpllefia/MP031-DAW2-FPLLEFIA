<?php
session_start();
require_once 'config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user'){
    header('Location: ../../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta charset="utf-8">
  <title>Agen | Bootstrap Agency Template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="plugins/venobox/venobox.css">
  <link rel="stylesheet" href="plugins/card-slider/css/style.css">
  <link href="css/style.css" rel="stylesheet">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">

  <style>
  .section.bg-light { background: #0f0f0f !important; }
  .col-12.bg-white.p-4.mb-3 {
      background: #1a1a1a !important;
      border: 1px solid rgba(255,94,0,0.3);
      border-radius: 8px;
      transition: all 0.3s ease;
  }
  .col-12.bg-white.p-4.mb-3:hover {
      transform: translateY(-8px);
      border-color: #ff5e00;
      box-shadow: 0 12px 30px rgba(255,94,0,0.25);
  }
  .media-body h4.text-secondary { color: #ff5e00 !important; margin-bottom: 0.5rem; }
  .media-body p.mb-0 { color: #b0b0b0 !important; }
  .btn-outline-primary {
      border-color: #ff5e00;
      color: #ff5e00;
      transition: all 0.3s ease;
  }
  .btn-outline-primary:hover {
      background: #ff5e00;
      color: #fff;
      border-color: #ff5e00;
  }
  .page-title h1.display-1 {
      color: #ff5e00 !important;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
  }
  footer.bg-secondary { background: #1e1e1e !important; }
  footer h4 { color: #ff5e00 !important; }
  footer a.text-light { color: #b0b0b0 !important; transition: all 0.3s ease; }
  footer a.text-light:hover { color: #ff5e00 !important; }
  </style>
</head>

<body>
<?php require_once 'modules/header.php' ?>

<section class="page-title bg-cover" data-background="https://imgs.search.brave.com/qx6KD-bu2d8j0DFXcQLHVZbjNnlhMwuwZErZlZzohLU/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tb3Rv/ZGVzZW8uY29tL3dw/LWNvbnRlbnQvdXBs/b2Fkcy9CTVctTS0x/MDAwLVhSXzA5OC0x/MDI0eDY4My5qcGc">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">Trabaja con nosotros</h1>
      </div>
    </div>
  </div>
</section>

<section class="section bg-light">
  <div class="container">
    <div class="row">
      <?php
      $jobs = [];
      if (!empty($mysqli)) {
        if ($stmt = $mysqli->prepare("SELECT id, posicion, ciudad FROM jobs ORDER BY id DESC")) {
          $stmt->execute();
          $jobs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
          $stmt->close();
        }
      }

      foreach ($jobs as $job):
        $posicion = htmlspecialchars($job['posicion']);
        $ciudad   = htmlspecialchars($job['ciudad']);
      ?>
      <div class="col-12 bg-white p-4 mb-3">
        <div class="media align-items-center flex-column flex-sm-row">
          <div class="media-body text-center text-sm-left mb-4 mb-sm-0">
            <h4 class="text-secondary"><?= $posicion ?></h4>
            <p class="mb-0"><?= $ciudad ?></p>
          </div>
          <a href="career-details.php?id=<?= $job['id'] ?>" class="btn btn-outline-primary">Apply Now</a>
        </div>
      </div>
      <?php endforeach; ?>
      <?php if (empty($jobs)): ?>
        <div class="col-12 text-center text-muted">No hay posiciones abiertas.</div>
      <?php endif; ?>
    </div>
  </div>
</section>

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

<script src="plugins/jQuery/jquery.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/slick/slick.min.js"></script>
<script src="plugins/venobox/venobox.min.js"></script>
<script src="plugins/shuffle/shuffle.min.js"></script>
<script src="plugins/counto/apear.js"></script>
<script src="plugins/counto/counTo.js"></script>
<script src="plugins/card-slider/js/card-slider-min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
<script src="plugins/google-map/gmap.js"></script>
<script src="js/script.js"></script>
</body>
</html>
