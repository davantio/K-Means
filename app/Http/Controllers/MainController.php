<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Clustering;
use App\Models\Produksi;
use PDF;

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
        $geojsonFile = file_get_contents(public_path('dist/assets/compiled/js/Batas_Kec_Kab_Pasuruan_New.geojson'));
        $geojsonData = json_decode($geojsonFile);

        //dd($geojsonData);
        
        // Pengambilan data klaster dari tabel cluster_results
        $clusters = DB::table('cluster_results')
            ->select('id_kecamatan', 'hasil', 'cluster')
            ->where('tahun', $tahun)
            ->distinct()
            ->get();
        
        // Buat associative array untuk mencocokkan id_kecamatan dengan klaster
        $clusterMap = [];
        foreach ($clusters as $cluster) {
            $clusterMap[$cluster->id_kecamatan] = [
                'hasil' => $cluster->hasil,
                'cluster' => $cluster->cluster
            ];
        }

        // Tambahkan properti cluster ke data GeoJSON
        foreach ($geojsonData->features as $feature) {
            $id_kecamatan = $feature->properties->id_kecamatan;
            if (isset($clusterMap[$id_kecamatan])) {
                $feature->properties->hasil = $clusterMap[$id_kecamatan]['hasil'];
                $feature->properties->cluster = $clusterMap[$id_kecamatan]['cluster'];
            } else {
                // Handle jika id_kecamatan tidak ditemukan di tabel cluster_results
                $feature->properties->hasil = null;
                $feature->properties->cluster = null;
            }
        }

        //dd($geojsonData);

        // Convert data GeoJSON kembali ke format JSON
        $modifiedGeojsonString = json_encode($geojsonData);

        return view('main.map', ['geojson' => $modifiedGeojsonString, 'availableYears' => $availableYears]);
    }

    public function showProduksi(Request $request){
        $tahun = $request->input('tahun');

        if($tahun == 0){
            $produksi = DB::table('produksi')
            ->leftJoin('kecamatans', 'produksi.id_kecamatan', '=', 'kecamatans.id');
            $produksi = $produksi->get();
        }else{
            $produksi = DB::table('produksi')
            ->leftJoin('kecamatans', 'produksi.id_kecamatan', '=', 'kecamatans.id')
            ->where('produksi.tahun', $tahun);
            $produksi = $produksi->get();
        }

        $availableYears = Produksi::select('tahun')
            ->distinct()
            ->pluck('tahun');
        
        return view('main.produksi', ['produksi' => $produksi, 'availableYears' => $availableYears]);
    }

    public function exportPDF(Request $request)
    {
        $produksi = Produksi::select('produksi.*', 'kecamatans.nama')
            ->leftJoin('kecamatans', 'produksi.id_kecamatan', '=', 'kecamatans.id')
            ->get();

        // Buat PDF menggunakan DOMPDF
        $pdf = PDF::loadView('produksi.produksi_pdf', compact('produksi'));

        // Unduh file PDF
        return $pdf->download('Laporan' . '.pdf');
        //return $pdf->stream();
    }
}
