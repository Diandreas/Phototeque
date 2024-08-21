<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('user_has_comments', [UserHasCommentController::class, 'index'])->name('user_has_comments.index');
    Route::get('user_has_comments/create', [UserHasCommentController::class, 'create'])->name('user_has_comments.create');
    Route::post('user_has_comments', [UserHasCommentController::class, 'store'])->name('user_has_comments.store');
    Route::delete('user_has_comments/{user_id}/{comment_id}', [UserHasCommentController::class, 'destroy'])->name('user_has_comments.destroy');

    Route::get('term_has_images', [TermHasImageController::class, 'index'])->name('term_has_images.index');
    Route::get('term_has_images/create', [TermHasImageController::class, 'create'])->name('term_has_images.create');
    Route::post('term_has_images', [TermHasImageController::class, 'store'])->name('term_has_images.store');
    Route::delete('term_has_images/{term_id}/{image_id}', [TermHasImageController::class, 'destroy'])->name('term_has_images.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
