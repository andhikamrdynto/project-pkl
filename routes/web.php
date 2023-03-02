<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return redirect(route('login'));
});

Route::group(['middleware' => ['auth']], function() {
    Route::group(['prefix' => 'auth', 'as' => 'auth.' ],function() {
        Route::get('/dashboard', [App\Http\Controllers\MainController::class, 'index'])->name('dashboard');

        Route::name('jurusan.')->group(function() {
            Route::get('/jurusan', [JurusanController::class, 'index'])->name('index');
            Route::get('/jurusan/data', [JurusanController::class, 'getJurusan'])->name('data');
            Route::post('/jurusan/create', [JurusanController::class, 'store'])->name('store');
            Route::get('/jurusan/edit', [JurusanController::class, 'edit'])->name('edit');
            Route::post('/jurusan/update', [JurusanController::class, 'update'])->name('update');
            Route::delete('/jurusan/delete', [JurusanController::class, 'destroy'])->name('destroy');
            Route::get('/jurusan/export', [JurusanController::class, 'export'])->name('export');
        });

        Route::name('mahasiswa.')->group(function() {
            Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('index');
            Route::get('/mahasiswa/data', [MahasiswaController::class, 'getMahasiswa'])->name('data');
            Route::post('/mahasiswa/create', [MahasiswaController::class, 'store'])->name('store');
            Route::get('/mahasiswa/edit', [MahasiswaController::class, 'edit'])->name('edit');
            Route::post('/mahasiswa/update', [MahasiswaController::class, 'update'])->name('update');
            Route::delete('/mahasiswa/delete', [MahasiswaController::class, 'destroy'])->name('destroy');
            Route::get('/mahasiswa/export', [MahasiswaController::class, 'export'])->name('export');
            Route::post('/mahasiswa/import', [MahasiswaController::class, 'import'])->name('import');
        });

        Route::name('dosen.')->group(function() {
            Route::get('/dosen', [DosenController::class, 'index'])->name('index');
            Route::get('/dosen/data', [DosenController::class, 'getDosen'])->name('data');
            Route::post('/dosen/create', [DosenController::class, 'store'])->name('store');
            Route::get('/dosen/edit', [DosenController::class, 'edit'])->name('edit');
            Route::post('/dosen/update', [DosenController::class, 'update'])->name('update');
            Route::delete('/dosen/delete', [DosenController::class, 'destroy'])->name('destroy');
            Route::get('/dosen/export', [DosenController::class, 'export'])->name('export');
            Route::post('/dosen/import', [DosenController::class, 'import'])->name('import');
        });

        Route::name('matakuliah.')->group(function() {
            Route::get('/matakuliah', [MatakuliahController::class, 'index'])->name('index');
            Route::get('/matakuliah/data', [MatakuliahController::class, 'getMatakuliah'])->name('data');
            Route::post('/matakuliah/create', [MatakuliahController::class, 'store'])->name('store');
            Route::get('/matakuliah/edit', [MatakuliahController::class, 'edit'])->name('edit');
            Route::post('/matakuliah/update', [MatakuliahController::class, 'update'])->name('update');
            Route::delete('/matakuliah/delete', [MatakuliahController::class, 'destroy'])->name('destroy');
            Route::get('/matakuliah/export', [MatakuliahController::class, 'export'])->name('export');
        });

    });
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('postLogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('postRegister');
