<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
// Pastikan namespace di sini benar, 'APP' seharusnya 'App'
use App\Http\Controllers\ProdukController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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


Route::group(['middleware' => 'guest'], function () {
    // Tampilkan Form Login
Route::get('/login', function () { return view('auth.login'); })->name('login');
    // Proses Login (biasanya diarahkan ke Controller)
Route::post('/login', [/* LoginController atau Auth\AuthenticatedSessionController */])->name('login.post');

    // Tampilkan Form Registrasi
Route::get('/register', function () { return view('auth.register'); })->name('register');
    // Proses Registrasi
Route::post('/register', [/* RegisterController atau Auth\RegisteredUserController */])->name('register.post');

    // Tampilkan Form Lupa Kata Sandi
Route::get('/forgot-password', function () { return view('auth.forgot-password'); })->name('password.request');
    // Kirim Email Reset Password
Route::post('/forgot-password', [/* PasswordResetLinkController */])->name('password.email');

    // Rute Reset Kata Sandi (Tambahan)
Route::get('/reset-password/{token}', function ($token) { return view('auth.reset-password', ['token' => $token]); })->name('password.reset');
Route::post('/reset-password', [/* NewPasswordController */])->name('password.update');
});


// Rute Logout (Perlu middleware 'auth')
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')->name('logout');

// Rute Dashboard (Hanya bisa diakses setelah login)
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute untuk halaman utama
Route::get('/', function () { return view('pages.welcome'); });