<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageComments extends Controller
{
    public function index(Request $request){

        $query = Ulasan::query()
        ->with([
            'pengguna',
            'tempat_wisata', 
        ]);

        
        if(Auth::user()->id_role == 3){
            $query->where('id_pengguna', Auth::user()->id_pengguna);
        }

        $comments  = $query->get();

        $comments =  $comments->map(function ($comment) use ($comments) {

            return (object) [
                'id' => $comment->id_ulasan,
                'rating' => $comment->nilai_rating,
                'komentar' => $comment->isi_komentar,
                'total' => $comments->count(),
                'tempat_wisata' => $comment->tempat_wisata,
                'pengguna' => $comment->pengguna
            ];
        });

        return view('admin-pages.pages.kelola-ulasan', ['comments' => $comments]);
    }

    public function deleteComment(Request $request, $id){
        $comment = Ulasan::findOrFail($id);
        $comment->delete();

        return redirect()->route('admin.manage.comment');
    }

    public function store(Request $request,$destination_id)
    {
        // Validasi data
        // dd($request);
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        Ulasan::create([
            'nilai_rating' => $validated['rating'],
            'isi_komentar' => $validated['komentar'],
            'id_tempat_wisata' => $destination_id, // Sesuaikan dengan ID tempat wisata
            'id_pengguna' => \Illuminate\Support\Facades\Auth::user()->id_pengguna // Sesuaikan dengan ID tempat wisata
            // 'id_pengguna' => auth()->id(), // Ambil ID pengguna yang login
        ]);

        return redirect()->route('destination.detail', $destination_id);
    }

    public function create(Request $request){

    }

    public function destroy(Request $request){

    }

    // public function store(Request $request){

    // }
}
