<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store']);
Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/resetpw', [App\Http\Controllers\LoginController::class, 'resetpw'])->name('resetpw')->middleware('guest');
Route::post('/resetpw', [App\Http\Controllers\LoginController::class, 'sendlink']);
Route::get('/resetpw/{token}', [App\Http\Controllers\LoginController::class, 'formpw'])->name('formpw')->middleware('guest');
Route::post('/reset_pw', [App\Http\Controllers\LoginController::class, 'reset_password'])->name('reset_pw')->middleware('guest');

Route::group(['middleware' => ['auth']], function() {
    Route::group(['middleware' => ['pakar']], function(){
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'index_admin'])->name('p_dashboard');

        //HAMA ADMIN
        Route::get('/hama', [App\Http\Controllers\HamaController::class, 'index_admin'])->name('hama');
        Route::post('/tambah_hama',[App\Http\Controllers\HamaController::class, 'tambah'])->name('tambah_hama');
        Route::get('/edit_hama/{id}',[App\Http\Controllers\HamaController::class, 'edit'])->name('edit_hama');
        Route::post('/update_hama/{id}',[App\Http\Controllers\HamaController::class, 'update'])->name('update_hama');
        Route::post('/update_gbhama/{id}',[App\Http\Controllers\HamaController::class, 'updatefoto'])->name('update_gbhama');
        Route::get('/delete_hama/{id}',[App\Http\Controllers\HamaController::class, 'delete'])->name('delete_hama');

        //GEJALA ADMIN
        Route::get('/gejala', [App\Http\Controllers\GejalaController::class, 'index_admin'])->name('gejala');
        Route::post('/tambah_gejala',[App\Http\Controllers\GejalaController::class, 'tambah'])->name('tambah_gejala');
        Route::get('/edit_gejala/{id}',[App\Http\Controllers\GejalaController::class, 'edit'])->name('edit_gejala');
        Route::post('/update_gejala/{id}',[App\Http\Controllers\GejalaController::class, 'update'])->name('update_gejala');
        Route::post('/update_gbgejala/{id}',[App\Http\Controllers\GejalaController::class, 'updatefoto'])->name('update_gbgejala');
        Route::get('/delete_gejala/{id}',[App\Http\Controllers\GejalaController::class, 'delete'])->name('delete_gejala');

        //BASIS ATURAN ADMIN
        Route::get('/basisaturan', [App\Http\Controllers\BasisaturanController::class, 'index_admin'])->name('basisaturan');
        Route::post('/tambah_basisaturan',[App\Http\Controllers\BasisaturanController::class, 'tambah'])->name('tambah_basisaturan');
        Route::get('/edit_basisaturan/{id}',[App\Http\Controllers\BasisaturanController::class, 'edit'])->name('edit_basisaturan');
        Route::post('/update_basisaturan/{id}',[App\Http\Controllers\BasisaturanController::class, 'update'])->name('update_basisaturan');
        Route::get('/delete_basisaturan/{id}',[App\Http\Controllers\BasisaturanController::class, 'delete'])->name('delete_basisaturan');

        //HASIL ADMIN
        Route::get('/riwayat/{id_user}', [App\Http\Controllers\HasilController::class, 'index'])->name('riwayat');
        Route::get('/riwayat/hasil/{id_hasil}', [App\Http\Controllers\HasilController::class, 'riwayat_hasil'])->name('riwayat_hasil');
        Route::get('/hasil', [App\Http\Controllers\HasilController::class, 'index_admin'])->name('hasil');
        Route::get('/delete_hasil/{id}',[App\Http\Controllers\HasilController::class, 'delete'])->name('delete_hasil');

        //USER ADMIN
        Route::get('/user', [App\Http\Controllers\UserController::class, 'index_admin'])->name('user');
        Route::post('/tambah_user',[App\Http\Controllers\UserController::class, 'tambah'])->name('tambah_user');
        Route::get('/edit_user/{id}',[App\Http\Controllers\UserController::class, 'edit'])->name('edit_user');
        Route::post('/update_user/{id}',[App\Http\Controllers\UserController::class, 'update'])->name('update_user');
        Route::get('/delete_user/{id}',[App\Http\Controllers\UserController::class, 'delete'])->name('delete_user');
    });

    Route::group(['middleware' => ['user']], function(){
        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

        //USER
        Route::get('/info_hama', [App\Http\Controllers\HamaController::class, 'index'])->name('info_hama');
        Route::get('/info_hama/{id}', [App\Http\Controllers\HamaController::class, 'detail'])->name('detail_hama');
        Route::get('/riwayat/{id_user}', [App\Http\Controllers\HasilController::class, 'index'])->name('riwayat');

        Route::get('/konsultasi', [App\Http\Controllers\GejalaController::class, 'konsultasi'])->name('konsultasi');
        Route::post('/mulai', [App\Http\Controllers\GejalaController::class, 'mulai'])->name('mulai');
        Route::get('/konsultasi_detail', [App\Http\Controllers\GejalaController::class, 'konsultasi_detail'])->name('konsultasi_detail');
        Route::post('/konsultasi_detail', [App\Http\Controllers\GejalaController::class, 'r2'])->name('r2');

        Route::get('/detail_hasil/{id}',[App\Http\Controllers\HasilController::class, 'detail'])->name('detail_hasil');        
        Route::get('/selesai', [App\Http\Controllers\GejalaController::class, 'selesai'])->name('selesai');
    });
});