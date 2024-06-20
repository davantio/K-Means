<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use App\Models\Kecamatan;
use App\Models\Clustering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClusteringController extends Controller
{
    public function index(){
        $clustering = Clustering::select('cluster_results.*', 'kecamatans.nama')
        ->leftJoin('kecamatans', 'cluster_results.id_kecamatan', '=', 'kecamatans.id')
        ->get();

        //Memeriksa status reclustering untuk baris dengan id 1
        //first() digunakan untuk mengambil satu baris pertama dari hasil query
        //Jika needs_reclustering bernilai 'true', maka jalankan blok if
        if (DB::table('reclustering_status')->where('id', 1)->first()->needs_reclustering) {
            $notificationType = 'warning';
            $notificationMessage = 'Terdapat Perubahan Data, Silahkan Lakukan Proses Clustering.';
        }else{
            $notificationType = 'success';
            $notificationMessage = 'Semua data sudah diproses.';
        }

        $totalCluster1 = 0;
        $totalCluster2 = 0;
        $totalCluster3 = 0;

        foreach ($clustering as $item) {
            if ($item->cluster == 1) {
                $totalCluster1++;
            } elseif ($item->cluster == 2) {
                $totalCluster2++;
            } elseif ($item->cluster == 3) {
                $totalCluster3++;
            }
        }

        return view('clustering/clustering', compact('clustering', 'notificationType', 'notificationMessage', 'totalCluster1', 'totalCluster2', 'totalCluster3'));
    }

    public function kMeansClustering(Request $request)
    {
        // Mengambil status reclustering untuk baris dengan id 1 dan mengambil satu baris pertama dari hasil query sebagai objek
        $status = DB::table('reclustering_status')->where('id', 1)->first();

        //Memeriksa apakah tidak ada baris yang ditemukan di id 1 atau needs_reclustering bernilai 'false'
        //Jika salah satu kondisi benar, maka blok if akan dijalankan
        if (!$status || !$status->needs_reclustering) {
            return redirect('/clustering')->with('info', "Tidak ada perubahan pada data. Clustering tidak diperlukan.");
        }

        $data = Produksi::select('luas_panen', 'hasil', 'id_kecamatan', 'tahun')
            ->get();

        // Inisialisasi jumlah klaster
        $k = 3; 

        // Menginisialisasi Centroid Random
        $centroids = $this->initializeCentroids($data, $k);

        // Iterasi hingga konvergensi/kesamaan cluster dengan iterasi sebelumnya
        // Menetapkan max iterasi adalah 100
        $maxIterations = 100;
        for ($i = 0; $i < $maxIterations; $i++) {
            // Hitung jarak dan menetapkan setiap titik data ke klaster yang paling dekat dengan centroid
            $clusters = $this->assignClusters($data, $centroids);

            // Perbarui centroid
            $newCentroids = $this->updateCentroids($data, $clusters, $k);

            // Cek konvergensi
            if ($centroids == $newCentroids) {
                break;
            }

            $centroids = $newCentroids;
        }

        // Memeriksa jenis perubahan data: new, update, delete
        $changeType = $status->type;

        if ($changeType === 'delete' || $changeType === 'update') {
            // Hapus data clustering yang lama
            Clustering::truncate();
        }

        // Hasil klasterisasi
        //return response()->json($clusters);

        if ($changeType === 'new') {
            // Simpan hasil klasterisasi hanya untuk data baru
            foreach ($clusters as $clusterIndex => $cluster) {
                foreach ($cluster as $point) {
                    // Memeriksa apakah data sudah ada dalam tabel cluster_results
                    $existingData = Clustering::where([
                        'id_kecamatan' => $point->id_kecamatan,
                        'tahun' => $point->tahun,
                        'luas_panen' => $point->luas_panen,
                        'hasil' => $point->hasil,
                    ])->first();

                    if (!$existingData) {
                        Clustering::create([
                            'id_kecamatan' => $point->id_kecamatan,
                            'tahun' => $point->tahun,
                            'luas_panen' => $point->luas_panen,
                            'hasil' => $point->hasil,
                            'cluster' => $clusterIndex + 1,
                        ]);
                    }
                }
            }
        } else {
            // Melakukan iterasi melalui setiap cluster dalam array $clusters dan setiap point data dalam setiap cluster
            foreach ($clusters as $clusterIndex => $cluster) {
                // $cluster merupakan array yang berisi data point, setiap data point adalah objek atau array
                foreach ($cluster as $point) {
                    Clustering::create([
                        'id_kecamatan' => $point->id_kecamatan,
                        'tahun' => $point->tahun,
                        'luas_panen' => $point->luas_panen,
                        'hasil' => $point->hasil,
                        'cluster' => $clusterIndex + 1,
                    ]);
                }
            }
        }

        // Reset status clustering
        DB::table('reclustering_status')->update(['needs_reclustering' => false, 'type' => null]);

        // Kirim data hasil clustering ke view
        return redirect('/clustering')->with('success', "Berhasil Memproses Clustering");
    }

    private function initializeCentroids($data, $k)
    {
        //Array yang akan menampung titik-titik centroid awal
        $centroids = [];

        // Memilih secara acak beberapa indeks dari array untuk centroid awal sesuai dengan nilai k
        $randomKeys = array_rand($data->toArray(), $k);
        foreach ($randomKeys as $key) {
            $centroids[] = [
                'luas_panen' => $data[$key]->luas_panen,
                'hasil' => $data[$key]->hasil,
            ];
        }

        // Mengembalikan array $centroids yang berisi titik-titik centroid awal
        return $centroids;
    }

    private function assignClusters($data, $centroids)
    {
        //Array yang menampung titik-titik data untuk setiap cluster
        $clusters = [];

        foreach ($data as $point) {
            $minDistance = PHP_INT_MAX;
            $closestCentroid = null;

            //Iterasi dilakukan pada setiap titik data
            foreach ($centroids as $index => $centroid) {
                //Jarak dihitung menggunakan rumus Euclidean Distance
                $distance = sqrt(pow($point->luas_panen - $centroid['luas_panen'], 2) + pow($point->hasil - $centroid['hasil'], 2));

                //Variabel $minDistance digunakan untuk menyimpan jarak terdekat yang ditemukan
                //Variabel $closestCentroid digunakan untuk menyimpan indeks centroid yang paling dekat.
                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $closestCentroid = $index;
                }
            }

            // Variabel $closestCentroid digunakan sebagai kunci untuk menyimpan titik data dalam array $clusters
            $clusters[$closestCentroid][] = $point;
        }

        return $clusters;
    }

    private function updateCentroids($data, $clusters, $k)
    {
        //Array yang akan menampung nilai centroid baru
        $newCentroids = [];

        //Melakukan iterasi pada setiap klaster dalam array $clusters
        foreach ($clusters as $cluster) {
            $luas_panenTotal = 0;
            $hasilTotal = 0;

            //Menghitung nilai total luas panen dan hasil
            foreach ($cluster as $point) {
                $luas_panenTotal += $point->luas_panen;
                $hasilTotal += $point->hasil;
            }

            $clusterSize = count($cluster);
            //Menghitung rata-rata luas panen dan hasil untuk klaster untuk centroid baru
            $newCentroids[] = [
                'luas_panen' => $clusterSize > 0 ? $luas_panenTotal / $clusterSize : 0,
                'hasil' => $clusterSize > 0 ? $hasilTotal / $clusterSize : 0,
            ];
        }

        // Jika jumlah klaster kurang dari k, tambahkan centroid baru secara acak
        $missing = $k - count($newCentroids);
        if ($missing > 0) {
            $additionalCentroids = $this->initializeCentroids($data, $missing);
            $newCentroids = array_merge($newCentroids, $additionalCentroids);
        }

        return $newCentroids;
    }

    public function showMap(Request $request)
    {
        //Mengambil data tahun
        $availableYears = DB::table('cluster_results')
        ->select('tahun')
        ->distinct()
        ->pluck('tahun');

        //dd($availableYears);

        // Ambil tahun yang dipilih oleh pengguna dari input form
        $tahun = $request->input('tahun', 2023); // Jika tidak ada tahun yang dipilih, gunakan tahun 2023 sebagai default

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

        return view('map', ['geojson' => $modifiedGeojsonString, 'availableYears' => $availableYears]);
    }
}
