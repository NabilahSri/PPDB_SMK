<?php

use App\Http\Controllers\AsalSekolahController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrosurController;
use App\Http\Controllers\CalonSiswaController;
use App\Http\Controllers\CetakKartuController;
use App\Http\Controllers\DaftarUlangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataFileController;
use App\Http\Controllers\DataOrtuController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\GelombangController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KonfirmasiPembayaranController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index']);
Route::get('/brosur/download', [LandingPageController::class, 'download'])->name('brosur.download');

Route::get('/login', function () {
    return view('pages.peserta.auth.loginPage');
});

Route::get('/daftar', function () {
    return view('pages.peserta.auth.daftarPage');
});

Route::post('/login', [AuthController::class, 'login'])->name('login.siswa');
Route::post('/daftar', [AuthController::class, 'daftarSiswa'])->name('daftar.siswa');

Route::get('/pages/admin/login', [AuthController::class, 'showLoginForm'])->name('login.admin');
Route::post('/pages/admin/login', [AuthController::class, 'login'])->name('login.admin');

//admin
Route::middleware(['checkrole:admin'])->group(function () {
    Route::get('/pages/admin/dashboard', [DashboardController::class,'index'])->name('dashboard.admin');
    Route::resource('pages/admin/pendaftar', PendaftarController::class);
    Route::get('pages/admin/pendaftar/data-ortu/{id}', [PendaftarController::class, 'dataOrtu'])->name('pendaftar.data-ortu');
    Route::PUT('pages/admin/pendaftar/data-ortu/{id}', [PendaftarController::class, 'updateDataOrtu'])->name('pendaftar.data-ortu.update');
    Route::POST('pages/admin/pendaftar/data-ortu/{id}', [PendaftarController::class, 'storeDataOrtu'])->name('pendaftar.data-ortu.store');
    Route::resource('pages/admin/calon-siswa', CalonSiswaController::class);
    Route::resource('pages/admin/siswa', SiswaController::class);
    Route::post('pages/admin/siswa/toggle-daftar-ulang/{id}', [SiswaController::class, 'toggleDaftarUlang'])->name('siswa.toggleDaftarUlang');
    Route::resource('pages/admin/pembayaran', PembayaranController::class);
    Route::patch('pembayaran/{id}/verify', [PembayaranController::class, 'verify'])->name('pembayaran.verify');
    Route::resource('/pages/admin/jurusan', JurusanController::class);
    Route::resource('/pages/admin/sekolah', AsalSekolahController::class);
    Route::resource('/pages/admin/brosur', BrosurController::class);
    Route::resource('/pages/admin/kontak', KontakController::class);
    Route::resource('/pages/admin/users', UserController::class);
    Route::resource('/pages/admin/daftar-ulang', DaftarUlangController::class);
    Route::resource('/pages/admin/gelombang', GelombangController::class);
    Route::resource('/pages/admin/tahun-ajaran', TahunAjaranController::class);
    Route::post('/pages/admin/tahun-ajaran/{id}/change-status', [TahunAjaranController::class, 'changeStatus'])->name('tahun-ajaran.changeStatus');
    Route::get('/gelombang/get-latest/{tahunAjaranId}', [GelombangController::class, 'getLatestGelombang']);
    Route::post('pages/admin/daftar-ulang/toggle-daftar-ulang/{id}', [DaftarUlangController::class, 'toggleDaftarUlang'])->name('daftar-ulang.toggleDaftarUlang');
    Route::resource('pages/admin/cetak-kartu-siswa', CetakKartuController::class);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

//siswa
Route::middleware(['checkrole:siswa'])->group(function () {
    Route::resource('pages/peserta/data-siswa', DataSiswaController::class);
    Route::resource('pages/peserta/data-ortu', DataOrtuController::class);
    Route::resource('pages/peserta/data-file', DataFileController::class);
    Route::resource('pages/peserta/konfirmasi-pembayaran', KonfirmasiPembayaranController::class);
    Route::resource('pages/peserta/cetak-kartu', CetakKartuController::class);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
