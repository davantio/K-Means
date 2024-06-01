<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - SIGPROJAG</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('dist/assets/compiled/svg/favicon.svg') }}" rel="icon">
  <link href="{{ asset('main/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('main/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('main/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('main/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('main/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('main/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('main/assets/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: QuickStart
  * Template URL: https://bootstrapmade.com/quickstart-bootstrap-startup-website-template/
  * Updated: May 18 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/" class="logo d-flex align-items-center me-auto">
        <img src="{{ asset('dist/assets/compiled/png/logo.png') }}" alt="Logo" class="img-fluid">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="">Home</a></li>
          <li><a href="#about">About</a></li>
          <li class="dropdown"><a href="#services"><span>Features</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="/main/produksi">Halaman Produksi</a></li>
              <li><a href="/main/pemetaan">Halaman Pemetaan</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="/login">Login</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="hero-bg">
        <img src="{{ asset('main/assets/img/hero-bg-light.webp') }}" alt="">
      </div>
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <h1 data-aos="fade-up" class="">Welcome to <span>SIGPROJAG</span></h1>
          <p data-aos="fade-up" data-aos-delay="100" class="">Ketahui Hasil Produksi Jagung di Kabupaten Pasuruan Serta Pemetaannya<br></p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="#about" class="btn-get-started">Get Started</a>
            <!-- <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
          </div>
          <br>
          <img src="{{ asset('main/assets/img/Lambang_Kabupaten_Pasuruan.png') }}" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-droplet-fill"></i></div>
              <div>
                <h4 class="title"><a class="stretched-link">Data Akurat dan Terbaru</a></h4>
                <p class="description">Menyediakan data luas panen dan hasil produksi jagung yang akurat, terbaru, dan relevan</p>
              </div>
            </div>
          </div>
          <!-- End Service Item -->

          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-person-check-fill"></i></div>
              <div>
                <h4 class="title"><a class="stretched-link">Pengambilan Keputusan</a></h4>
                <p class="description">Membantu para petani, dinas terkait, dan pemangku kepentingan lainnya dalam merumuskan kebijakan dan strategi yang efektif</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-eye"></i></div>
              <div>
                <h4 class="title"><a class="stretched-link">Transparansi</a></h4>
                <p class="description">Meningkatkan transparansi dalam penyampaian informasi, sehingga semua pihak dapat mengakses data dengan mudah</p>
              </div>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Featured Services Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-12 content" data-aos="fade-up" data-aos-delay="100">
            <p class="who-we-are">Who We Are</p>
            <h3>SIGPROJAG - Sistem Informasi Geografis untuk Pemetaan dan Pengelompokan Lahan Produksi Jagung</h3>
            <p class="fst-italic">
              Aplikasi ini menyediakan informasi terperinci dan akurat tentang luas panen dan hasil produksi jagung di wilayah Kabupaten Pasuruan.
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> <span>Memberikan informasi data luas panen, dan hasil produksi jagung tiap kecamatan per tahun</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Menggunakan metode K-Means Clustering, kami mengelompokkan wilayah produksi jagung ke dalam kategori produktivitas rendah, sedang, dan tinggi kemudian menampilkan hasilnya kedalam pemetaan.</span></li>
            </ul>
          </div>

        </div>

      </div>
    </section><!-- /About Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Fitur</h2>
        <p>Fitur atau layanan yang tersedia di aplikasi SIGPROJAG</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row g-5">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
              <i class="bi bi-clipboard2-data-fill icon"></i>
              <div>
                <h3>Luas Panen dan Hasil Produksi</h3>
                <p>Informasi data luas panen dan hasil produksi jagung tiap kecamatan per tahun di Kabupaten Pasuruan.</p>
                <a href="/main/produksi" class="read-more stretched-link">Lihat Selengkapnya <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item item-orange position-relative">
              <i class="bi bi-map-fill icon"></i>
              <div>
                <h3>Pemetaan</h3>
                <p>Visualisasi lahan produksi jagung di Kabupaten Pasuruan, menunjukkan tingkat produktivitas di berbagai kecamatan. </p>
                <a href="/main/pemetaan" class="read-more stretched-link">Lihat Selengkapnya <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kontak</h2>
        <p>Untuk pertanyaan umum dan masukan, Anda dapat menghubungi kami</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt"></i>
              <h3>Alamat</h3>
              <p>Komplek perkantoran, Raci, Kec. Bangil, Pasuruan, 67153</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone"></i>
              <h3>Telepon</h3>
              <p>(0343) 5616477</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p>diskominfo@pasuruankab.go.id</p>
            </div>
          </div><!-- End Info Item -->

        </div>

        <div class="row gy-4 mt-1">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15818.688588421293!2d112.8276328!3d-7.6106091!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7c4c402c27343%3A0x6b28e50c3fddf52f!2sDinas%20Ketahanan%20Pangan%20dan%20Pertanian%20Kabupaten%20Pasuruan!5e0!3m2!1sid!2sid!4v1717176963592!5m2!1sid!2sid" frameborder="0" style="border:0; width: 100%; height: 500px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div><!-- End Google Maps -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer position-relative">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">SIGPROJAG</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Komplek perkantoran, Raci</p>
            <p>Kec. Bangil, Pasuruan, 67153</p>
            <p class="mt-3"><strong>Phone:</strong> <span>(0343) 5616477</span></p>
            <p><strong>Email:</strong> <span>diskominfo@pasuruankab.go.id</span></p>
          </div>
        </div>

        <div class="col-lg-4 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#hero">Home</a></li>
            <li><a href="#about">About us</a></li>
            <li><a href="#services">Features</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-3 footer-links">
          <h4>Fitur Kami</h4>
          <ul>
            <li><a href="/main/produksi">Halaman Produksi</a></li>
            <li><a href="/main/pemetaan">Halaman Pemetaan</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">QuickStart</strong><span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('main/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('main/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('main/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('main/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('main/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('main/assets/js/main.js') }}"></script>

</body>

</html>