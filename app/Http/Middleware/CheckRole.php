<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed ...$roles  <-- Menerima banyak role (e.g. admin,staff)
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Ambil role user yang sedang login
        $userRole = auth()->user()->role;

        // Cek apakah role user ada di dalam daftar role yang diizinkan
        // (Super Admin kita anggap selalu boleh akses kemana saja, atau bisa kita batasi juga)
        if (in_array($userRole, $roles) || $userRole === 'admin') {
            return $next($request);
        }

        // Jika tidak punya akses, lempar ke dashboard admin (atau 403)
        return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
}
