<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Handle form submission and register the user.
     */
    public function store(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna,email',
            'username' => 'required|string|max:255|unique:pengguna,username',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Redirect back with errors if validation fails
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the user
        $user = Pengguna::create([
            'nama_depan' => $request->input('nama_depan'),
            'nama_belakang' => $request->input('nama_belakang'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'id_role' => 3, // id role 3 untuk pengguna biasa
        ]);

        // Redirect to the login page with a success message
        return redirect()
            ->route('login')
            ->with('success', 'Pendaftaran berhasil. Silakan masuk.');
    }
}
