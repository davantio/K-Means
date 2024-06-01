<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Produksi - SIGPROJAG</title>
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
        <h1 class="mb-2 mb-lg-0">Halaman Produksi</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="current">Produksi</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">
    
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Produksi</h2>
        <p>Tabel Luas Panen dan Hasil Produksi Jagung tiap Kecamatan</p>
      </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up">
            <form action="{{ url('/main/produksi') }}" method="GET">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="helperText">Filter per Tahun</label>
                    <div>
                      <select id="tahunSelect" class="choices form-select" name="tahun">
                        <option value="">Pilih Tahun</option> 
                        <option value="0">Semua</option> 
                          @foreach ($availableYears as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <a class="btn btn-danger mb-2" href="/main/export-pdf" role="button" target="_blank">
                <i class="bi bi-filetype-pdf"></i> Export PDF</a>
              <!-- <button class="btn btn-secondary" type="submit" name="action" value="filter">Filter</button> -->
            </form>
                                          <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered datatables" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tahun</th>
                                                        <th>Kecamatan</th>
                                                        <th>Luas Panen (ha)</th>
                                                        <th>Produksi (ton)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!$produksi->isEmpty())
                                                        @foreach ($produksi as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->tahun }}</td>
                                                            <td>{{ $item->nama }}</td>
                                                            <td>{{ $item->luas_panen }}</td>
                                                            <td>{{ $item->hasil }}</td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tahun</th>
                                                        <th>Kecamatan</th>
                                                        <th>Luas Panen (ha)</th>
                                                        <th>Produksi (ton)</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                          </div>  
                                         
                         
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

    <script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        new DataTable('#example');
    </script>
    <script>
    document.getElementById('tahunSelect').addEventListener('change', function() {
        // Submit form saat terjadi perubahan pada pilihan tahun
        this.form.submit();
    });
    </script>

</body>

</html>