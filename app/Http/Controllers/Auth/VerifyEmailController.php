<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Tampilkan halaman verifikasi email
     */
    public function show()
    {
        return view('auth.verify-email');
    }

    /**
     * Proses verifikasi email dari link yang dikirim
     */
    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home')->with('status', 'Email sudah terverifikasi.');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->route('home')->with('status', 'Email berhasil diverifikasi!');
    }

    /**
     * Kirim ulang email verifikasi
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Link verifikasi telah dikirim ulang ke email Anda.');
    }
}
