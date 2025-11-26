<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * ============================================================
 * CLASS: ManageComments
 * ============================================================
 * Fungsi: Controller untuk mengelola ulasan/review dari pengunjung
 *
 * Method yang tersedia:
 * - index()           : Menampilkan daftar semua ulasan (dengan filter role)
 * - deleteComment()   : Menghapus ulasan tertentu
 * - store()           : Menyimpan ulasan baru dari user
 * - create()          : Deprecated/tidak digunakan
 * - destroy()         : Deprecated/tidak digunakan
 *
 * Role yang bisa akses:
 * - Role 1 (Super Admin) : Bisa lihat dan hapus semua ulasan
 * - Role 2 (Admin)       : Bisa lihat dan hapus semua ulasan
 * - Role 3 (Pemilik)     : Hanya lihat ulasan tempat wisata mereka
 * - Role 4 (Pengunjung)  : Tidak bisa akses (proteksi middleware)
 * ============================================================
 */

class ManageComments extends Controller
{
    public function index(Request $request){
        // Method untuk menampilkan halaman kelola ulasan
        // Filter berdasarkan role: role 3 = pemilik wisata, hanya lihat ulasan tempat mereka
        // Role lain (admin) = lihat semua ulasan

        $query = Ulasan::query()
        ->with([
            'pengguna',        // Eager load data pengguna yang memberi ulasan
            'tempat_wisata',   // Eager load data tempat wisata yang di-review
        ]);

        // Filter jika user adalah pemilik wisata (role 3)
        // Pemilik hanya bisa lihat ulasan dari tempat wisata mereka sendiri
        if(Auth::user()->id_role == 3){
            $query->where('id_pengguna', Auth::user()->id_pengguna);
        }

        // Execute query dan ambil semua data
        $comments  = $query->get();

        // Transform data dari model ke object yang lebih sederhana
        // untuk digunakan di view dengan nama field yang lebih konsisten
        $comments =  $comments->map(function ($comment) use ($comments) {

            return (object) [
                'id' => $comment->id_ulasan,                   // ID ulasan
                'rating' => $comment->nilai_rating,            // Nilai rating dari user
                'komentar' => $comment->isi_komentar,          // Isi komentar/review
                'total' => $comments->count(),                 // Total jumlah ulasan
                'tempat_wisata' => $comment->tempat_wisata,   // Object tempat wisata (relasi)
                'pengguna' => $comment->pengguna               // Object pengguna (relasi)
            ];
        });

        // Pass data ke view
        return view('admin-pages.pages.kelola-ulasan', ['comments' => $comments]);
    }

    public function deleteComment(Request $request, $id){
        // Method untuk menghapus ulasan berdasarkan ID
        // $id = ID ulasan yang akan dihapus

        // Cari ulasan, jika tidak ditemukan throw 404 error
        $comment = Ulasan::findOrFail($id);

        // Delete/hapus data ulasan dari database
        $comment->delete();

        // Redirect kembali ke halaman kelola ulasan dengan pesan sukses
        return redirect()->route('admin.manage.comment');
    }

    public function store(Request $request,$destination_id)
    {
        // Method untuk menyimpan ulasan baru dari user
        // $destination_id = ID tempat wisata yang di-review

        // Validasi data input dari form
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',           // Rating wajib, angka 1-5
            'komentar' => 'required|string|max:255',              // Komentar wajib, string max 255 karakter
        ]);

        // Simpan data ulasan baru ke database
        Ulasan::create([
            'nilai_rating' => $validated['rating'],               // Simpan rating yang sudah divalidasi
            'isi_komentar' => $validated['komentar'],             // Simpan komentar yang sudah divalidasi
            'id_tempat_wisata' => $destination_id,                // ID tempat wisata yang di-review
            'id_pengguna' => \Illuminate\Support\Facades\Auth::user()->id_pengguna // ID user yang login saat ini
        ]);

        // Redirect ke halaman detail tempat wisata (kembali ke halaman asal)
        return redirect()->route('destination.detail', $destination_id);
    }

    public function create(Request $request){

    }

    public function destroy(Request $request){

    }

    // public function store(Request $request){

    // }
}
