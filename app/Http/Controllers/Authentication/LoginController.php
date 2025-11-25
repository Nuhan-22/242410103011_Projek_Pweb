<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view("auth.login");
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            $user = Pengguna::where('email', $credentials['email'])->first(); // Use first() instead of get() to retrieve a single record
            
            if (!$user) {
                $user = Pengguna::where('username', $credentials['email'])->first();
            }
            
            if ($user && $user->id_role == 3) {
                return redirect()->route('homepage'); // Redirect to the homepage for users with id_role = 3
            } else {
                return redirect()->route('admin.dashboard'); // Redirect to admin dashboard for other roles
            }
        }

        // Add custom error message
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }



    public function logout(Request $request)
    {
        Auth::logout(); // Logs the user out of the application

        $request->session()->invalidate(); // Invalidates the session
        $request->session()->regenerateToken(); // Regenerates CSRF token to avoid session fixation attacks

        return redirect()->route('homepage');
    }
}
