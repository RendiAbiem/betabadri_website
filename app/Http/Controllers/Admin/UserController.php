<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // 1. Filter Search (Nama atau Email)
        if ($request->has('q') && $request->q != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->q . '%')
                ->orWhere('email', 'LIKE', '%' . $request->q . '%');
            });
        }

        // 2. Filter Role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // 3. Order & Pagination
        $users = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('pages.admins.users.index', compact('users'));
    }

    public function create()
    {
        return view('pages/admins.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|in:admin,mentor,staff,student', // <--- Validasi Role
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role, // <--- Simpan Role
            'password' => Hash::make($request->password),
            'email_verified_at' => now(), // Opsional: Admin membuat akun langsung terverifikasi
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('pages/admins.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // PERBAIKAN PENTING DI SINI:
            // unique:users,email,$user->id artinya: Cek email unik, TAPI abaikan untuk ID user ini.
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,mentor,staff,student',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Cek apakah password diisi?
        if ($request->filled('password')) {
            // Jika diisi, update password baru
            $data['password'] = \Hash::make($request->password);
        } else {
            // Jika kosong, hapus dari array agar password lama tidak tertimpa/hilang
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Mencegah admin menghapus dirinya sendiri saat sedang login
        if (auth()->id() == $user->id) {
            return back()->withErrors(['error' => 'Anda tidak bisa menghapus akun sendiri saat sedang login.']);
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Admin berhasil dihapus');
    }
}
