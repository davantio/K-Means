<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PDF;

class ProduksiController extends Controller
{
    public function index(){
        $produksi = Produksi::select('produksi.*', 'kecamatans.nama')
            ->leftJoin('kecamatans', 'produksi.id_kecamatan', '=', 'kecamatans.id_kecamatan')
            ->get();

        $availableYears = Produksi::select('tahun')
            ->distinct()
            ->pluck('tahun');
            
        return view('produksi/produksi', ['produksi' => $produksi, 'availableYears' => $availableYears]);
    }

    public function tambah()  {
        $kecamatan = Kecamatan::all();
        return view('produksi/produksiTambah', ['kecamatans'=>$kecamatan]);
    }

    public function tambahProses(Request $request) {
        $validator = Validator::make($request->all(),[
            'tahun' => 'required|numeric',
            'id_kecamatan' => 'required',
            'luas_panen' => 'required|numeric',
            'hasil' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect('/produksi/tambah')->withErrors($validator)->withInput();
        }

        Produksi::create([
            'tahun' => $request->tahun,
            'id_kecamatan' => $request->id_kecamatan,
            'luas_panen' => $request->luas_panen,
            'hasil' => $request->hasil,
        ]);

        return redirect('/produksi')->with('success', "Berhasil Menambahkan Data Produksi");
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::all();
        $produksi = Produksi::findOrFail($id);
        if (!$produksi) {
            return redirect()->route('/produksi')->with('error', 'Data Tidak Ditemukan!');
        }
        return view('produksi.produksiEdit', ['kecamatans' => $kecamatan, 'produksi' => $produksi]);
    }

    public function editProses(Request $request, $id)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'id_kecamatan' => 'required',
            'luas_panen' => 'required|numeric',
            'hasil' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect('/produksi/edit/' . $id)->withErrors($validator)->withInput();
        }

        try {
            $produksi = Produksi::findOrFail($id);

            // Update atribut sesuai dengan permintaan
            $produksi->tahun = $request->tahun;
            $produksi->id_kecamatan = $request->id_kecamatan;
            $produksi->luas_panen = $request->luas_panen;
            $produksi->hasil = $request->hasil;

            $produksi->save();

            return redirect('/produksi')->with('success', 'Data Produksi Berhasil Diperbarui!');
        } catch (ModelNotFoundException $e) {
            // Tangani pengecualian jika Ruangan dengan ID tertentu tidak ditemukan
            return redirect('/produksi')->with('error', 'Data Produksi Tidak Ditemukan ' . $e);
        }
    }

    public function hapus($id)  {
        try {
            $produksi = Produksi::findOrFail($id);
            $produksi->delete();

            return redirect('/produksi')->with('success', 'Data Produksi Berhasil Dihapus!');
        } catch (ModelNotFoundException $e) {
            // Tangani pengecualian jika ruangan dengan ID tertentu tidak ditemukan
            return redirect('/produksi')->with('error', 'Data Produksi Tidak Ditemukan');
        } catch (\Exception $e) {
            // Tangani pengecualian umum (contoh: gagal menghapus)
            return redirect('/produksi')->with('error', 'Gagal Menghapus Data Produksi');
        }
    }

    public function filterProses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/produksi')->withErrors($validator)->withInput();
        }

        $tahun = $request->input('tahun');

        if($tahun == 0){
            $produksi = DB::table('produksi')
            ->leftJoin('kecamatans', 'produksi.id_kecamatan', '=', 'kecamatans.id_kecamatan');
            $produksi = $produksi->get();
        }else{
            $produksi = DB::table('produksi')
            ->leftJoin('kecamatans', 'produksi.id_kecamatan', '=', 'kecamatans.id_kecamatan')
            ->where('produksi.tahun', $tahun);
            $produksi = $produksi->get();
        }

        $availableYears = Produksi::select('tahun')
            ->distinct()
            ->pluck('tahun');
        
        return view('produksi.produksi', ['produksi' => $produksi, 'availableYears' => $availableYears]);
    }

    public function exportPDF(Request $request)
    {
        $produksi = Produksi::select('produksi.*', 'kecamatans.nama')
            ->leftJoin('kecamatans', 'produksi.id_kecamatan', '=', 'kecamatans.id_kecamatan')
            ->get();

        // Buat PDF menggunakan DOMPDF
        $pdf = PDF::loadView('produksi.produksi_pdf', compact('produksi'));

        // Unduh file PDF
        // return $pdf->download('Laporan_' . $tahun .  '.pdf');
        return $pdf->stream();
    }
}
