@extends('template')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@endsection

@section('title')
    <h3>Dashboard</h3>

@endsection

@section('content')
  <div class="hero bg-primary text-white p-5 rounded">
    <div class="hero-inner">
      <h2>Selamat Datang {{ $nama }}!</h2>
      <p class="lead">Dashboard Sistem Informasi Pengelompokan dan Pemetaan Lahan Produksi Jagung</p>
    </div>
  </div>
  <br>

  <div class="page-content"> 
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Produksi</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totalProduksi }}</h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card"> 
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Pengguna</h6>
                                    <h6 class="font-extrabold mb-0">{{ $admin->count() }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Hasil Produksi per Tahun</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="chart-produksi-tahun"></canvas> <!-- Tambahkan kanvas untuk chart -->
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
  </div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>

<!-- Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js" type="text/javascript"></script> <!-- Sertakan Chart.js -->
<script>
    // Inisialisasi chart dengan data dari variabel produksiPerTahun
    var ctx = document.getElementById('chart-produksi-tahun').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar', // Jenis chart (misalnya, bar chart)
        data: {
            labels: [ 
                @foreach($hasilProduksiPerTahun as $tahunData)
                    '{{ $tahunData->tahun }}', // Label tahun
                @endforeach
            ],
            datasets: [{
                label: 'Hasil Produksi (ton)', // Label untuk dataset
                data: [
                    @foreach($hasilProduksiPerTahun as $totalData)
                        {{ $totalData->total_produksi }}, // Data total produksi
                    @endforeach
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Warna latar belakang batang
                borderColor: 'rgba(54, 162, 235, 1)', // Warna garis batang
                borderWidth: 2 // Ketebalan garis batang
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Mulai sumbu y dari angka 0
                }
            }
        }
    });
</script>
@endsection