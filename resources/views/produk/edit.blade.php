@extends('layoutes.main') 

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Edit data
            </div>
            <div class="card-body">
                {{-- Form action menggunakan route index.update, pastikan route ini didefinisikan untuk method PUT/PATCH --}}
                <form action="{{ route('index.update', $id->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    
                    <div class="form-group mb-3">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $id->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="jenis">Jenis:</label>
                        <input type="text" class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis" value="{{ old('jenis', $id->jenis) }}">
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="harga_jual">Harga Jual:</label>
                        <input type="text" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual" name="harga_jual" value="{{ old('harga_jual', $id->harga_jual) }}">
                        @error('harga_jual')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="harga_beli">Harga Beli:</label>
                        <input type="text" class="form-control @error('harga_beli') is-invalid @enderror" id="harga_beli" name="harga_beli" value="{{ old('harga_beli', $id->harga_beli) }}">
                        @error('harga_beli')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi:</label>
                        {{-- PERBAIKAN: Menggunakan $id->deskripsi untuk nilai textarea --}}
                        <textarea class="form-control" id="deskripsi" name="deskripsi">{{ old('deskripsi', $id->deskripsi) }}</textarea>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="foto">Foto Produk:</label>
                        <input type="file" class="form-control" id="foto" name="foto">

                        {{-- Menampilkan foto saat ini --}}
                        <div class="mt-2">
                            @if(isset($id->foto) && !empty($id->foto))
                                <img src="{{ url('image/' . $id->foto) }}" alt="Foto Produk Saat Ini" class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                            @else
                                <img src="{{ url('image/nophoto.jpg') }}" alt="No Foto" class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                            @endif
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection