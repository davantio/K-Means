<?php

namespace App\Http\Controllers;

use App\Models\Admin;
//use App\Helpers\HashHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule; 

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return view('admin.admin', ['admin' => $admin]);
    }

    public function tambah()  {
        return view('admin.adminTambah');
    }

    public  function tambahProses(Request $request) {
        //$hashedPassword = HashHelper::encryptPassword($request->password);
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(),[
            'nama' => 'required|string|max:255',
            'nip' => 'required|unique:admins,nip',
            'jenis_kelamin' => 'required|in:Laki-Laki, Perempuan',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            return redirect('/admin/tambah')->withErrors($validator)->withInput();
        }

        Admin::create([
            'nama'=> $request->nama,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect('/admin')->with('success', "Berhasil Tambah Data Pengguna!");
    }

    public function edit($id){
        $admin = Admin::find($id);
        if (!$admin) {
            return redirect()->route('/admin')->with('error', 'Data Tidak Ditemukan');
        }
        return view('/admin/adminEdit', ['admin' => $admin] );
    }

    public function editProses(Request $request, $id)  {
        $admin = Admin::find($id);

        $validator = Validator::make($request->all(),[
           'nama' => 'required|string|max:255',
           'nip' => [
                'required',
                Rule::unique('admins')->ignore($admin->id)
           ],
           'jenis_kelamin' => 'required|in:Laki-Laki, Perempuan',
           'email' => [
                'required',
                'email',
                Rule::unique('admins')->ignore($admin->id)
           ],
           'password' => 'required|string|min:8',
       ]);

       if($validator->fails()){
           return redirect('/admin/edit/'.$id)->withErrors($validator)->withInput();
       }

       $admin->update([
           'nama'=> $request->nama,
           'nip' => $request->nip,
           'jenis_kelamin' => $request->jenis_kelamin,
           'email' => $request->email,
           'password' => Hash::make($request->password)
       ]);

       return redirect('/admin')->with('success', "Berhasil Update Data Pengguna");
   }

    public function hapus($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            $admin->delete();

            return redirect('/admin')->with('success', 'Data Pengguna Berhasil Dihapus');
        } catch (ModelNotFoundException $e) {
            // Tangani pengecualian jika ruangan dengan ID tertentu tidak ditemukan
            return redirect('/admin')->with('error', 'Data Pengguna Tidak Ditemukan');
        } catch (\Exception $e) {
            // Tangani pengecualian umum (contoh: gagal menghapus)
            return redirect('/admin')->with('error', 'Gagal Menghapus Data Pengguna');
        }
    }
}