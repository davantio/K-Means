<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Clustering;

class MainController extends Controller
{
    public function index(){
        return view('main.index');
    }

    public function showMap(Request $request)
    {
        $availableYears = DB::table('cluster_results')
        ->select('tahun')
        ->distinct()
        ->pluck('tahun');

        //dd($availableYears);

        // Ambil tahun yang dipilih oleh pengguna dari input form
        $tahun = $request->input('tahun'); // Jika tidak ada tahun yang dipilih, gunakan tahun 2019 sebagai default

        // Muat file GeoJSON yang sudah ada
        $geojsonFile = file_get_contents(public_path('dist/assets/compiled/js/Batas_Kec_Kab_Pasuruan.geojson'));
        $geojsonData = json_decode($geojsonFile);

        //dd($geojsonData);
        
        // Pengambilan data klaster dari tabel cluster_results
        $clusters = DB::table('cluster_results')
            ->select('id_kecamatan', 'cluster')
            ->where('tahun', $tahun)
            ->distinct()
            ->get();
        
        // Buat associative array untuk mencocokkan id_kecamatan dengan klaster
        $clusterMap = [];
        foreach ($clusters as $cluster) {
            $clusterMap[$cluster->id_kecamatan] = $cluster->cluster;
        }

        // Tambahkan properti cluster ke data GeoJSON
        foreach ($geojsonData->features as $feature) {
            $id_kecamatan = $feature->properties->id_kecamatan;
            if (isset($clusterMap[$id_kecamatan])) {
                $feature->properties->cluster = $clusterMap[$id_kecamatan];
            } else {
                // Handle jika id_kecamatan tidak ditemukan di tabel cluster_results
                $feature->properties->cluster = null;
            }
        }

        //dd($geojsonData);

        // Convert data GeoJSON kembali ke format JSON
        $modifiedGeojsonString = json_encode($geojsonData);

        return view('main.map', ['geojson' => $modifiedGeojsonString, 'availableYears' => $availableYears]);
    }
}