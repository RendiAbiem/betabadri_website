<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        
        // Cek jika user login DAN role-nya adalah student
        if (auth()->check() && auth()->user()->role === 'student') {
            // Tendang ke halaman Home
            return redirect()->route('home');
        }

        // Jika bukan student, izinkan lanjut
        return $next($request);
    }
}
