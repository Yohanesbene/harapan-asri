<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\ClientController;

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
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::group(['middleware'=>'auth'], function(){
    // Route Admin
    Route::group(['prefix'=>'admin', 'namespace'=>'Admin'], function(){
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('dataPegawai', [PegawaiController::class, 'index'])->name('admin.dataPegawai');
        Route::get('dataPegawai/create', [PegawaiController::class, 'create'])->name('admin.tambahPegawai');
        Route::post('dataPegawai/store', [PegawaiController::class, 'store'])->name('admin.storePegawai');
        Route::get('dataPegawai/edit/{id}', [PegawaiController::class, 'edit']);
        Route::post('dataPegawai/update', [PegawaiController::class, 'update'])->name('admin.updatePegawai');
        Route::get('dataPegawai/delete/{id}', [PegawaiController::class, 'delete']);
        Route::get('dataUser', [UserController::class, 'index'])->name('admin.dataUser');
        Route::get('dataUser/edit/{id}', [UserController::class, 'edit']);
        Route::post('dataUser/update', [UserController::class, 'update'])->name('admin.updateUser');
        Route::get('dataUser/delete/{id}', [UserController::class, 'delete']);
    });

    // Route User
    Route::group(['prefix'=>'user', 'namespace'=>'User'], function(){
        Route::get('dashboard', [ClientController::class, 'index'])->name('user.dashboard');
    });
});

require __DIR__.'/auth.php';
