<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArmadaController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\JenisLayananController;
use App\Http\Controllers\MitraPerawatanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KontakController;
use App\Models\AkunRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Halaman Utama & Akun Pelanggan
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/simpan-akun', [DashboardController::class, 'simpanAkun']);
Route::get('/hapus/{id}', [DashboardController::class, 'hapusAkun']);

// 4 Halaman Informasi
Route::middleware('auth')->group(function () {
    Route::resource('jenis-layanan', JenisLayananController::class)->except(['create', 'show', 'edit']);
});
Route::middleware('auth')->group(function () {
    Route::resource('jenis-layanan', JenisLayananController::class)->except(['create', 'show', 'edit']);
    Route::resource('mitra-perawatan', MitraPerawatanController::class)->except(['create', 'show', 'edit']);
});
Route::middleware('auth')->group(function () {
    Route::resource('jenis-layanan', JenisLayananController::class)->except(['create', 'show', 'edit']);
    Route::resource('mitra-perawatan', MitraPerawatanController::class)->except(['create', 'show', 'edit']);
    Route::resource('lokasi', LokasiController::class)->except(['create', 'show', 'edit']);
});
Route::middleware('auth')->group(function () {
    Route::resource('jenis-layanan', JenisLayananController::class)->except(['create', 'show', 'edit']);
    Route::resource('mitra-perawatan', MitraPerawatanController::class)->except(['create', 'show', 'edit']);
    Route::resource('lokasi', LokasiController::class)->except(['create', 'show', 'edit']);
    Route::resource('kontak', KontakController::class)->except(['create', 'show', 'edit']);
});

// 3 Modul CRUD Utama (Armada, Paket, Driver)
Route::resource('armada', ArmadaController::class);
Route::resource('paket', PaketController::class);
Route::resource('drivers', DriverController::class);
Route::middleware('auth')->group(function () {
    Route::resource('jenis-layanan', JenisLayananController::class)->except(['create', 'show', 'edit']);
});
// Form Login Pelanggan (sekaligus Edit Akun oleh Owner via ?id=...)
Route::get('/login', function (Request $request) {
    $akun = $request->has('id') ? AkunRental::find($request->id) : null;
    return view('auth.login-pelanggan', compact('akun'));
})->name('login');

// Form Login Owner (Email & Password)
Route::get('/login-owner', fn() => view('auth.login'));

// Proses Submit Login Owner
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
})->name('login.proses');

// Logout
Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');