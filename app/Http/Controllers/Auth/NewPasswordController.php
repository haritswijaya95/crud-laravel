<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Tampilkan form reset kata sandi (GET /reset-password/{token})
     */
    public function create(Request $request): View
    {
        // Mengembalikan view reset-password.blade.php dengan membawa token dan email
        // Catatan: Anda perlu membuat resources/views/auth/reset-password.blade.php
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Tangani permintaan untuk mereset kata sandi (POST /reset-password)
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Proses reset kata sandi menggunakan facade Password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                ])->save();
            }
        );

        // Jika berhasil, redirect ke login dengan pesan sukses
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        // Jika gagal, kembali dengan error
        return back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}