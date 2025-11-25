<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RecordVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Store visitor data
        DB::table('visitors')->insert([
            'user_ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'visited_at' => now(),
        ]);

        return $next($request);
    }
}
