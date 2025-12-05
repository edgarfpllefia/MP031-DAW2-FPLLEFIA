<!-- footer -->
<footer class="bg-secondary position-relative">
  <img src="images/backgrounds/map.png" class="img-fluid overlay-image" alt="">
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
          <div class="bg-white p-4" style="border-radius: 8px; border-top: 3px solid #ff5e00;">
            <h3 style="color: #1e1e1e;">Contáctanos</h3>
            <form action="contact.php" method="POST">
              <input type="text" name="name" class="form-control mb-4 px-0" placeholder="Nombre completo" required>
              <input type="email" name="email" class="form-control mb-4 px-0" placeholder="Correo electrónico" required>
              <textarea name="message" class="form-control mb-4 px-0" placeholder="Mensaje" rows="4" required></textarea>
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
          <p class="text-light mb-0">Copyright &copy; 2025 Rider Zone - Comunidad de Motocicletas
          </p>
        </div>
        <div class="col-md-6">
          <ul class="list-inline text-md-right text-center social-icons-footer">
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

<style>
  footer {
    background: rgba(30, 30, 30, 0.98);
    border-top: 1px solid rgba(255, 94, 0, 0.2);
    color: #b0b0b0;
    padding: 60px 0 20px;
    position: relative;
  }

  footer .overlay-image {
    opacity: 0.05;
  }

  footer h4 {
    color: white;
    margin-bottom: 1.5rem;
    font-weight: 600;
  }

  footer a {
    color: #b0b0b0;
    transition: all 0.3s ease;
    text-decoration: none;
  }

  footer a:hover {
    color: #ff5e00;
    text-decoration: none;
    padding-left: 5px;
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
    border-bottom-color: #ff5e00;
    box-shadow: none;
    outline: none;
  }

  footer .form-control::placeholder {
    color: #999;
  }

  footer .btn-primary {
    background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
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

  footer .social-icons-footer a {
    width: 45px;
    height: 45px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 94, 0, 0.1);
    border-radius: 50%;
    margin: 0 0.3rem;
    transition: all 0.3s ease;
  }

  footer .social-icons-footer a:hover {
    background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
    color: white !important;
    transform: translateY(-3px);
  }

  footer .text-gradient-primary {
    background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  @media (max-width: 768px) {
    footer {
      padding: 40px 0 20px;
    }

    footer h4 {
      margin-bottom: 1rem;
    }

    footer .col-6 {
      margin-bottom: 2rem;
    }

    footer .bg-white {
      margin-top: 2rem;
    }
  }
</style>