

@extends('layouts.guest')

@section('title', 'Lupa Kata Sandi')

@section('content')
    <div style="margin-bottom: 20px; text-align: center; color: #555;">
        <p>Masukkan alamat email Anda, dan kami akan mengirimkan tautan untuk mereset kata sandi Anda.</p>
    </div>

    {{-- Status Sesi (Pesan Sukses) --}}
    @if (session('status'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group" style="margin-bottom: 15px;">
            <label for="email" style="display: block; margin-bottom: 5px;">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            @error('email')
                <span class="error-message" style="color: red; font-size: 0.85em; display: block; mt-1">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Kirim Tautan Reset
        </button>
        
        <p style="text-align: center; margin-top: 20px;">
            <a href="{{ route('login') }}" style="text-decoration: none; color: #007bff; font-size: 0.9em;">Kembali ke Login</a>
        </p>
    </form>
@endsection