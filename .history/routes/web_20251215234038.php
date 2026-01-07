<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
// Pastikan namespace di sini benar, 'APP' seharusnya 'App'
use App\Http\Controllers\ProdukController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

// Rute Resource Index (mungkin untuk dashboard atau halaman utama)

route::resource('index', IndexController::class);
// Route untuk UserController
route::get('/users', [UserController::class, 'index'])->name('users.index');
// --- Produk Routes ---

// Route untuk menampilkan daftar produk
route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');

// Route untuk menampilkan form pembuatan produk
route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');

// Route untuk menyimpan produk baru
route::post('/produk/store', [ProdukController::class, 'store'])->name('index.store');

// Route untuk menampilkan form edit produk dengan parameter ID
// Catatan: Parameter harus dipisahkan oleh '/' dan diletakkan di dalam kurung kurawal {}

route::get('/produk/edit{id}', [ProdukController::class, 'edit'])->name('index.edit');                               

// Route untuk mengupdate produk dengan parameter ID
route::put('/produk/update{id}', [ProdukController::class, 'update'])->name('index.update');

// Route untuk menghapus produk dengan parameter ID
route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');

route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

route::delete('/produk/delete{id}', [ProdukController::class, 'destroy'])->name('index.destroy');

// Alternatif: Menggunakan Resource Routes untuk mempersingkat semua route CRUD produk
/*
Route::resource('produk', ProdukController::class);
*/


// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Grup Rute untuk Guest (Hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    
    // Login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Registrasi
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Lupa Password
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    // Reset Password
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

// Logout (Harus sudah login)
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Dashboard (Contoh halaman setelah login)
Route::get('/dashboard', function () {
    return "Selamat datang di Dashboard!";
})->middleware(['auth'])->name('dashboard');