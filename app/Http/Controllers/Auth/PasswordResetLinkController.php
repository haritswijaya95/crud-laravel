<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Tampilkan form lupa kata sandi (GET /forgot-password)
     */
    public function create(): View
    {
        // Mengembalikan view yang sudah kita buat: resources/views/auth/forgot-password.blade.php
        return view('auth.forgot-password');
    }

    /**
     * Tangani permintaan pengiriman tautan reset kata sandi (POST /forgot-password)
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        // Kirim tautan reset kata sandi ke email pengguna
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Beri tahu pengguna apakah tautan berhasil dikirim atau terjadi kesalahan
        return back()->with('status', __($status));
    }
}