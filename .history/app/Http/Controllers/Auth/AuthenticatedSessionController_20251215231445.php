<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan form login (GET /login)
     */
    public function create(): View
    {
        // Mengembalikan view yang sudah kita buat: resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Tangani permintaan otentikasi masuk (POST /login)
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Panggil validasi dan otentikasi dari LoginRequest
        $request->authenticate();

        // Regenerasi sesi untuk menghindari serangan Session Fixation
        $request->session()->regenerate();

        // Redirect ke dashboard atau halaman tujuan setelah login
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Hancurkan sesi (Logout) (POST /logout)
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirect kembali ke halaman utama atau login
        return redirect('/');
    }
}