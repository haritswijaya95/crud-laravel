@extends('layouts.guest')

@section('title', 'Atur Ulang Kata Sandi')

@section('content')
    <h2 style="text-align: center; margin-bottom: 20px;">Atur Ulang Kata Sandi</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-group" style="margin-bottom: 15px;">
            <label for="email" style="display: block;">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required readonly style="width: 100%; padding: 8px; background-color: #f9f9f9;">
            @error('email')
                <span style="color: red; font-size: 0.8em;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label for="password" style="display: block;">Kata Sandi Baru</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" style="width: 100%; padding: 8px;">
            @error('password')
                <span style="color: red; font-size: 0.8em;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label for="password_confirmation" style="display: block;">Konfirmasi Kata Sandi Baru</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required style="width: 100%; padding: 8px;">
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; padding: 10px; cursor: pointer;">
            Simpan Kata Sandi Baru
        </button>
    </form>
@endsection