@extends('layoutes.main')

@section('title', 'Edit Produk')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Produk</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('index.index') }}">Dashboard</a></li>
            {{-- Mengganti $id menjadi $produk (asumsi variabel model yang dikirimkan) --}}
            <li class="breadcrumb-item active">Edit Produk: {{ $produk->nama }}</li> 
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Edit Data Produk
            </div>
            <div class="card-body">
                {{-- PERBAIKAN: Mengganti route ke produk.update dan menggunakan variabel $produk --}}
                <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    {{-- PERBAIKAN: Mengganti form-group menjadi mb-3 (Bootstrap 5) --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        {{-- Menggunakan old('nama', $produk->nama) untuk mempertahankan input lama jika ada, atau data asli sebagai fallback --}}
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $produk->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis:</label>
                        <input type="text" class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis" value="{{ old('jenis', $produk->jenis) }}">
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual:</label>
                        <input type="text" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual" name="harga_jual" value="{{ old('harga_jual', $produk->harga_jual) }}">
                        @error('harga_jual')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="harga_beli" class="form-label">Harga Beli:</label>
                        <input type="text" class="form-control @error('harga_beli') is-invalid @enderror" id="harga_beli" name="harga_beli" value="{{ old('harga_beli', $produk->harga_beli) }}">
                        @error('harga_beli')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi:</label>
                        {{-- PERBAIKAN: Nilai textarea diisi dengan deskripsi produk, bukan ID --}}
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Produk (Kosongkan jika tidak ingin diubah):</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- Menampilkan foto saat ini (Mengganti url() menjadi asset() untuk konvensi Laravel) --}}
                        @if(isset($produk->foto) && !empty($produk->foto))
                            <div class="mt-2">
                                <small class="text-muted d-block mb-1">Foto Saat Ini:</small>
                                <img src="{{ asset('image/' . $produk->foto) }}" alt="Foto Produk" class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                            </div>
                        @else
                            <div class="mt-2">
                                <small class="text-muted d-block mb-1">Foto Saat Ini:</small>
                                <img src="{{ asset('image/nophoto.jpg') }}" alt="No Foto" class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                            </div>
                        @endif
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection