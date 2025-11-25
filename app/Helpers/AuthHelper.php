<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class AuthHelper
{
    /**
     * Create a session token and store it in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return string The session token
     */
    public static function createSessionToken($request, $user)
    {
        $sessionToken = bin2hex(random_bytes(32)); // Generate a random token

        DB::table('sessions')->insert([
            'id' => $sessionToken,
            'user_id' => $user->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'payload' => json_encode([]), // Optional data
            'last_activity' => time(),
        ]);

        // Set the token as a cookie
        Cookie::queue('key_session', $sessionToken, 120); // 120 minutes
        return $sessionToken;
    }

    /**
     * Verify the session token from the cookie.
     *
     * @param string|null $sessionToken
     * @return bool
     */
    public static function verifySessionToken($sessionToken)
    {
        if (!$sessionToken) {
            return false;
        }

        $session = DB::table('sessions')->where('id', $sessionToken)->first();
        return $session !== null; // Return true if session exists, false otherwise
    }


    public static function isLoggedIn(): bool {
        return false;
    }

    public static function isSuperAdmin(): bool
    {
        return Auth::check() && Auth::user()->id_role == 1;
    }

    public static function isAdmin(): bool
    {
        return Auth::check() && Auth::user()->id_role == 2;
    }

    public static function isAdminOrSuperAdmin(): bool
    {
        return Auth::check() && in_array(Auth::user()->id_role, [1, 2]);
    }

    public static function isDasboardRequired(): bool
    {
        return Auth::check() && in_array(Auth::user()->id_role, [1, 2, 3]);
    }


}
