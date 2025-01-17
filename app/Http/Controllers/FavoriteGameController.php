<?php

namespace App\Http\Controllers;

use App\Models\FavouriteGame;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class FavoriteGameController extends Controller
{
    public function store(Request $request, $gameId)
    {
        $user = Auth::user(); // Get the authenticated user

        // Check if the game exists
        $game = Game::find($gameId);
        if (!$game) {
            return response()->json(['error' => 'Game not found'], 404);
        }

        // Check if the user has already favorited this game
        $existingFavorite = FavouriteGame::where('user_id', $user->id)->where('game_id', $gameId)->first();
        if ($existingFavorite) {
            return response()->json(['message' => 'Game already favorited'], 200);
        }

        // Create a new favorite
        $favorite = new FavouriteGame();
        $favorite->user_id = $user->id;
        $favorite->game_id = $gameId;
        $favorite->save();

        return response()->json(['message' => 'Game added to favorites'], 201);
    }

    // Example of FavoriteNoteController's index method
public function index()
{
    // Ensure there's an authenticated user
    $user = Auth::user();

    // Retrieve the user's favorite notes
    $favouriteGames = $user->favouriteGames;

    // Pass the variable to the view
    return view('userprofile.index', compact('favourite'));
}


    public function showUserProfile()
    {
        // Ensure the user is authenticated
        $user = Auth::user();
    
        // Fetch the favorite notes for the logged-in user
        $favouriteGames = $user->favouriteGames;
    
        // Pass the variable to the view
        return view('userprofile.index', compact('favouriteGames'));
    }
    // Store or remove favorite
    public function toggleFavorite(Request $request, $gameId)
    {
        $user = Auth::user(); // Get the authenticated user
    
        // Check if the game exists
        $game = Game::find($gameId);
        if (!$game) {
            return response()->json(['error' => 'Game not found'], 404);
        }
    
        // Check if the game is already favorited
        $existingFavorite = FavouriteGame::where('user_id', $user->id)
                                         ->where('game_id', $gameId)
                                         ->first();
    
        if ($existingFavorite) {
            // If it's already favorited, remove it
            $existingFavorite->delete();
            return response()->json(['message' => 'Game removed from favorites']);
        } else {
            // If it's not favorited, add it
            FavouriteGame::create([
                'user_id' => $user->id,
                'game_id' => $gameId,
            ]);
            return response()->json(['message' => 'Game added to favorites']);
        }
    }
    

    


}
