<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; 

class KecamatanController extends Controller
{
    public function index(){
        $kecamatan = Kecamatan::all();
        return view('kecamatan/kecamatan', ['kecamatan' => $kecamatan]);
    }

    public function tambah()  {
        return view('kecamatan/kecamatanTambah');
    }

    public function tambahProses(Request $request) {
        $validator = Validator::make($request->all(),[
            'kode' => 'required|unique:kecamatans,kode',
            'nama' => 'required|string|regex:/^[a-zA-Z\s]+$/'
        ]);

        if ($validator->fails()) {
            return redirect('/kecamatan/tambah')->withErrors($validator)->withInput();
        }

        Kecamatan::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect('/kecamatan')->with('success', "Berhasil Menambahkan Data Kecamatan");
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        if (!$kecamatan) {
            return redirect()->route('/kecamatan')->with('error', 'Data Tidak Ditemukan!');
        }
        return view('kecamatan.kecamatanEdit', ['kecamatan' => $kecamatan]);
    }

    public function editProses(Request $request, $id)
    {
        $kecamatan = Kecamatan::find($id);

        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'kode' => [
                'required',
                Rule::unique('kecamatans')->ignore($kecamatan->id)
            ],
            'nama' => 'required|string|regex:/^[a-zA-Z\s]+$/'
        ]);

        if ($validator->fails()) {
            return redirect('/kecamatan/edit/' . $id)->withErrors($validator)->withInput();
        }

        try {
            $kecamatan = Kecamatan::findOrFail($id);

            // Update atribut sesuai dengan permintaan
            $kecamatan->kode = $request->kode;
            $kecamatan->nama = $request->nama;

            $kecamatan->save();

            return redirect('/kecamatan')->with('success', 'Data Kecamatan Berhasil Diperbarui!');
        } catch (ModelNotFoundException $e) {
            // Tangani pengecualian jika Ruangan dengan ID tertentu tidak ditemukan
            return redirect('/kecamatan')->with('error', 'Data Kecamatan Tidak Ditemukan ' . $e);
        }
    }

    public function hapus($id)  {
        try {
            $kecamatan = Kecamatan::findOrFail($id);
            $kecamatan->delete();

            return redirect('/kecamatan')->with('success', 'Data Kecamatan Berhasil Dihapus!');
        } catch (ModelNotFoundException $e) {
            // Tangani pengecualian jika ruangan dengan ID tertentu tidak ditemukan
            return redirect('/kecamatan')->with('error', 'Data Kecamatan Tidak Ditemukan');
        } catch (\Exception $e) {
            // Tangani pengecualian umum (contoh: gagal menghapus)
            return redirect('/kecamatan')->with('error', 'Gagal Menghapus Data Kecamatan');
        }
        
    }
}
