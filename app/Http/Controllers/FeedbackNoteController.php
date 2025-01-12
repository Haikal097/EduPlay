<?php

namespace App\Http\Controllers;

use App\Models\FeedbackNote;
use App\Models\Note;
use Illuminate\Http\Request;

class FeedbackNoteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'note_id' => 'required|exists:notes,id',
            'user_id' => 'required|exists:users,id'
        ]);

        FeedbackNote::create($validated);

        // Calculate new average
        $note = Note::find($request->note_id);
        $averageRating = $note->feedback()->avg('rating');

        return back()->with([
            'success' => 'Feedback submitted successfully!',
            'averageRating' => number_format($averageRating, 2)
        ]);
    }

    public function update(Request $request, FeedbackNote $feedback)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $feedback->update($validated);

        // Calculate new average
        $note = Note::find($feedback->note_id);
        $averageRating = $note->feedback()->avg('rating');

        return back()->with([
            'success' => 'Feedback updated successfully!',
            'averageRating' => number_format($averageRating, 2)
        ]);
    }

    public function destroy(FeedbackNote $feedback)
    {
        $note_id = $feedback->note_id;
        $feedback->delete();

        // Recalculate average after deletion
        $note = Note::find($note_id);
        $averageRating = $note->feedback()->avg('rating') ?? 0;

        return back()->with([
            'success' => 'Feedback deleted successfully!',
            'averageRating' => number_format($averageRating, 2)
        ]);
    }
}