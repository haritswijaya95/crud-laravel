<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create()
    {
        // Mengarah ke file resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Proses percobaan login.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Coba mencocokkan kredensial (Email & Password)
        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'), // Pesan: "Email atau password salah."
            ]);
        }

        // 3. Regenerasi session untuk keamanan
        $request->session()->regenerate();

        // 4. Redirect ke halaman dashboard atau halaman sebelumnya
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Proses Logout.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}