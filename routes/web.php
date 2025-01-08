<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePictureController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\FavoriteNoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('mainpage.index');
});
Route::get('/userprofile', function () {
    return view('userprofile.index');
});

Route::get('/notes', [NotesController::class, 'index'])->name('notes.index');

Route::get('/games', function () {
    return view('games.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/userprofile', function () {
        return view('userprofile.index');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/userprofile', function () {
        return view('userprofile.index');
    });
});

Route::post('/upload_image', [ProfilePictureController::class, 'storeUpload'])->name('image.upload');
Route::get('/userprofile', [ProfilePictureController::class, 'getProfilePicture'])->name('image.show');

Route::get('/userprofile', [ProfilePictureController::class, 'getProfilePicture'])->name('image.show');

Route::post('/userprofile/update', [ProfilePictureController::class, 'updateProfile'])->name('userprofile.update');

Route::get('/notes/create', [NotesController::class, 'create'])->name('notes.create');
Route::post('/notes', [NotesController::class, 'store'])->name('notes.store');

    Route::middleware('auth')->group(function () {
        // Store favorite
        Route::post('/favorite/{noteId}', [FavoriteNoteController::class, 'store']);
        
        // List all favorites for the authenticated user
        Route::get('/favorites', [FavoriteNoteController::class, 'index']);
        
        // Remove a favorite
        Route::delete('/favorite/{noteId}', [FavoriteNoteController::class, 'destroy']);
    });

    // Remove redundant route definition
Route::get('/userprofile', [FavoriteNoteController::class, 'showUserProfile'])->name('user.profile');


require __DIR__.'/auth.php';
