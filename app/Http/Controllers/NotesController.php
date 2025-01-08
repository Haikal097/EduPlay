<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NotesController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'pdf_file' => 'required|mimes:pdf|max:2048',
            'thumbnail_image' => 'nullable|image|max:1024',
        ]);

        $filePath = $request->file('pdf_file')->store('notes','public');
        $thumbnailPath = $request->hasFile('thumbnail_image') ? $request->file('thumbnail_image')->store('thumbnails','public') : null;

        Note::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'file_path' => $filePath,
            'thumbnail_path' => $thumbnailPath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('notes.index')->with('success', 'Note uploaded successfully.');
    }
}
