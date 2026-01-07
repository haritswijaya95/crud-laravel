// resources/views/auth/forgot-password.blade.php

@extends('layouts.guest')

@section('title', 'Lupa Kata Sandi')

@section('content')
    <div style="margin-bottom: 15px;">
        Masukkan alamat email Anda, dan kami akan mengirimkan tautan untuk mereset kata sandi Anda.
    </div>

    @if (session('status'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-primary">
            Kirim Tautan Reset
        </button>
        
        <p class="text-center">
            <a href="{{ route('login') }}">Kembali ke Login</a>
        </p>
    </form>
@endsection