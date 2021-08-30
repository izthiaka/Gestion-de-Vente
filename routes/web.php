<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;

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

Route::get(
    '/', function () {
        return redirect()->route('login');
    }
);

Auth::routes([
    'register' => false,
    'verify' => false,
]);

Route::middleware(['auth', 'isAD'])->prefix('admin')->group(function() {

    Route::get('/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard');
    Route::get('/change-password', [ChangePasswordController::class, 'AfirstPassword'])->name('admin.change-password');
    Route::post('/form-change-password', [ChangePasswordController::class, 'a_update_password'])->name('admin.form-change-password');

    // Route::get('/profil', [AdminController::class, 'profil'])->name('admin.profil');
});

Route::middleware(['auth', 'isAG'])->group(function() {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('agent.dashboard');
    Route::get('/change-password', [ChangePasswordController::class, 'firstPassword'])->name('agent.change-password');
    Route::post('/form-change-password', [ChangePasswordController::class, 'update_password'])->name('agent.form-change-password');
});
