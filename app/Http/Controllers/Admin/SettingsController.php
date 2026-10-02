<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class SettingsController extends Controller
{
    /**
     * Halaman profil admin
     */
    public function profile()
    {
        return view('admin.settings.profile');
    }

    /**
     * Update informasi profil admin
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update password admin
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (! Hash::check($request->current_password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Password saat ini tidak cocok.',
            ]);
        }

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }

    /**
     * Hapus akun (dari danger zone)
     */
    public function destroyAccount(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);

        $user = auth()->user();

        if (! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password tidak cocok.']);
        }

        auth()->logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Akun Anda telah dihapus.');
    }
}
