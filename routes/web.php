<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware'=>'auth'], function(){
    // Route Admin
    Route::group(['prefix'=>'admin', 'namespace'=>'Admin'], function(){
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });

    // Route User
    Route::group(['prefix'=>'user', 'namespace'=>'User'], function(){
        Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    });
});

require __DIR__.'/auth.php';
