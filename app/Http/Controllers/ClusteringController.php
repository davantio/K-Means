<?php

namespace App\Http\Controllers;
use Phpml\Clustering\KMeans;
use Phpml\Math\Distance\Euclidean;
use App\Models\Produksi;
use App\Models\Kecamatan;
use App\Models\Clustering;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClusteringController extends Controller
{
    public function index(){
        $clustering = Clustering::select('cluster_results.*', 'kecamatans.nama')
        ->leftJoin('kecamatans', 'cluster_results.id_kecamatan', '=', 'kecamatans.id_kecamatan')
        ->get();

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

        return view('clustering/clustering', compact('clustering', 'totalCluster1', 'totalCluster2', 'totalCluster3'));
    }

    // public function tambah()  {
    //     return view('clustering/clusteringTambah');
    // }

    public function kMeansClustering(Request $request)
    {
        //$tahun = $request->input('tahun');

        $data = Produksi::select('luas_panen', 'hasil', 'id_kecamatan', 'tahun')
            // ->where('tahun', $tahun)
            ->get();

        // Inisialisasi centroid awal secara acak
        $k = 3; // Misalnya, kita ingin 3 klaster

        // Terima input centroid awal dari pengguna
        // $centroid1 = $request->input('centroid1');
        // $centroid2 = $request->input('centroid2');
        // $centroid3 = $request->input('centroid3');
        // $centroid4 = $request->input('centroid4');
        // $centroid5 = $request->input('centroid5');
        // $centroid6 = $request->input('centroid6');

        //Centroid Manual
        //$centroids = $this->initializeCentroidsManually($centroid1, $centroid2, $centroid3, $centroid4, $centroid5, $centroid6);

        //Centroid Random
        $centroids = $this->initializeCentroids($data, $k);

        // Iterasi hingga konvergensi
        $maxIterations = 100;
        for ($i = 0; $i < $maxIterations; $i++) {
            // Hitung jarak dan assign klaster
            $clusters = $this->assignClusters($data, $centroids);

            // Perbarui centroid
            $newCentroids = $this->updateCentroids($data, $clusters, $k);

            // Cek konvergensi
            if ($centroids == $newCentroids) {
                break;
            }

            $centroids = $newCentroids;
        }

        // Keluarkan hasil klasterisasi
        //return response()->json($clusters);

        // Simpan hasil klasterisasi ke dalam database
        foreach ($clusters as $clusterIndex => $cluster) {
            foreach ($cluster as $point) {
                // Simpan data ke dalam tabel cluster_results
                Clustering::create([
                    'id_kecamatan' => $point->id_kecamatan,
                    'tahun' => $point->tahun,
                    'luas_panen' => $point->luas_panen,
                    'hasil' => $point->hasil,
                    'cluster' => $clusterIndex + 1, // Nomor klaster, misalnya
                ]);
            }
        }

        // Kirim data hasil clustering ke view
        return redirect('/clustering')->with('success', "Berhasil Memproses Data Clustering");
    }

    private function initializeCentroidsManually($centroid1, $centroid2, $centroid3, $centroid4, $centroid5, $centroid6)
    {
        $centroids = [];

        // Tetapkan koordinat centroid secara manual
        // Misalnya, Anda bisa menetapkan koordinat secara manual seperti berikut:
        $centroids[] = ['luas_panen' => $centroid1, 'hasil' => $centroid2];
        $centroids[] = ['luas_panen' => $centroid3, 'hasil' => $centroid4];
        $centroids[] = ['luas_panen' => $centroid5, 'hasil' => $centroid6];

        return $centroids;
    }

    private function initializeCentroids($data, $k)
    {
        $centroids = [];

        // Ambil titik-titik acak sebagai centroid awal
        $randomKeys = array_rand($data->toArray(), $k);
        foreach ($randomKeys as $key) {
            $centroids[] = [
                'luas_panen' => $data[$key]->luas_panen,
                'hasil' => $data[$key]->hasil,
            ];
        }

        return $centroids;
    }

    private function assignClusters($data, $centroids)
    {
        $clusters = [];

        foreach ($data as $point) {
            $minDistance = PHP_INT_MAX;
            $closestCentroid = null;

            foreach ($centroids as $index => $centroid) {
                $distance = sqrt(pow($point->luas_panen - $centroid['luas_panen'], 2) + pow($point->hasil - $centroid['hasil'], 2));

                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $closestCentroid = $index;
                }
            }

            $clusters[$closestCentroid][] = $point;
        }

        return $clusters;
    }

    private function updateCentroids($data, $clusters, $k)
    {
        $newCentroids = [];

        foreach ($clusters as $cluster) {
            $luas_panenTotal = 0;
            $hasilTotal = 0;

            foreach ($cluster as $point) {
                $luas_panenTotal += $point->luas_panen;
                $hasilTotal += $point->hasil;
            }

            $clusterSize = count($cluster);
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

    public function hapus()  {
        try {
            // Hapus semua data dari tabel cluster_results
            Clustering::truncate();

            return redirect('/clustering')->with('success', 'Data Clustering Berhasil Dihapus!');
        } catch (ModelNotFoundException $e) {
            // Tangani pengecualian jika ruangan dengan ID tertentu tidak ditemukan
            return redirect('/clustering')->with('error', 'Data Clustering Tidak Ditemukan');
        } catch (\Exception $e) {
            // Tangani pengecualian umum (contoh: gagal menghapus)
            return redirect('/clustering')->with('error', 'Gagal Menghapus Data Clustering');
        }
        
    }
}
