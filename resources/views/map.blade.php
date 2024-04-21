@extends('template')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 500px;
        }
    </style>
@endsection

@section('title')
    <h3>Pemetaan Lahan</h3>

@endsection

@section('content')
    <br>
    <div id="map"></div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
<script>
    new DataTable('#example');
  </script>

<!-- Map -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="{{ asset('dist/assets/compiled/js/leaflet.ajax.js') }}"></script>
    <script>
        var map = L.map('map').setView([-7.6453, 112.9075], 10); // Koordinat awal dan level zoom

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var stylemap = {
            fillColor: 'green',   // Warna isian (fill color)
            fillOpacity: 0,       // Opasitas isian (fill opacity)
            color: 'black',       // Warna garis tepi (border color)
            weight: 2             // Ketebalan garis tepi (border weight)
        }

        //Plugin GeoJSON
        function popUp(f,l){
            var out = [];
            if (f.properties){
                for(key in f.properties){
                    out.push(key+": "+"<b>"+f.properties[key]+"</b>");
                }
                l.bindPopup(out.join("<br />"));
            }
        }
        var jsonTest = new L.GeoJSON.AJAX(["{{ asset('dist/assets/compiled/js/Batas_Kec_Kab_Pasuruan.geojson') }}"],{onEachFeature:popUp, style:stylemap}).addTo(map);

        // // Tambahkan layer GeoJSON
        // var geojsonLayer = L.geoJSON(null, {
        // style: function (feature) {
        //     return {
        //         fillColor: 'green',   // Warna isian (fill color)
        //         fillOpacity: 0,       // Opasitas isian (fill opacity)
        //         color: 'black',       // Warna garis tepi (border color)
        //         weight: 2             // Ketebalan garis tepi (border weight)
        //     };
        // }
        // }).addTo(map);
        
        // // Ambil dan tambahkan data GeoJSON dari file
        // $.getJSON("{{ asset('dist/assets/compiled/js/Batas_Kec_Kab_Pasuruan.geojson') }}", function(data) {
        //     geojsonLayer.addData(data);
        // });
    </script>
@endsection