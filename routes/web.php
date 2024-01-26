<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TempatMagangController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Admin routes
Route::group(['middleware' => ['auth','role:admin']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.index');
    Route::get('/create', [HomeController::class, 'create'])->name('dashboard.create');
    Route::post('/store', [HomeController::class, 'store'])->name('dashboard.store');
    Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('dashboard.edit');
    Route::put('/update/{id}', [HomeController::class, 'update'])->name('dashboard.update');
    Route::delete('/delete/{id}', [HomeController::class, 'delete'])->name('dashboard.delete');
    Route::get('/print' , [HomeController::class, 'print_pdf'])->name('dashboard.print');


    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
    Route::post('/dosen/store', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/edit/{id}', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::put('/dosen/update/{id}', [DosenController::class, 'update'])->name('dosen.update');
    Route::delete('/dosen/delete/{id}', [DosenController::class, 'delete'])->name('dosen.delete');
    Route::get('/dosen/print' , [DosenController::class, 'print_pdf'])->name('dosen.print');

    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/delete/{id}', [MahasiswaController::class, 'delete'])->name('mahasiswa.delete');
    Route::get('/mahasiswa/print' , [MahasiswaController::class, 'print_pdf'])->name('mahasiswa.print');

    Route::get('/tempat-magang', [TempatMagangController::class, 'index'])->name('tempat-magang.index');
    Route::get('/tempat-magang/create', [TempatMagangController::class, 'create'])->name('tempat-magang.create');
    Route::post('/tempat-magang/store', [TempatMagangController::class, 'store'])->name('tempat-magang.store');
    Route::get('/tempat-magang/edit/{id}', [TempatMagangController::class, 'edit'])->name('tempat-magang.edit');
    Route::put('/tempat-magang/update/{id}', [TempatMagangController::class, 'update'])->name('tempat-magang.update');
    Route::delete('/tempat-magang/delete/{id}', [TempatMagangController::class, 'delete'])->name('tempat-magang.delete');
    Route::get('/tempat-magang/print' , [TempatMagangController::class, 'print_pdf'])->name('tempat-magang.print');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login-process', [LoginController::class, 'loginProcess'])->name('login-process');
});
Route::group(['middleware' => ['auth','role:mahasiswa']], function () {
    Route::get('/dashboard-mahasiswa', [HomeController::class, 'indexMahasiswa'])->name('dashboard.index.mahasiswa');
});
Route::group(['middleware' => ['auth','role:dosen']], function () {
    Route::get('/dashboard-dosen', [HomeController::class, 'indexDosen'])->name('dashboard.index.dosen');
});
// Route::middleware(['auth'])->group(function () {
//     Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
//     Route::middleware(['role:admin'])->group(function () {
//         Route::get('/', [HomeController::class, 'index']);
//         Route::get('/create', [HomeController::class, 'create'])->name('dashboard.create');
//         Route::post('/store', [HomeController::class, 'store'])->name('dashboard.store');
//         Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('dashboard.edit');
//         Route::put('/update/{id}', [HomeController::class, 'update'])->name('dashboard.update');
//         Route::delete('/delete/{id}', [HomeController::class, 'delete'])->name('dashboard.delete');
    
//         Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
//         Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
//         Route::post('/dosen/store', [DosenController::class, 'store'])->name('dosen.store');
//         Route::get('/dosen/edit/{id}', [DosenController::class, 'edit'])->name('dosen.edit');
//         Route::put('/dosen/update/{id}', [DosenController::class, 'update'])->name('dosen.update');
//         Route::delete('/dosen/delete/{id}', [DosenController::class, 'delete'])->name('dosen.delete');
    
//         Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
//         Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
//         Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
//         Route::get('/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
//         Route::put('/mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
//         Route::delete('/mahasiswa/delete/{id}', [MahasiswaController::class, 'delete'])->name('mahasiswa.delete');
    
//         Route::get('/tempat-magang', [TempatMagangController::class, 'index'])->name('tempat-magang.index');
//         Route::get('/tempat-magang/create', [TempatMagangController::class, 'create'])->name('tempat-magang.create');
//         Route::post('/tempat-magang/store', [TempatMagangController::class, 'store'])->name('tempat-magang.store');
//         Route::get('/tempat-magang/edit/{id}', [TempatMagangController::class, 'edit'])->name('tempat-magang.edit');
//         Route::put('/tempat-magang/update/{id}', [TempatMagangController::class, 'update'])->name('tempat-magang.update');
//         Route::delete('/tempat-magang/delete/{id}', [TempatMagangController::class, 'delete'])->name('tempat-magang.delete');
//     });
//     Route::middleware(['role:mahasiswa'])->group(function () {
//         Route::get('/', [HomeController::class, 'indexMahasiswa']);
//     });
//     Route::middleware(['role:dosen'])->group(function () {
//         Route::get('/', [HomeController::class, 'indexDosen']);
//     });
// });