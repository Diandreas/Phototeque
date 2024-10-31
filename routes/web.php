<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProposedModificationController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\TermHasImageController;
use App\Http\Controllers\UserHasCommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Route pour la page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Route pour la page d'accueil des images
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route pour le tableau de bord
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes nécessitant une authentification
Route::middleware('auth')->group(function () {
    // Routes pour les termes
    Route::resource('terms', TermController::class);

    // Routes pour les relations entre les termes et les images
    Route::get('term_has_images', [TermHasImageController::class, 'index'])->name('term_has_images.index');
    Route::get('term_has_images/create', [TermHasImageController::class, 'create'])->name('term_has_images.create');
    Route::post('term_has_images', [TermHasImageController::class, 'store'])->name('term_has_images.store');
    Route::delete('term_has_images/{term_id}/{image_id}', [TermHasImageController::class, 'destroy'])->name('term_has_images.destroy');

    // Routes pour les images
    Route::resource('images', ImageController::class);

    // Routes pour les utilisateurs
    Route::resource('users', UserController::class);

    // Routes pour les commentaires
    Route::resource('comments', CommentController::class);

    // Route pour télécharger une image
    Route::get('/images/{image}/download', [ImageController::class, 'download'])->name('images.download');
    Route::post('/modifications', [ProposedModificationController::class, 'store'])->name('modifications.store');
    Route::patch('/modifications/{modification}', [ProposedModificationController::class, 'update'])->name('modifications.update');
    // Routes pour le profil de l'utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes d'authentification
require __DIR__.'/auth.php';
