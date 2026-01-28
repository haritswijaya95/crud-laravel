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
| Root Route - Mengarahkan halaman utama ke login jika belum masuk
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

/*
|--------------------------------------------------------------------------
| Public/Test Routes
|--------------------------------------------------------------------------
*/
Route::get('/test', function () {
    return response()->json(['message' => 'API OK']);
});

/*
|--------------------------------------------------------------------------
| Guest Routes (Hanya untuk yang BELUM login)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {
    // Login
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // Register
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register'); // Perbaiki ke method create
    Route::post('/register', [RegisteredUserController::class, 'store']);

    // Forgot/Reset Password
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Hanya untuk yang SUDAH login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    // CRUD Produk (Sudah mencakup create, store, edit, update, destroy)
    Route::resource('produk', ProdukController::class);

    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('index', IndexController::class);

    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});