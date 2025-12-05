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
      position: relative;
      overflow: hidden;
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
    .card i,
    .card time {
      color: #b0b0b0 !important;
    }

    .card-img-top {
      width: 100%;
      display: block;
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
<section class="page-title bg-cover" data-background="https://imgs.search.brave.com/QeUAHzp-FAJE-gg24DlqdcgFeLHHcXhes52vgX6TWrE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWcu/ZnJlZXBpay5jb20v/Zm90b3MtcHJlbWl1/bS9wcmltZXItcGxh/bm8tY2FycmVyYS1t/b3Rvcy1kZXBvcnRp/dmFzLW1vdG8tZ3At/cGlzdGEtY2FycmVy/YXNfMTE2NzM0NC0x/MjQxODEuanBnP3Nl/bXQ9YWlzX2h5YnJp/ZCZ3PTc0MCZxPTgw">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">Noticias</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<!-- blog -->
<section class="section">
  <div class="container">
    <div class="row">
      <?php
      // Cargar las 3 noticias más recientes desde la base de datos
      $newsItems = [];
      if (file_exists(__DIR__ . '/config.php')) {
          require_once __DIR__ . '/config.php';
      } else if (file_exists(__DIR__ . '/../theme/config.php')) {
          require_once __DIR__ . '/../theme/config.php';
      }

      if (isset($mysqli) && $mysqli) {
          $stmt = $mysqli->prepare("SELECT id, date_publication, image, title, subtitle, description FROM news ORDER BY date_publication DESC LIMIT 9");
          if ($stmt) {
              $stmt->execute();
              $res = $stmt->get_result();
              if ($res) $newsItems = $res->fetch_all(MYSQLI_ASSOC);
              $stmt->close();
          }
      }

      if (empty($newsItems)) {
          // Fallback: mostrar las 3 entradas estáticas si no hay BD
          $newsItems = [
              ['id'=>0,'date_publication'=>'2018-01-15','image'=>'images/blog/post-1.jpg','title'=>'How These Different Book Covers Reflect the Design','subtitle'=>'','description'=>''],
              ['id'=>0,'date_publication'=>'2018-01-15','image'=>'images/blog/post-2.jpg','title'=>'How These Different Book Covers Reflect the Design','subtitle'=>'','description'=>''],
              ['id'=>0,'date_publication'=>'2018-01-15','image'=>'images/blog/post-3.jpg','title'=>'How These Different Book Covers Reflect the Design','subtitle'=>'','description'=>''],
          ];
      }

      foreach ($newsItems as $item):
          $img = !empty($item['image']) ? htmlspecialchars($item['image']) : 'images/blog/post-1.jpg';
          $date = !empty($item['date_publication']) ? date('F j, Y', strtotime($item['date_publication'])) : '';
          $title = !empty($item['title']) ? htmlspecialchars($item['title']) : '';
          $excerpt = '';
          if (!empty($item['subtitle'])) {
              $excerpt = htmlspecialchars($item['subtitle']);
          } elseif (!empty($item['description'])) {
              $excerpt = htmlspecialchars(mb_substr(strip_tags($item['description']),0,140));
          }
      ?>
      <div class="col-lg-4 col-md-6 mb-4">
        <article class="card hover-shadow">
          <img src="<?php echo $img; ?>" alt="post-thumb" class="card-img-top mb-2 p-2" style="object-fit:cover;height:250px;">
          <div class="card-body p-4">
            <time><?php echo $date; ?></time>
            <a href="blog-single.php?id=<?php echo urlencode($item['id']); ?>" class="h4 card-title d-block my-3 hover-text-underline"><?php echo $title; ?></a>
            <p class="text-light"><?php echo $excerpt; ?></p>
            <a href="blog-single.php?id=<?php echo urlencode($item['id']); ?>" class="btn btn-transparent">
              <!-- icono pequeño (inline SVG) -->
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1" style="vertical-align:middle;margin-right:6px;">
                <path d="M21 6h-9"></path>
                <path d="M21 12h-9"></path>
                <path d="M21 18h-9"></path>
                <path d="M3 6h.01"></path>
                <path d="M3 12h.01"></path>
                <path d="M3 18h.01"></path>
              </svg>
              Noticias
            </a>
          </div>
        </article>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- /blog -->

<!-- footer -->
<?php
include_once 'modules/footer.php'
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