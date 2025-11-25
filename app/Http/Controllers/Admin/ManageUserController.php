<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ManageUserController extends Controller
{
    public function index()
    {
        $idRole = Auth::user()->id_role;

        $users = Pengguna::with('role')->whereHas('role', function($query) use ($idRole) {
            $query->whereNotIn('id_role', [$idRole, 1]);
        })->get();

        return view('admin-pages.pages.list-pengguna', compact('users'));
    }

    // method yang hanya bisa diakses untuk user dan superuser
    public function indexEditUser($id)
    {
        $pengguna = Pengguna::findOrFail($id);

        $idRole = Auth::user()->id_role;

        // Menolak mengubah user bagi yang memiliki role yang sama atau role super user
        if ($pengguna->id_role == 1 || $idRole == $pengguna->id_role){
            abort(403, "Akses Ditolak");
        };

        $roles = $this->getRoles();

        return view('admin-pages.pages.buat-edit-pengguna', compact('pengguna', 'roles'));
    }

    public function getRoles(){
        $idRole = Auth::user()->id_role;

        $roles = Role::all()->map(function($role) use ($idRole){
            if (!in_array($role->id_role, [1, $idRole])){
                return $role;
            }
        })->filter();

        return $roles;
    }

    public function indexCreateuser()
    {
        $roles = $this->getRoles();
        return view('admin-pages.pages.buat-edit-pengguna', compact('roles'));
    }

    public function delete(Request $request, $id)
    {
        $user = Pengguna::findOrFail($id);

        if ($user->delete()) {
            echo "<script>
                    alert('user berhasil dihapus.');
                    window.location.href = '" . route('user.manage') . "';
                  </script>";
            exit;
        }

        echo "<script>
                alert('Gagal menghapus user.');
                window.history.back();
              </script>";
        exit;
    }


    // Store method for creating a new user
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email|max:255',
            'username' => 'required|string|max:255|unique:pengguna,username',
            'password' => 'required|string|min:8', // confirm password confirmation field
            'id_role' => 'required|exists:role,id_role',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload if present
        if ($request->hasFile('foto_profil')) {
            $filePath = $request->file('foto_profil')->store('profile_pictures', 'public');
        } else {
            $filePath = null;
        }

        // Create the new user record
        $user = Pengguna::create([
            'nama_depan' => $validated['nama_depan'],
            'nama_belakang' => $validated['nama_belakang'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'id_role' => $validated['id_role'],
            'foto_profil' => $filePath,
        ]);

        // Redirect back with success message
        // JavaScript alert and redirect
        echo "<script>
                alert('user baru telah ditambahkan!');
                window.location.href = '" . route('user.manage') . "';
              </script>";
        exit;   
    }

    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = Pengguna::findOrFail($id);

        // Validate the incoming request
        $validated = $request->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('pengguna')->ignore($user->id_pengguna, 'id_pengguna'), 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('pengguna')->ignore($user->id_pengguna, 'id_pengguna')],
            'id_role' => 'required|exists:role,id_role',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload if present
        if ($request->hasFile('foto_profil')) {
            // Delete old profile picture if it exists
            if ($user->foto_profil) {
                $filePath = public_path('storage/' . $user->foto_profil);

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $filePath = $request->file('foto_profil')->store('profile_pictures', 'public');
        } else {
            $filePath = $user->foto_profil; // Keep the current profile picture if not uploading a new one
        }

        // Update the user record
        $user->update([
            'nama_depan' => $validated['nama_depan'],
            'nama_belakang' => $validated['nama_belakang'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'id_role' => $validated['id_role'],
            'foto_profil' => $filePath,
        ]);

        // JavaScript alert and redirect
        echo "<script>
                alert('user updated successfully!');
                window.location.href = '" . route('user.manage') . "';
              </script>";
        exit;
    }

}
