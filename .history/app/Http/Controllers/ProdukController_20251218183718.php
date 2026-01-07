<?php

namespace App\Http\Controllers; // Namespace yang benar

use App\Models\Produk; // Pastikan ini adalah baris 'use' Model Produk Anda
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Hanya jika Anda menggunakannya
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller // SCRIPT YANG ANDA MINTA
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menggunakan Eloquent
        $produk = Produk::all(); 
        return view('produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
   // In your controller (e.g., ProdukController.php)

public function create()
{
    // Return the view for the *creation* form, which does not need $id
    // Assume you name this file resources/views/produk/create.blade.php
    return view('produk.create'); 
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // ... logic simpan data ...

    return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambah!');
    
    // melakukan validasi data
    $request->validate([
        'nama' => 'required|max:45',
        'jenis' => 'required|max:45',
        'harga_jual' => 'required|numeric',
        'harga_beli' => 'required|numeric',
        'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ],
    [
        'nama.required' => 'Nama wajib diisi',
        'nama.max' => 'Nama maksimal 45 karakter',
        'jenis.required' => 'jenis wajib diisi',
        'jenis.max' => 'jenis maksimal 45 karakter',
        'foto.max' => 'Foto maksimal 2 MB',
        'foto.mimes' => 'File ekstensi hanya bisa jpg,png,jpeg,gif, svg',
        'foto.image' => 'File harus berbentuk image'
    ]);
    
    //jika file foto ada yang terupload
    if(!empty($request->foto)){
        //maka proses berikut yang dijalankan
        $fileName = 'foto-'.uniqid().'.'.$request->foto->extension();
        //setelah tau fotonya sudah masuk maka tempatkan ke public
        $request->foto->move(public_path('image'), $fileName);
    } else {
        $fileName = 'nophoto.jpg';
    }
    
    //tambah data produk
    DB::table('produks')->insert([
        'nama'=>$request->nama,
        'jenis'=>$request->jenis,
        'harga_jual'=>$request->harga_jual,
        'harga_beli'=>$request->harga_beli,
        'deskripsi' => $request->deskripsi,
        'foto'=>$fileName,
    ]);
    
    return redirect()->route('index.index');
}
        

    /**
     * Display the specified resource. (Tidak diubah karena biasanya tidak dipakai di CRUD sederhana)
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * Menggunakan Route Model Binding untuk langsung mendapatkan objek Produk.
     */
  // app/Http/Controllers/ProdukController.php

  // Pastikan controller Anda terlihat seperti ini:

  public function edit(Produk $id)
{
    //
    return view('produk.edit', compact('id'));
}
    /**
     * Update the specified resource in storage.
     * Menggunakan Route Model Binding: $produk adalah objek yang akan diupdate.
     */
    public function update(Request $request, Produk $produk)
    {
        // 1. Validasi Data (Sama seperti store)
        $request->validate([
            'nama' => 'required|max:45',
            'jenis' => 'required|max:45',
            'harga_jual' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        
        $fileName = $produk->foto; // Ambil nama foto lama

        // 2. Penanganan Upload dan Penghapusan Foto Lama
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika bukan 'nophoto.jpg' dan file ada
            if ($produk->foto != 'nophoto.jpg') {
                Storage::disk('public')->delete($produk->foto); 
                // Jika Anda menyimpan di public/image:
                // @unlink(public_path('image/' . $produk->foto));
            }

            // Simpan foto baru
            $fileName = $request->file('foto')->store('images', 'public');
            // Jika Anda menyimpan di public/image:
            // $fileName = 'foto-' . $produk->id . '.' . $request->foto->extension();
            // $request->foto->move(public_path('image'), $fileName);
        } 

        // 3. Update data produk (Menggunakan Eloquent)
        $produk->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'deskripsi' => $request->deskripsi,
            'foto' => $fileName,
        ]);
        
        // 4. Perbaikan Pengalihan (Redirect)
        // Ganti 'index.index' (tidak standar) menjadi 'produk.index'
        return redirect()->route('produk.index')
                         ->with('success', 'Data Produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     * Menggunakan Route Model Binding: $produk adalah objek yang akan dihapus.
     */
    public function destroy(Produk $id) // Mengubah $id menjadi $produk
    {
    $id->delete();
    
    return redirect()->route('index.index')
            ->with('success','Data berhasil di hapus' );
 }
}
