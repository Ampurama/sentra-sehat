<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\TindakanIntervensiController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\KesehatanLingkunganController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\KesehatanGiziController;
use App\Http\Controllers\KesehatanAnakIbuController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\userController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Halaman Depan Publik (sebelum login)
Route::get('/', function () {
    return view('welcome');
});

// Patient Login Routes
Route::get('/patient/login', [PatientController::class, 'showLoginForm'])->name('patient.login.form');
Route::post('/patient/login', [PatientController::class, 'login'])->name('patient.login');

// Patient Logout Routes (outside auth middleware)
Route::get('/patient/logout', [PatientController::class, 'logout'])->name('patient.logout');

// Rute Otentikasi (Login, Register, Reset Password)
Auth::routes();

// Override login route to prevent patient access to admin login
Route::get('/login', function () {
    // Check if user is already logged in and is a patient
    if (auth()->check() && auth()->user()->role && auth()->user()->role->name === 'patient') {
        return redirect('/login')->with('error', 'Sebagai pasien, silakan login melalui halaman login pasien.');
    }

    // Check cookie to determine default login type
    $defaultLoginType = request()->cookie('user_type', 'admin'); // default to admin if no cookie

    return view('auth.login', compact('defaultLoginType'));
})->name('login')->middleware('guest');

// Rute Home/Dashboard setelah Login
Route::get('/home', [HomeController::class, 'index'])->name('home');


// =========================================================================
// RUTE SISTEM SENTRA SEHAT (Membutuhkan Login)
// =========================================================================
Route::middleware(['auth'])->group(function () {

    // Patient Dashboard (only for patient role)
    Route::middleware('role:patient')->group(function () {
        Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    });



    // ---------------------------------------------------------------------
    // 1. MODUL PENGELOLAAN DATA PENDUDUK
    // ---------------------------------------------------------------------
    // Route Resource untuk CRUD Penduduk. Middleware dipanggil dari constructor Controller.
    // Exclude patient role from accessing penduduk routes
    Route::middleware('role:super_admin,dinkes_admin,puskesmas_admin,dokter,kades')->resource('penduduk', PendudukController::class);

    // ---------------------------------------------------------------------
    // 2. MODUL TINDAKAN INTERVENSI (diakses oleh Dokter, Puskesmas Admin, dan Super Admin)
    // ---------------------------------------------------------------------
    // Exclude patient role from accessing admin routes
    Route::middleware('role:super_admin,dinkes_admin,puskesmas_admin,dokter,kades')->group(function () {
        Route::resource('intervensi', TindakanIntervensiController::class);
        Route::resource('wilayah', WilayahController::class);
        Route::resource('obat', ObatController::class);
        Route::resource('kesehatan_lingkungan', KesehatanLingkunganController::class);
        Route::resource('penyakit', PenyakitController::class);
        Route::resource('kesehatan_gizi', KesehatanGiziController::class);
        Route::resource('kesehatan_anak_ibu', KesehatanAnakIbuController::class);
        Route::get('/dashboard/wilayah-table', [HomeController::class, 'wilayahTable'])->name('dashboard.wilayah-table');
    });
    // ---------------------------------------------------------------------
    // 3. MODUL MASTER DATA & ADMINISTRASI (Contoh)
    // ---------------------------------------------------------------------
    Route::middleware('role:super_admin|dinkes_admin')->group(function () {

        // Tempat rute admin dan laporan di sini
    });

    // ---------------------------------------------------------------------
    // 4. MODUL PENGELOLAAN USER (Hanya untuk Super Admin)
    // ---------------------------------------------------------------------
    Route::middleware('role:super_admin')->group(function () {
        Route::resource('users', App\Http\Controllers\UserController::class)->except(['show']);
        Route::get('/users/create-puskesmas-admin', [App\Http\Controllers\UserController::class, 'createPuskesmasAdmin'])->name('users.create_puskesmas_admin');
        Route::post('/users/store-puskesmas-admin', [App\Http\Controllers\UserController::class, 'storePuskesmasAdmin'])->name('users.store_puskesmas_admin');
        Route::get('/users/create-kades', [App\Http\Controllers\UserController::class, 'createKades'])->name('users.create_kades');
        Route::post('/users/store-kades', [App\Http\Controllers\UserController::class, 'storeKades'])->name('users.store_kades');
    });
    
    
});
