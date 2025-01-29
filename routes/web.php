<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


use App\Http\Controllers\SocieteController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\SousTraitantGareController;
use App\Http\Controllers\DestinationNationaleController;
use App\Http\Controllers\DestinationSousRegionController;
use App\Http\Controllers\LieuController;
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Liste des utilisateurs
Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // Formulaire création
Route::post('/users/store', [UserController::class, 'store'])->name('users.store'); // Enregistrer un utilisateur
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit'); // Formulaire édition
Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update'); // Mettre à jour
Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // Supprimer

// Voir et gérer les gares d'un sous-traitant
Route::get('/sous-traitants/{id}/gares', [SousTraitantGareController::class, 'index'])->name('sous_traitant_gares.index');
Route::post('/sous-traitants/gares', [SousTraitantGareController::class, 'store'])->name('sous_traitant_gares.store');
Route::delete('/sous-traitants/{userId}/gares/{gareId}', [SousTraitantGareController::class, 'destroy'])->name('sous_traitant_gares.destroy');

Route::get('/gares-lieux/', [DestinationNationaleController::class, 'getLieuxByGare']);

// Afficher tous les lieux
Route::get('/lieux', [LieuController::class, 'index'])->name('lieux.index');

// Formulaire pour créer un lieu
Route::get('/lieux/create', [LieuController::class, 'create'])->name('lieux.create');

// Enregistrer un nouveau lieu
Route::post('/lieux', [LieuController::class, 'store'])->name('lieux.store');

// Formulaire pour modifier un lieu
Route::get('/lieux/{lieu}/edit', [LieuController::class, 'edit'])->name('lieux.edit');

// Mettre à jour un lieu
Route::put('/lieux/{lieu}', [LieuController::class, 'update'])->name('lieux.update');

// Supprimer un lieu
Route::delete('/lieux/{lieu}', [LieuController::class, 'destroy'])->name('lieux.destroy');

Route::prefix('destinations_national')->name('destinations_national.')->group(function () {
    Route::get('/', [DestinationNationaleController::class, 'index'])->name('index'); // Lister
    Route::get('/create', [DestinationNationaleController::class, 'create'])->name('create'); // Formulaire de création
    Route::post('/', [DestinationNationaleController::class, 'store'])->name('store'); // Sauvegarder
    Route::get('/{id}/edit', [DestinationNationaleController::class, 'edit'])->name('edit'); // Formulaire d'édition
    Route::put('/{id}', [DestinationNationaleController::class, 'update'])->name('update'); // Mettre à jour
    Route::delete('/{id}', [DestinationNationaleController::class, 'destroy'])->name('destroy'); // Supprimer
});
Route::prefix('destinations_sousregion')->name('destinations_sousregion.')->group(function () {
    Route::get('/', [DestinationSousRegionController::class, 'index'])->name('index'); // Lister
    Route::get('/create', [DestinationSousRegionController::class, 'create'])->name('create'); // Formulaire de création
    Route::post('/', [DestinationSousRegionController::class, 'store'])->name('store'); // Sauvegarder
    Route::get('/{id}/edit', [DestinationSousRegionController::class, 'edit'])->name('edit'); // Formulaire d'édition
    Route::put('/{id}', [DestinationSousRegionController::class, 'update'])->name('update'); // Mettre à jour
    Route::delete('/{id}', [DestinationSousRegionController::class, 'destroy'])->name('destroy'); // Supprimer
});

Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/societes-gare/{societe_id}/gares', [DestinationNationaleController::class, 'getGaresBySociete']);

Route::get('/societes', [SocieteController::class, 'index'])->name('societes.index'); // Lister les sociétés
Route::get('/societes/create', [SocieteController::class, 'create'])->name('societes.create'); // Formulaire pour créer une société
Route::post('/societes', [SocieteController::class, 'store'])->name('societes.store'); // Enregistrer une société
Route::get('/societes/{id}/edit', [SocieteController::class, 'edit'])->name('societes.edit'); // Formulaire pour modifier une société
Route::put('/societes/{id}', [SocieteController::class, 'update'])->name('societes.update'); // Enregistrer les modifications d'une société
Route::delete('/societes/{id}', [SocieteController::class, 'destroy'])->name('societes.destroy'); // Supprimer une société

// Gestion des gares
Route::get('/societes/{societe_id}/gares', [SocieteController::class, 'showGares'])->name('societes.gares'); // Lister les gares d'une société
Route::get('/societes/garesall', [SocieteController::class, 'showAllGares'])->name('societes.garesAll'); // Lister les gares d'une société
Route::get('/gares/{societe_id}/create', [SocieteController::class, 'createGare'])->name('societes.createGare'); // Formulaire pour ajouter une gare
Route::get('/garee/{gare_id}/edit', [SocieteController::class, 'editGare'])->name('societes.editGare');
Route::put('gares/{gare_id}/{societe_id}', [SocieteController::class, 'updateGare'])->name('societes.updateGare');
Route::delete('gares/{gare_id}', [SocieteController::class, 'deleteGare'])->name('societes.deleteGare');

Route::post('/societes/{societe_id}/gares', [SocieteController::class, 'storeGare'])->name('societes.storeGare'); // Enregistrer une gare

Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

// Routes pour l'administrateur
Route::prefix('admin')->group(function () {
    // Formulaire de login
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    // Traitement du login
    Route::post('login', [AdminAuthController::class, 'login']);

    // Formulaire d'inscription
    Route::get('register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    // Traitement de l'inscription
    Route::post('register', [AdminAuthController::class, 'register']);

    // Déconnexion
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Dashboard protégé par auth
    Route::middleware('auth')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });
});
