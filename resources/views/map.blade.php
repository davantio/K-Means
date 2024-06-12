@extends('template')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 500px;
        }
        .legend {
            background: white;
            line-height: 1.5em;
            padding: 10px;
        }
        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
    </style>
@endsection

@section('title')
    <h3>Pemetaan Hasil Clustering</h3>

@endsection

@section('content')
    <br>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Pilih Tahun Clustering</h4>
        </div>

        <div class="card-body">
            <form action="{{url('/pemetaan')}}" method="GET">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="helperText">Tahun</label>
                            <div>
                                <select class="choices form-select" name="tahun">
                                    <option value="2023">Pilih Tahun</option> <!-- Menambahkan pilihan pertama -->
                                    @foreach ($availableYears as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button class="btn btn-success" type="submit">Tampilkan</button>
                </div>
            </form>
            <br>
            <div id="map"></div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>

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
            // Tambahkan popup saat mouse klik
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
            layer.bindPopup('<b>Nama Kecamatan:</b> ' + namaKecamatan + '<br><b>Hasil Produksi:</b> ' + hasilProduksi + ' Ton' + '<br><b>Klaster:</b> ' + cluster + '<br><b>Produktivitas:</b> ' + produktivitas);
        }
        }).addTo(map);

        // Fungsi untuk membuat legenda
        function createLegend(map) {
            var legend = L.control({ position: 'topright' });

            legend.onAdd = function(map) {
                var div = L.DomUtil.create('div', 'legend');
                div.innerHTML += '<h4>Keterangan Klaster</h4>';
                div.innerHTML += '<i style="background: red"></i> Klaster 1 (Produktivitas Rendah)<br>';
                div.innerHTML += '<i style="background: yellow"></i> Klaster 2 (Produktivitas Sedang)<br>';
                div.innerHTML += '<i style="background: green"></i> Klaster 3 (Produktivitas Tinggi)<br>';
                div.innerHTML += '<i style="background: gray"></i> Tidak Diketahui<br>';
                return div;
            };

            legend.addTo(map);
        }

        // Memanggil fungsi untuk membuat legenda
        createLegend(map);
    </script>
@endsection