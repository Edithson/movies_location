<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
// Route::clear();

Route::resource('seance', SeanceController::class);
Route::get('/', [SeanceController::class, 'index'])->name('dashboard');
Route::resource('film', FilmController::class);

Route::resource('commentaire', CommentaireController::class)->only(['index','show']);

Route::middleware('auth')->group(function () {

    Route::get('film/create', [FilmController::class, 'create'])->name('film.create');
    // Route::resource('film', FilmController::class)->except(['index','show']);
    Route::resource('seance', SeanceController::class)->except(['index','show']);
    Route::get('seance-salle/{salle}', [SalleController::class, 'seance_salle'])->name('seance.salle');
    Route::resource('salle', SalleController::class);
    Route::post('commentaire/{film}/store', [CommentaireController::class, 'store'])->name('commentaire.store');
    Route::resource('commentaire', CommentaireController::class)->except(['index','show','store']);
    Route::post('reservation/{seance}/store', [ReservationController::class, 'store'])->name('reservation.store');
    Route::post('reservation/validate/{seance}', [ReservationController::class, 'validate'])->name('reservation.validate');
    Route::resource('reservation', ReservationController::class)->except(['store']);
    Route::get('user/{id}/restore', [UserController::class, 'restore'])->name('user.restore')->whereNumber('id');
    Route::get('user/index-delete', [UserController::class, 'index_delete'])->name('user.index-delete');
    Route::resource('user', UserController::class)->except(['store','edit']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profilePhoto', [ProfileController::class, 'changer_photo'])->name('profile.photo');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
