<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class ProduksiController extends Controller
{
    public function index(){
        $produksi = Produksi::all();
        return view('produksi/produksi', ['produksi' => $produksi]);
    }

    public function tambah()  {
        return view('produksi/produksiTambah');
    }

    public function tambahProses(Request $request) {
        $validator = Validator::make($request->all(),[
            'tahun' => 'required',
            'kecamatan' => 'required',
            'luas_panen' => 'required|numeric',
            'hasil' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect('/produksi/tambah')->withErrors($validator)->withInput();
        }

        Produksi::create([
            'tahun' => $request->tahun,
            'kecamatan' => $request->kecamatan,
            'luas_panen' => $request->luas_panen,
            'hasil' => $request->hasil,
        ]);

        return redirect('/produksi')->with('success', "Berhasil Menambahkan Data Produksi");
    }

    public function edit($id)
    {
        //$produksi = Produksi::all();
        $produksi = Produksi::findOrFail($id);
        if (!$produksi) {
            return redirect()->route('/produksi')->with('error', 'Data Tidak Ditemukan!');
        }
        return view('produksi.produksiEdit', ['produksi' => $produksi]);
    }

    public function editProses(Request $request, $id)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'kecamatan' => 'required',
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
            $produksi->kecamatan = $request->kecamatan;
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
}
