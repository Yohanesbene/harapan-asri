<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\ClientController;
use App\Http\Controllers\User\KeperawatanController;

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
    Route::get('redirects', [HomeController::class, 'index']);
    // Route Admin
    Route::group(['prefix'=>'admin', 'namespace'=>'Admin'], function(){
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('dataPegawai', [PegawaiController::class, 'index'])->name('admin.dataPegawai');
        Route::get('dataPegawai/create', [PegawaiController::class, 'create'])->name('admin.tambahPegawai');
        Route::post('dataPegawai/store', [PegawaiController::class, 'store'])->name('admin.storePegawai');
        Route::get('dataPegawai/edit/{id}', [PegawaiController::class, 'edit']);
        Route::post('dataPegawai/update', [PegawaiController::class, 'update'])->name('admin.updatePegawai');
        Route::get('dataPegawai/delete/{id}', [PegawaiController::class, 'delete']);
        Route::get('printListPegawai', [PegawaiController::class, 'printListPegawai'])->name('admin.printListPegawai');
        Route::get('dataUser', [UserController::class, 'index'])->name('admin.dataUser');
        Route::get('dataUser/create', [UserController::class, 'create'])->name('admin.tambahUser');
        Route::post('dataUser/store', [UserController::class, 'store'])->name('admin.storeUser');
        Route::get('dataUser/edit/{id}', [UserController::class, 'edit']);
        Route::post('dataUser/update', [UserController::class, 'update'])->name('admin.updateUser');
        Route::get('lupaPassword/{id}', [UserController::class, 'resetpw']);
        Route::post('updatePassword', [UserController::class, 'updatepw'])->name('admin.updatepw');
    });

    // Route User
    Route::group(['prefix'=>'user', 'namespace'=>'User'], function(){
        Route::get('dashboard', [ClientController::class, 'index'])->name('user.dashboard');
        Route::get('detailPenghuni/{id}', [ClientController::class, 'detail'])->name('user.detail');
        Route::get('dataPenghuni/createPJ', [ClientController::class, 'createPJ'])->name('user.tambahPJ');
        Route::post('dataPenghuni/storePJ', [ClientController::class, 'storePJ'])->name('user.storePJ');
        Route::get('dataPenghuni/create', [ClientController::class, 'create'])->name('user.tambahPenghuni');
        Route::post('dataPenghuni/store', [ClientController::class, 'store'])->name('user.storePenghuni');
        Route::get('editPenghuni/{id}', [ClientController::class, 'edit']);
        Route::post('updatePenghuni/{id}', [ClientController::class, 'update']);
        Route::post('updatePenghuni', [ClientController::class, 'update'])->name('user.updatePenghuni');
        Route::get('deletePenghuni/{id}', [ClientController::class, 'delete'])->name('user.deletePenghuni');
        Route::get('printListClient', [ClientController::class, 'printListClient'])->name('user.printListClient');
        Route::get('detailPenghuni/printDetailClient/{id}', [ClientController::class, 'printDetailClient'])->name('user.printDetailClient');
        Route::get('keperawatan', [KeperawatanController::class, 'index'])->name('user.keperawatan');
        Route::get('keperawatan/createBerat', [KeperawatanController::class, 'createBerat'])->name('user.berat');
        Route::post('keperawatan/storeBerat', [KeperawatanController::class, 'storeBerat'])->name('user.storeBerat');
        Route::get('keperawatan/createNadi', [KeperawatanController::class, 'createNadi'])->name('user.nadi');
        Route::post('keperawatan/storeNadi', [KeperawatanController::class, 'storeNadi'])->name('user.storeNadi');
        Route::get('keperawatan/createSuhu', [KeperawatanController::class, 'createSuhu'])->name('user.suhu');
        Route::post('keperawatan/storeSuhu', [KeperawatanController::class, 'storeSuhu'])->name('user.storeSuhu');
        Route::get('keperawatan/createSpO2', [KeperawatanController::class, 'createSpO2'])->name('user.spo2');
        Route::post('keperawatan/storeSpO2', [KeperawatanController::class, 'storeSpO2'])->name('user.storeSpO2');
        Route::get('keperawatan/createTekananDarah', [KeperawatanController::class, 'createTekananDarah'])->name('user.tekananDarah');
        Route::post('keperawatan/storeTekananDarah', [KeperawatanController::class, 'storeTekananDarah'])->name('user.storeTekananDarah');
        Route::get('keperawatan/createCekObat', [KeperawatanController::class, 'createCekObat'])->name('user.cekObat');
        Route::post('keperawatan/storeCekObat', [KeperawatanController::class, 'storeCekObat'])->name('user.storeCekObat');
        Route::get('keperawatan/createPemberianObat', [KeperawatanController::class, 'createPemberianObat'])->name('user.pemberianObat');
        Route::post('keperawatan/storePemberianObat', [KeperawatanController::class, 'storePemberianObat'])->name('user.storePemberianObat');
        Route::get('keperawatan/createNutrisi', [KeperawatanController::class, 'createNutrisi'])->name('user.nutrisi');
        Route::post('keperawatan/storeNutrisi', [KeperawatanController::class, 'storeNutrisi'])->name('user.storeNutrisi');
        Route::get('keperawatan/createCairan', [KeperawatanController::class, 'createCairan'])->name('user.cairan');
        Route::post('keperawatan/storeCairan', [KeperawatanController::class, 'storeCairan'])->name('user.storeCairan');
        Route::get('keperawatan/createGDS', [KeperawatanController::class, 'createGDS'])->name('user.gds');
        Route::post('keperawatan/storeGDS', [KeperawatanController::class, 'storeGDS'])->name('user.storeGDS');
        Route::get('keperawatan/createAsamUrat', [KeperawatanController::class, 'createAsamUrat'])->name('user.asamUrat');
        Route::post('keperawatan/storeAsamUrat', [KeperawatanController::class, 'storeAsamUrat'])->name('user.storeAsamUrat');
        Route::get('keperawatan/createKolesterol', [KeperawatanController::class, 'createKolesterol'])->name('user.kolesterol');
        Route::post('keperawatan/storeKolesterol', [KeperawatanController::class, 'storeKolesterol'])->name('user.storeKolesterol');
        Route::get('keperawatan/createMobilisasi', [KeperawatanController::class, 'createMobilisasi'])->name('user.mobilisasi');
        Route::post('keperawatan/storeMobilisasi', [KeperawatanController::class, 'storeMobilisasi'])->name('user.storeMobilisasi');
        Route::get('keperawatan/createPeminjamanAlat', [KeperawatanController::class, 'createPeminjamanAlat'])->name('user.peminjamanAlat');
        Route::post('keperawatan/storePeminjamanAlat', [KeperawatanController::class, 'storePeminjamanAlat'])->name('user.storePeminjamanAlat');
        // Route::get('keperawatan/cariPenghuni', [KeperawatanController::class, 'loadPenghuni']);
        // Route::get('menuKeperawatan/{id}', [KeperawatanController::class, 'menu'])->name('user.menuKeperawatan');
        
        // Route::get('menuKeperawatan/{id}/berat/create', [KeperawatanController::class, 'create'])->name('user.inputBerat');
        // Route::post('berat/store', [KeperawatanController::class, 'store'])->name('user.storeBerat');
    });

    
});

require __DIR__.'/auth.php';
