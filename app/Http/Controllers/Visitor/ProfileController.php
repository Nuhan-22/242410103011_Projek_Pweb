<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\Ulasan;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $idUser = $user->id_pengguna;

        $ulasan = Ulasan::where('id_pengguna', $idUser)->get();
        return view('visitor-pages.pages.profile',['pengguna' => $user, 'ulasans' => $ulasan]);
    }

    public function indexSettings(Request $request){
        $user = Auth::user();
        return view('visitor-pages.pages.settings',['pengguna' => $user]);
    }

    /**
     * Mengupdate pengaturan pengguna.
     */
    public function update(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|min:8',  // Validasi password hanya jika diisi
            'password_confirmation' => 'nullable|min:8', // Konfirmasi password jika ada
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validasi foto profil
        ]);

        // Pastikan password dan konfirmasi cocok jika salah satu diisi
        if ($request->filled('password') && $request->filled('password_confirmation')) {
            if ($request->password !== $request->password_confirmation) {
                return back()->withErrors(['password_confirmation' => 'Kedua password yang dimasukkan tidak sama']);
            }
        }


        // Ambil data pengguna yang sedang login
        $idPengguna = Auth::user()->id_pengguna;

        $pengguna = Pengguna::findOrFail($idPengguna);

        // Persiapkan data yang akan diupdate
        $dataUpdate = [
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'email' => $request->email,
            'username' => $request->username,
        ];

        // Update password jika ada perubahan
        if ($request->filled('password') && $request->filled('password_confirmation')) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto_profil')) {
            $filePath = public_path('storage/' . $pengguna->foto_profil);

            if (file_exists($filePath) && !is_dir($filePath)) {
                unlink($filePath);
            }

            $filePath = $request->file('foto_profil')->store('profile_pictures', 'public');
            $dataUpdate['foto_profil'] = $filePath;
        }

        // Update data pengguna menggunakan method update()
        $pengguna->update($dataUpdate);

        // Redirect ke halaman profil dengan pesan sukses
        return redirect('/profile')->with('success', 'Pengaturan berhasil diperbarui!');
    }

}
