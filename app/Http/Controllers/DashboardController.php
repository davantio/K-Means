<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Produksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $admin = Admin::all();
        $user = Auth::user(); // Mengambil informasi pengguna yang login

        // Mengambil data produksi berdasarkan tahun
        $hasilProduksiPerTahun  = Produksi::select(
            DB::raw("SUBSTRING_INDEX(tahun, ' ', -1) AS tahun"),
            DB::raw('SUM(hasil) as total_produksi')
        )
        ->groupBy('tahun')
        ->get();

        // Mendapatkan email dan nama dari pengguna yang login
        $nama = $user->nama;

        // Menghitung total hasil produksi dari kolom 'hasil'
        $totalProduksi = Produksi::sum('hasil');

        return view('dashboard', compact('nama', 'admin', 'hasilProduksiPerTahun', 'totalProduksi'));
    }
}
