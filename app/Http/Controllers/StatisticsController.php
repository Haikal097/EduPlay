<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Note;

class StatisticsController extends Controller
{
    public function index()
    {
        // Fetch total counts from the database
        $totalGames = Game::count();
        $totalNotes = Note::count();
    
        // Fetch top viewed game (assuming the 'views' column exists)
        $topGame = Game::orderBy('views', 'desc')->first(); // Fetches the game with the highest number of views
    
        // Fetch top viewed note (assuming the 'views' column exists)
        $topNote = Note::orderBy('views', 'desc')->first(); // Fetches the note with the highest number of views
    
        // Pass data to the view
        return view('mainpage.index', [
            'totalGames' => $totalGames,
            'totalNotes' => $totalNotes,
            'topGame' => $topGame,
            'topNote' => $topNote,
        ]);
        
    }
    
}
