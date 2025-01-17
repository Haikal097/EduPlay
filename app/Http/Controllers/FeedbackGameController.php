<?php

namespace App\Http\Controllers;

use App\Models\FeedbackGame;
use App\Models\Game;
use Illuminate\Http\Request;

class FeedbackGameController extends Controller
{
    /**
     * Store new feedback for a game.
     */
    public function store(Request $request, Game $game)
    {
        // Validate the form inputs
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'user_id' => 'required|exists:users,id', 
            'game_id' => 'required|exists:games,id',
        ]);

        // Prevent duplicate feedback from the same user for the same game
        $existingFeedback = FeedbackGame::where('user_id', $request->user_id)
            ->where('game_id', $game->id)
            ->first();

        if ($existingFeedback) {
            return back()->with('error', 'You have already submitted feedback for this game.');
        }

        // Store the feedback
        FeedbackGame::create($validated);

        return back()->with('success', 'Feedback submitted successfully!');
    }

    /**
     * Update existing feedback for a game.
     */
    public function update(Request $request, FeedbackGame $feedback)
    {
        // Authorize the user
        if ($request->user()->id !== $feedback->user_id) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Validate the form inputs
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Update the feedback
        $feedback->update($validated);

        return back()->with('success', 'Feedback updated successfully!');
    }

    /**
     * Delete existing feedback for a game.
     */
    public function destroy(Request $request, FeedbackGame $feedback)
    {
        // Authorize the user
        if ($request->user()->id !== $feedback->user_id) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Delete the feedback
        $feedback->delete();

        return back()->with('success', 'Feedback deleted successfully!');
    }
}
