<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\FavouriteGame;
use ZipArchive;


class GameController extends Controller
{
    public function uploadGame(Request $request)
    {
        // Validate the uploaded files
        $request->validate([
            'zipFile' => 'required|mimes:zip', // Allow only .zip files
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the thumbnail image
        ]);
        
        // Store the zip file in the 'games' directory under the 'public' disk
        $zipFilePath = $request->file('zipFile')->store('games', 'public');
        
        // Get the absolute path of the zip file
        $zipAbsolutePath = storage_path('app/public/' . $zipFilePath);
        
        // Determine the extraction directory (removing .zip from filename)
        $extractTo = storage_path('app/public/games/' . pathinfo($zipFilePath, PATHINFO_FILENAME));
        
        // Unzip the file
        $zip = new ZipArchive;
        if ($zip->open($zipAbsolutePath) === TRUE) {
            // Create the extraction directory if it doesn't exist
            if (!is_dir($extractTo)) {
                mkdir($extractTo, 0755, true);
            }
            
            // Extract the files
            $zip->extractTo($extractTo);
            $zip->close();
            
            // Optionally delete the zip file after extraction
            Storage::disk('public')->delete($zipFilePath);
            
            // Store the thumbnail image in the 'public/storage/games/thumbnails' directory
            $thumbnailPath = $request->file('thumbnail_image')->store('games/thumbnails', 'public'); // Store thumbnail in 'games/thumbnails'
            
            // Store game information in the database
            $game = new Game();
            $game->title = $request->title;
            $game->desc = $request->desc;
            $game->file_path = 'games/' . pathinfo($zipFilePath, PATHINFO_FILENAME); // Path to extracted folder
            $game->thumbnail_path = $thumbnailPath; // Store the path of the uploaded thumbnail
            $game->user_id = auth()->id(); // Store the ID of the currently authenticated user
            $game->save();
            
            return redirect()->back()->with('success', 'Game uploaded and extracted successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to extract the zip file.');
        }
    }
    public function show($id)
    {
        // Find the game by its ID
        $game = Game::findOrFail($id);
        
        // Increment the view count
        $game->increment('views');
        
        // Fetch the feedback for the specific game
        $feedback = $game->feedback;
    
        // Calculate the average rating (use 0 if no feedback exists)
        $averageRating = $feedback->avg('rating') ?? 0;
    
        // Count the number of feedback entries for this game
        $feedbackCount = $feedback->count();
    
        // Get the count of users who favorited this note
        $favoriteCount = FavouriteGame::where('game_id', $id)->count();

        // Check if the authenticated user has favorited this game
        $isFavorited = Auth::check() && Auth::user()->favouriteGames->contains($id);
    
        // Return the games.game view and pass all data to it
        return view('games.game', compact('game', 'averageRating', 'feedbackCount', 'isFavorited', 'favoriteCount'));
    }
    
    
    public function showGames()
{
    $games = Game::all();  // Assuming you have a Game model for the database table
    return view('games.index', compact('games'));
}

public function showlistGames($id)
{
    // Fetch games for the current user based on user_id
    $games = Game::where('user_id', $id) // Filter games based on the user ID
        ->withCount('feedback')  // Count feedbacks
        ->with(['feedback' => function ($query) {
            $query->selectRaw('game_id, AVG(rating) as avg_rating')
                  ->groupBy('game_id');
        }])
        ->get();

    // Loop through each game to add the average rating for each
    foreach ($games as $game) {
        $game->avg_rating = $game->feedback->isEmpty() ? 0 : $game->feedback->first()->avg_rating;
    }
    // Return the view with the games data, including average ratings
    return view('userprofile.gamelist', compact('games','id'));
}
public function destroy($id)
{
    $games = Game::findOrFail($id);
    $games->delete();

    return redirect()->back()->with('success', 'Game deleted successfully.');
}

}
