<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Daftar semua pengguna (admin)
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter pencarian
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Form tambah pengguna
     */
    public function create()
    {
        // return view('admin.users.create');
        return redirect()->route('admin.users.index')
            ->with('info', 'Form tambah pengguna belum tersedia.');
    }

    /**
     * Simpan pengguna baru
     */
    public function store(Request $request)
    {
        return redirect()->route('admin.users.index');
    }

    /**
     * Detail pengguna
     */
    public function show(User $user)
    {
        return redirect()->route('admin.users.index');
    }

    /**
     * Form edit pengguna
     */
    public function edit(User $user)
    {
        return redirect()->route('admin.users.index');
    }

    /**
     * Update pengguna
     */
    public function update(Request $request, User $user)
    {
        return redirect()->route('admin.users.index');
    }

    /**
     * Hapus pengguna
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
