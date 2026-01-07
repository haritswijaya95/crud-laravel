<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () { 
    return view('pages.welcome'); 
});

/*
|--------------------------------------------------------------------------
| Guest Routes (Hanya bisa diakses jika BELUM login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', function () { return view('auth.login'); })->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // Register
    Route::get('/register', function () { return view('auth.register'); })->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    // Forgot Password
    Route::get('/forgot-password', function () { return view('auth.forgot-password'); })->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    
    // Reset Password
    Route::get('/reset-password/{token}', function ($token) { 
        return view('auth.reset-password', ['token' => $token]); 
    })->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Hanya bisa diakses jika SUDAH login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    // CRUD Produk - Menggunakan Resource agar lebih bersih
    // Ini otomatis mencakup index, create, store, edit, update, destroy, show
    Route::resource('produk', ProdukController::class);

    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('index', IndexController::class);
});