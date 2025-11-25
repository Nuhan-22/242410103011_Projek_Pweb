<?php

namespace App\Http\Middleware;

use App\Helpers\Common;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Jika user belum login, redirect ke halaman login
            Common::alertAndRedirect('Maaf anda harus login terlebih dahulu', route('login'));

        }

        return $next($request);
    }
}

