<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ActeurController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Routes publiques
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Routes d'authentification
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Routes Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Acteurs touristiques
    Route::get('/acteurs', [AdminController::class, 'acteursIndex'])->name('acteurs.index');
    Route::get('/acteurs/create', [AdminController::class, 'acteursCreate'])->name('acteurs.create');
    Route::post('/acteurs', [AdminController::class, 'acteursStore'])->name('acteurs.store');
    Route::get('/acteurs/{acteur}', [AdminController::class, 'acteursShow'])->name('acteurs.show');
    Route::get('/acteurs/{acteur}/edit', [AdminController::class, 'acteursEdit'])->name('acteurs.edit');
    Route::patch('/acteurs/{acteur}', [AdminController::class, 'acteursUpdate'])->name('acteurs.update');
    Route::patch('/acteurs/{acteur}/toggle-status', [AdminController::class, 'acteursToggleStatus'])->name('acteurs.toggle-status');
    Route::delete('/acteurs/{acteur}', [AdminController::class, 'acteursDestroy'])->name('acteurs.destroy');
    Route::post('/acteurs/bulk-action', [AdminController::class, 'acteursBulkAction'])->name('acteurs.bulk-action');
    
    // Infrastructures
    Route::get('/infrastructures', [AdminController::class, 'infrastructuresIndex'])->name('infrastructures.index');
    Route::get('/infrastructures/{infrastructure}', [AdminController::class, 'infrastructuresShow'])->name('infrastructures.show');
    Route::patch('/infrastructures/{infrastructure}/toggle-status', [AdminController::class, 'infrastructuresToggleStatus'])->name('infrastructures.toggle-status');
    Route::delete('/infrastructures/{infrastructure}', [AdminController::class, 'infrastructuresDestroy'])->name('infrastructures.destroy');
    Route::post('/infrastructures/bulk-action', [AdminController::class, 'infrastructuresBulkAction'])->name('infrastructures.bulk-action');
    
    
});

// Routes Acteur Touristique
Route::middleware(['auth', 'acteur'])->prefix('acteur')->name('acteur.')->group(function () {
    Route::get('/dashboard', [ActeurController::class, 'dashboard'])->name('dashboard');
    
    // Profil
    Route::get('/profile', [ActeurController::class, 'profile'])->name('profile');
    Route::put('/profile', [ActeurController::class, 'updateProfile'])->name('profile.update');
     Route::get('/profile/create', [ActeurController::class, 'createProfile'])->name('profile.create');
    Route::put('/account', [ActeurController::class, 'updateAccount'])->name('account.update');
    
    // Infrastructures
    Route::get('/infrastructures', [ActeurController::class, 'infrastructures'])->name('infrastructures.index');
    Route::get('/infrastructures/create', [ActeurController::class, 'createInfrastructure'])->name('infrastructures.create');
    Route::post('/infrastructures', [ActeurController::class, 'storeInfrastructure'])->name('infrastructures.store');
    Route::get('/infrastructures/{id}', [ActeurController::class, 'showInfrastructure'])->name('infrastructures.show');
    Route::get('/infrastructures/{id}/edit', [ActeurController::class, 'editInfrastructure'])->name('infrastructures.edit');
    Route::put('/infrastructures/{id}', [ActeurController::class, 'updateInfrastructure'])->name('infrastructures.update');
    Route::delete('/infrastructures/{id}', [ActeurController::class, 'destroyInfrastructure'])->name('infrastructures.destroy');
});



