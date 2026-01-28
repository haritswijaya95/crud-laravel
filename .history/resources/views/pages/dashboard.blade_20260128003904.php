@extends('layouts.app')

@section('content')
    <h1>Selamat Datang di Dashboard</h1>
    <p>Anda berhasil login ke sistem manajemen produk.</p>
    
    <div class="stats">
        <a href="{{ route('produk.index') }}" style="padding: 10px; background: blue; color: white; text-decoration: none; border-radius: 5px;">
            Kelola Produk Sekarang
        </a>
    </div>
@endsection