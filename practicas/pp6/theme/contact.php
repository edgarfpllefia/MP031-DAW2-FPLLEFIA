<?php
session_start();
require_once 'config.php';

if(!isset($_SESSION['user_role'])){
  header('Location: ../login.php');
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
    /* Rider Zone palette and components */
    :root {
      --primary-color: #ff5e00;
      --primary-dark: #d84e00;
      --secondary-color: #1e1e1e;
      --dark-bg: #0f0f0f;
      --gradient-primary: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
    }

    body { background: var(--dark-bg); color: #e0e0e0; }

    .page-title { padding: 120px 0 80px; background-size: cover !important; }

    .section { background: var(--dark-bg); padding: 80px 0; }

    .card.rz-card { background: rgba(30,30,30,0.98); border:1px solid rgba(255,94,0,0.12); border-radius:8px; box-shadow:0 8px 30px rgba(0,0,0,0.5); }

    .rz-form .form-control { background: rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.04); color:#e0e0e0; }
    .rz-form .form-control::placeholder { color: #b0b0b0; }

    .btn-rz { background: var(--gradient-primary); border:none; padding:0.75rem 2rem; color:white; border-radius:4px; }

    .map { height: 420px; width:100%; display:block; }
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
<section class="page-title bg-cover" data-background="https://imgs.search.brave.com/QbYzD1FJksknqnTaEDlv89_xbrzdJNWrfWWKvK4Tluk/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93d3cu/bW90b2NpY2xpc21v/LmVzL3VwbG9hZHMv/czEvMTQvNTkvNjgv/OTkvbWFyYy1tYXJx/dWV6LXBvbmUtbGEt/cGxhY2EtZGUtMjAy/NS1lbi1sYS10b3Jy/ZS1kZS1jYW1wZW9u/ZXMtZGUtbW90b2dw/LmpwZWc">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">Contactanos</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<div class="map" id="map_canvas" data-latitude="51.507351" data-longitude="-0.127758" data-marker="images/marker.png"></div>

<!-- contact section styled -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card rz-card p-4">
          <h2 class="text-white mb-3">Contáctanos</h2>
          <p class="text-light mb-4">¿Tienes alguna duda o propuesta? Escríbenos y te responderemos lo antes posible.</p>
          <form class="rz-form" action="#" method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" id="name" name="name" class="form-control" placeholder="Nombre completo">
              </div>
              <div class="form-group col-md-6">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <input type="text" id="subject" name="subject" class="form-control" placeholder="Asunto">
            </div>
            <div class="form-group">
              <textarea name="message" id="message" rows="6" class="form-control" placeholder="Mensaje"></textarea>
            </div>
            <div class="text-right">
              <button class="btn btn-rz" type="submit">Enviar mensaje</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- footer -->
<?php
include_once 'modules/footer.php';
?>
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