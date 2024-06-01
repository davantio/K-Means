<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Pemetaan - SIGPROJAG</title>
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
  <style>
        #map {
            height: 500px;
        }
  </style>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link href="{{ asset('main/assets/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: QuickStart
  * Template URL: https://bootstrapmade.com/quickstart-bootstrap-startup-website-template/
  * Updated: May 18 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="starter-page-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/" class="logo d-flex align-items-center me-auto">
        <img src="{{ asset('dist/assets/compiled/png/logo.png') }}" alt="Logo" class="img-fluid">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/#hero" class="">Home</a></li>
          <li><a href="/#about">About</a></li>
          <li class="dropdown"><a href="/#services"><span>Features</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="/main/produksi">Halaman Produksi</a></li>
              <li><a href="/main/pemetaan">Halaman Pemetaan</a></li>
            </ul>
          </li>
          <li><a href="/#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="/login">Login</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Halaman Pemetaan</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="current">Pemetaan</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">
    
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Pemetaan</h2>
        <p>Pemetaan Hasil Pengelompokan Lahan Produksi Jagung tiap Kecamatan per Tahun</p>
      </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up"> 
          <form action="{{url('/main/pemetaan')}}" method="GET">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="helperText">Tahun</label>
                  <div>
                    <select class="choices form-select" name="tahun">
                      <option value="">Pilih Tahun</option> 
                      @foreach ($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                      @endforeach
                    </select>
                  </div>
                  </div>
                </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <button class="btn btn-success" type="submit">Tampilkan</button>
              </div>
            </div>
          </form>
          <br>
          <div id="map"></div>         
        </div>

    </section><!-- /Starter Section Section -->

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
            <li><a href="/#hero">Home</a></li>
            <li><a href="/#about">About us</a></li>
            <li><a href="/#services">Features</a></li>
            <li><a href="/#contact">Contact</a></li>
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

  <!-- Map -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="{{ asset('dist/assets/compiled/js/leaflet.ajax.js') }}"></script>
    <script>
        var map = L.map('map').setView([-7.6453, 112.9075], 10); // Koordinat awal dan level zoom

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Parse data GeoJSON yang dimodifikasi dari controller
        var geojson = {!! $geojson !!};

        // Buat layer GeoJSON dan tambahkan ke peta
        L.geoJSON(geojson, {
            style: function(feature) {
                // Tentukan gaya berdasarkan klaster
                var cluster = feature.properties.cluster;
                if (cluster === 1) {
                    return { color: 'red' }; // Klaster 1: warna merah
                } else if (cluster === 2) {
                    return { color: 'yellow' }; // Klaster 2: warna kuning
                } else if (cluster === 3) {
                    return { color: 'green' }; // Klaster 3: warna hijau
                } else {
                    return { color: 'gray' }; // Klaster tidak terdefinisi: warna abu-abu
                }
            },
            onEachFeature: function(feature, layer) {
            // Tambahkan popup saat mouse hover
            var namaKecamatan = feature.properties.nama;
            var hasilProduksi = feature.properties.hasil;
            var cluster = feature.properties.cluster;
            var produktivitas;
            if (cluster === 1) {
                produktivitas = "Rendah";
            } else if (cluster === 2) {
                produktivitas = "Sedang";
            } else if (cluster === 3) {
                produktivitas = "Tinggi";
            } else {
                produktivitas = "Tidak Diketahui";
            }
            layer.bindPopup('<b>Nama Kecamatan:</b> ' + namaKecamatan + '<br><b>Hasil Produksi:</b> ' + hasilProduksi + '<br><b>Klaster:</b> ' + cluster + '<br><b>Produktivitas:</b> ' + produktivitas);
        }
        }).addTo(map);
    </script>

</body>

</html>