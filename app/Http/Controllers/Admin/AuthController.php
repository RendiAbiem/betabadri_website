<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Tampilkan Halaman Login
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('pages.login');
    }

    // 2. Proses Login
    public function login(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba Login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            $request->session()->regenerate();

            // --- LOGIKA REDIRECT BERDASARKAN ROLE ---
            $role = Auth::user()->role;

            if ($role === 'admin' || $role === 'staff' || $role === 'mentor') {
                // Admin, Staff, dan Mentor boleh masuk Dashboard
                return redirect()->intended(route('admin.dashboard'));
            } else {
                // Siswa atau user lain dilempar ke Beranda
                return redirect()->route('home')->with('success', 'Selamat datang kembali!');
            }
        }

        // 3. Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // 3. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
