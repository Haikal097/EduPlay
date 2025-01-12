<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePictureController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\FavoriteNoteController;
use App\Http\Controllers\FeedbackNoteController;
use Illuminate\Support\Facades\Route;
use App\Models\Game;

// Main route
Route::get('/', function () {
    return view('mainpage.index');
});

// User Profile Routes
Route::get('/userprofile', function () {
    return view('userprofile.index');
});

// Notes Routes
Route::get('/notes', [NotesController::class, 'index'])->name('notes.index');
Route::get('/notes/create', [NotesController::class, 'create'])->name('notes.create');
Route::post('/notes', [NotesController::class, 'store'])->name('notes.store');
Route::get('/notes/{id}', [NotesController::class, 'show'])->name('notes.show');
Route::get('/notes/test', function () {
    return view('notes.note');
});
Route::post('/feedback', [FeedbackNoteController::class, 'store']);
Route::put('/feedback/{feedback}', [FeedbackNoteController::class, 'update'])->name('feedback.update');
Route::delete('/feedback/{feedback}', [FeedbackNoteController::class, 'destroy']);

// Game Routes
Route::get('/games', [GameController::class, 'showGames'])->name('games.list');
Route::get('/game/{id}', [GameController::class, 'show'])->name('game.show');
Route::post('/upload-game', [GameController::class, 'uploadGame'])->name('upload.game');


// User Profile Picture Routes
Route::post('/upload_image', [ProfilePictureController::class, 'storeUpload'])->name('image.upload');
Route::get('/userprofile', [ProfilePictureController::class, 'getProfilePicture'])->name('image.show');
Route::post('/userprofile/update', [ProfilePictureController::class, 'updateProfile'])->name('userprofile.update');
Route::get('/userprofile/{id}', [ProfilePictureController::class, 'showProfile'])->name('profile.show');
Route::get('/userprofile', [ProfilePictureController::class, 'showMyProfile'])->name('profile.my');

// Authentication Routes
Route::middleware(['auth'])->group(function () {
    // User Profile Edit Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Favorite Routes for Notes
    Route::post('/favorite/{noteId}', [FavoriteNoteController::class, 'store']);
    Route::get('/favorites', [FavoriteNoteController::class, 'index']);
    Route::delete('/favorite/{noteId}', [FavoriteNoteController::class, 'destroy']);
    Route::post('/favorite/{noteId}', [FavoriteNoteController::class, 'toggleFavorite']);

});

// Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User Profile Route for Authenticated Users
Route::middleware('auth')->group(function () {
    Route::get('/userprofile', [FavoriteNoteController::class, 'showUserProfile'])->name('user.profile');
});

// Include authentication routes
require __DIR__.'/auth.php';
