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
            Data Produk
            <a href="{{ url('produk/create') }}" class="btn btn-primary btn-sm float-end">Tambah Produk</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Harga Jual</th>
                        <th>Harga Beli</th>
                        <th>Foto</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->nama }}</td>
                        <td>{{ $k->jenis }}</td>
                        <td>Rp {{ number_format($k->harga_jual, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($k->harga_beli, 0, ',', '.') }}</td>
                        <td>
                            @if($k->foto)
                                <img src="{{ asset('storage/img/' . $k->foto) }}" width="50px">
                            @else
                                <span class="badge bg-secondary">No Photo</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('produk.destroy', $k->id) }}" method="POST">
                                <a class="btn btn-info btn-sm" href="{{ route('produk.show', $k->id) }}">Show</a>
                                <a class="btn btn-warning btn-sm" href="{{ route('produk.edit', $k->id) }}">Edit</a>
                                
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin menghapus data {{ $k->nama }}?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection