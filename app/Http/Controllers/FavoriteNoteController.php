<?php

namespace App\Http\Controllers;

use App\Models\FavouriteNote;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteNoteController extends Controller
{
    public function store(Request $request, $noteId)
    {
        $user = Auth::user(); // Get the authenticated user

        // Check if the note exists
        $note = Note::find($noteId);
        if (!$note) {
            return response()->json(['error' => 'Note not found'], 404);
        }

        // Check if the user has already favorited this note
        $existingFavorite = FavouriteNote::where('user_id', $user->id)->where('note_id', $noteId)->first();
        if ($existingFavorite) {
            return response()->json(['message' => 'Note already favorited'], 200);
        }

        // Create a new favorite
        $favorite = new FavouriteNote();
        $favorite->user_id = $user->id;
        $favorite->note_id = $noteId;
        $favorite->save();

        return response()->json(['message' => 'Note added to favorites'], 201);
    }

// Example of FavoriteNoteController's index method
public function index()
{
    // Ensure there's an authenticated user
    $user = Auth::user();

    // Retrieve the user's favorite notes
    $favouriteNotes = $user->favouriteNotes;

    // Pass the variable to the view
    return view('userprofile.index', compact('favouriteNotes'));
}


    public function showUserProfile()
    {
        // Ensure the user is authenticated
        $user = Auth::user();
    
        // Fetch the favorite notes for the logged-in user
        $favouriteNotes = $user->favouriteNotes;
    
        // Pass the variable to the view
        return view('userprofile.index', compact('favouriteNotes'));
    }
    
}
