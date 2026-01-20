@extends('layouts.guest')

@section('title', 'Masuk ke Akun Anda')

@section('content')
    {{-- Menampilkan Status (misal setelah reset password) --}}
    @if (session('status'))
        <div style="color: green; margin-bottom: 15px; font-weight: bold;">
            {{ session('status') }}
        </div>
    @endif
    
    <form method="POST" action="{{ route('login') }}">
        @csrf 

        <div class="form-group" style="margin-bottom: 15px;">
            <label for="email" style="display: block;">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus style="width: 100%; padding: 8px;">
            @error('email')
                <span class="error-message" style="color: red; font-size: 0.8em;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label for="password" style="display: block;">Kata Sandi</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" style="width: 100%; padding: 8px;">
            @error('password')
                <span class="error-message" style="color: red; font-size: 0.8em;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember" style="display: inline; font-weight: normal;">Ingat Saya</label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size: 0.9em;">
                    Lupa Kata Sandi?
                </a>
            @endif
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; padding: 10px; cursor: pointer;">
            Masuk
        </button>

        <p class="text-center" style="margin-top: 15px; text-align: center;">
            Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </p>
    </form>
@endsection