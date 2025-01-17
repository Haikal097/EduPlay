<?php
use App\Models\User;
use App\Models\Note;
use App\Models\Game;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePictureController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\FavoriteNoteController;
use App\Http\Controllers\FavoriteGameController;
use App\Http\Controllers\FeedbackNoteController;
use App\Http\Controllers\FeedbackGameController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// Main route
Route::get('/', [StatisticsController::class, 'index'])->name('mainpage.index');

// User Profile Routes
Route::get('/userprofile', function () {
    return view('userprofile.index');
});
Route::middleware('auth')->get('/profile', [ProfileController::class, 'index'])->name('profile.index');

// Route for displaying the games table using the controller
Route::get('/userprofile/{id}/gamelist', [GameController::class, 'showlistGames'])->name('gamelist.index');


// Route for displaying the notes table using the controller
Route::get('/userprofile/{id}/notelist', [NotesController::class, 'showlistNotes'])->name('notelist.index');


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
Route::delete('/notes/{id}', [NotesController::class, 'destroy'])->name('notes.destroy');

Route::post('/notes/{id}/favorite', [FavoriteNoteController::class, 'toggleFavorite'])->name('note.favorite.toggle');


// For storing, updating, and deleting feedback for games
Route::post('/game/{game}/feedback', [FeedbackGameController::class, 'store'])->name('feedback-game.store');

// Game Routes
Route::get('/games', [GameController::class, 'showGames'])->name('games.list');
Route::get('/games/{id}', [GameController::class, 'show'])->name('game.show');
Route::post('/upload-game', [GameController::class, 'uploadGame'])->name('upload.game');
Route::delete('/games/{id}', [GameController::class, 'destroy'])->name('games.destroy');

Route::post('/games/{id}/favorite', [FavoriteGameController::class, 'toggleFavorite'])->name('game.favorite.toggle');

Route::post('/feedbackgame', [FeedbackGameController::class, 'store'])->name('feedbackgame.store');
Route::put('/feedbackgame/{feedback}', [FeedbackGameController::class, 'update'])->name('feedbackgame.update');
Route::delete('/feedbackgame/{feedback}', [FeedbackGameController::class, 'destroy'])->name('feedbackgame.destroy');



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
    Route::post('/favoriteNote/{noteId}', [FavoriteNoteController::class, 'store']);
    Route::get('/favoritesNote', [FavoriteNoteController::class, 'index']);
    Route::delete('/favoriteNote/{noteId}', [FavoriteNoteController::class, 'destroy']);
    Route::post('/favoriteNote/{noteId}', [FavoriteNoteController::class, 'toggleFavorite']);

});

//Search Route
Route::get('/search', function (Request $request) {
    $query = $request->input('query');

    // Search for users by name or email
    $users = User::where('name', 'like', '%' . $query . '%')
                 ->orWhere('email', 'like', '%' . $query . '%')
                 ->get();

// Search for notes by title
$notes = Note::where('title', 'like', '%' . $query . '%')
             ->get()
             ->map(function ($note) {
                 // Assuming `user_id` is the column for the uploader's ID in the notes table
                 $note->uploader_name = User::find($note->user_id)->name; // Fetching uploader's name
                 // Fetching thumbnail path for the note
                 $note->thumbnail_path = $note->thumbnail_path;
                // Fetching the number of users who have added the game to their favorites
                $note->favorites_count = $note->favouritedByUsers()->count();
                 return $note;
             });

// Search for games by title
$games = Game::where('title', 'like', '%' . $query . '%')
             ->get()
             ->map(function ($game) {
                 // Assuming `user_id` is the column for the uploader's ID in the games table
                 $game->uploader_name = User::find($game->user_id)->name; // Fetching uploader's name
                 // Fetching thumbnail path for the game
                 $game->thumbnail_path = $game->thumbnail_path;
                // Fetching the number of users who have added the game to their favorites
                $game->favorites_count = $game->favouritedByUsers()->count();
                 return $game;
             });


    // Calculate total number of results
    $totalResults = $users->count() + $notes->count() + $games->count();

    // Return the results to the view (you can create a 'search.blade.php' view for displaying results)
    return view('search.index', compact('users', 'notes', 'games', 'query','totalResults'));
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
