<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Prefix untuk /master
Route::prefix('master')->group(function () {

    //
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/manga', [App\Http\Controllers\MangaController::class, 'index'])->name('get.manga');
        Route::get('/manga/tambah', [App\Http\Controllers\MangaController::class, 'tambah'])->name('get.tambah.manga');
        Route::post('/manga/tambah/proses', [App\Http\Controllers\MangaController::class, 'proses_tambah'])->name('post.proses-tambah.manga');
        Route::get('/manga/detail/{id}', [App\Http\Controllers\MangaController::class, 'detail'])->name('get.detail.manga');
        Route::get('/manga/ubah/{id}', [App\Http\Controllers\MangaController::class, 'ubah'])->name('get.ubah.manga');
        Route::patch('/manga/ubah/proses/{id}', [App\Http\Controllers\MangaController::class, 'proses_ubah'])->name('post.proses-ubah.manga');
        Route::delete('/manga/hapus/{id}', [App\Http\Controllers\MangaController::class, 'hapus'])->name('delete.manga');
    });


    //
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/pengarang', [App\Http\Controllers\PengarangController::class, 'index'])->name('get.pengarang');
        Route::get('/pengarang/tambah', [App\Http\Controllers\PengarangController::class, 'tambah'])->name('get.tambah.pengarang');
        Route::post('/pengarang/tambah/proses', [App\Http\Controllers\PengarangController::class, 'proses_tambah'])->name('post.proses-tambah.pengarang');
        Route::get('/pengarang/detail/{id}', [App\Http\Controllers\PengarangController::class, 'detail'])->name('get.detail.pengarang');
        Route::get('/pengarang/ubah/{id}', [App\Http\Controllers\PengarangController::class, 'ubah'])->name('get.ubah.pengarang');
        Route::patch('/pengarang/ubah/proses/{id}', [App\Http\Controllers\PengarangController::class, 'proses_ubah'])->name('post.proses-ubah.pengarang');
        Route::delete('/pengarang/hapus/{id}', [App\Http\Controllers\PengarangController::class, 'hapus'])->name('delete.pengarang');
    });


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
