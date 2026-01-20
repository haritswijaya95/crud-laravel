@extends('layouts.guest')

@section('title', 'Masuk ke Akun Anda')

@section('content')
    @if (session('status'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('status') }}
        </div>
    @endif
    
    <form method="POST" action="{{ route('login') }}">
        @csrf 

        <div class="form-group">
            <label for="email">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
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

        <button type="submit" class="btn-primary">
            Masuk
        </button>

        <p class="text-center">
            Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </p>
    </form>
@endsection