<?php

use App\Http\Controllers\Admin\ApprovisionnementController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\UtilisateurController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Agent\ApprovisionnemntController;
use App\Http\Controllers\Agent\UserController;
use App\Http\Controllers\Agent\VenteController;
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

    Route::get('/profil', [UtilisateurController::class, 'profil'])->name('admin.profil');
    Route::put('/profil_update', [UtilisateurController::class, 'update_profile'])->name('admin.auth-update_profile');
    Route::put('/profil_password', [UtilisateurController::class, 'update_password'])->name('admin.auth-update_password');

    Route::get('/utilisateur', [UtilisateurController::class, 'index'])->name('admin.user-list');
    Route::get('/utilisateur/{id}', [UtilisateurController::class, 'edit'])->name('admin.user-edit');
    Route::put('/utilisateur/{id}/update', [UtilisateurController::class, 'update'])->name('admin.user-update');
    Route::get('utilisateurs_search', [UtilisateurController::class, 'index'])->name('admin.user-search');
    Route::put('/statut/{id}', [UtilisateurController::class, 'statut'])->name('admin.user-statut');
    Route::get('/utilisateur/create', [UtilisateurController::class, 'create'])->name('admin.user-create');
    Route::post('/utilisateur/store', [UtilisateurController::class, 'store'])->name('admin.user-store');

    Route::get('/categories', [CategorieController::class, 'index'])->name('admin.categorie-list');
    Route::get('/categories_search', [CategorieController::class, 'index'])->name('admin.categorie-search');
    Route::post('/categories/store', [CategorieController::class, 'store'])->name('admin.categorie-store');
    Route::put('/categories/{id}/update', [CategorieController::class, 'update'])->name('admin.categorie-update');
    Route::delete('/categories/{id}/destroy', [CategorieController::class, 'destroy'])->name('admin.categorie-destroy');

    Route::get('/articles', [ArticleController::class, 'index'])->name('admin.article-list');
    Route::get('/articles_search', [ArticleController::class, 'index'])->name('admin.article-search');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('admin.article-create');
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('admin.article-store');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('admin.article-edit');
    Route::put('/articles/{id}/update', [ArticleController::class, 'update'])->name('admin.article-update');

    Route::get('/approvisionnement', [ApprovisionnementController::class, 'index'])->name('admin.approvisionnement-list');
    Route::get('/approvisionnement_search', [ApprovisionnementController::class, 'index'])->name('admin.approvisionnement-search');
    Route::get('/approvisionnement/create', [ApprovisionnementController::class, 'create'])->name('admin.approvisionnement-create');
    Route::post('/approvisionnement/store', [ApprovisionnementController::class, 'store'])->name('admin.approvisionnement-store');
    Route::put('/approvisionnement/{id}/update', [ApprovisionnementController::class, 'UpdateRefused'])->name('admin.approvisionnement-update');
    Route::delete('/approvisionnement/{id}/delete', [ApprovisionnementController::class, 'delete'])->name('admin.approvisionnement-delete');
});

Route::middleware(['auth', 'isAG'])->group(function() {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('agent.dashboard');
    Route::get('/change-password', [ChangePasswordController::class, 'firstPassword'])->name('agent.change-password');
    Route::post('/form-change-password', [ChangePasswordController::class, 'update_password'])->name('agent.form-change-password');

    Route::get('/profil', [UserController::class, 'profil'])->name('agent.profil');
    Route::put('/profil_update', [UserController::class, 'update_profile'])->name('agent.auth-update_profile');
    Route::put('/profil_password', [UserController::class, 'update_password'])->name('agent.auth-update_password');

    Route::get('/client', [UserController::class, 'index'])->name('agent.client-list');
    Route::post('/client/store', [UserController::class, 'store_client'])->name('agent.client-store');
    Route::put('/client/{id}/update', [UserController::class, 'update_client'])->name('agent.client-update');

    Route::get('/approvisionnement', [ApprovisionnemntController::class, 'index'])->name('agent.approvisionnement-list');
    Route::get('/approvisionnement_search', [ApprovisionnemntController::class, 'index'])->name('agent.approvisionnement-search');
    Route::get('/approvisionnement/{id}/valid', [ApprovisionnemntController::class, 'validated'])->name('agent.approvisionnement-valid');
    Route::get('/approvisionnement/{id}/refuse', [ApprovisionnemntController::class, 'Refused'])->name('agent.approvisionnement-refuse');
    Route::get('/approvisionnement/{id}/save', [ApprovisionnemntController::class, 'RetourSave'])->name('agent.approvisionnement-RetourSave');

    Route::get('/vente', [VenteController::class, 'index'])->name('agent.vente-list');
    Route::get('/vente_search', [VenteController::class, 'index'])->name('agent.vente-search');
    Route::get('/vente/create', [VenteController::class, 'create'])->name('agent.vente-create');
    Route::post('/vente/store', [VenteController::class, 'store'])->name('agent.vente-store');
});
