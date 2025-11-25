<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Kategori::all();
        return view('admin-pages.pages.kelola-kategori', compact('categories')); // Sesuaikan dengan view
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|numeric',
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Create main TempatWisata entity
        $tempatWisata = Kategori::create([
            'nama_kategori' => $validated['nama_kategori']
        ]);

        // return response()->json(['message' => 'Kategori berhasil ditambahkan.'], 200);
        return redirect()->route('admin.kategori-wisata');
    }



    /**
     * Update the specified category in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|numeric',
            'nama_kategori' => 'required|string|max:255',
        ]);
    
        $category = Kategori::where('id_kategori', $validated['id_kategori'])->first();
    
        if (!$category) {
            return redirect()->route('admin.kategori-wisata')->with('error', 'Kategori tidak ditemukan.');
        }
    
        // Only update if the value has changed
        if ($category->nama_kategori !== $validated['nama_kategori']) {
            $category->nama_kategori = $validated['nama_kategori'];
            $category->save();
        }
    
        return redirect()->route('admin.kategori-wisata')->with('success', 'Kategori berhasil diperbarui.');
    }
    

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Request $request, $id)
    {
        if(!AuthHelper::isAdminOrSuperAdmin()){
            abort(403);
        }
        $category = Kategori::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.kategori-wisata')->with('success', 'Kategori berhasil dihapus.');
    }
}
