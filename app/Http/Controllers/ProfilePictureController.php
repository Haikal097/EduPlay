<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Note;
use App\Models\Game;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilePictureController extends Controller
{
    public function storeUpload(Request $request){
        
        $request->validate([
            'img' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ]);


        // Log the file path

        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id )->first();
        if ($user) {
            // Check if the user has an existing profile image
            if ($user->profile_image) {
                // Delete the existing profile image from storage
                Storage::disk('public')->delete($user->profile_image);
            }
            // Save the file path in the user's profile_image column
            $file = $request->file('img');
            $filePath = $file->store('userpfp', 'public');
            
            Log::info('File path: ' . $filePath);

            $user->profile_image = $filePath;
            $user->save();

            return back()->with('success', 'Image uploaded successfully');
        }

        return back()->with('error', 'User not authenticated');
    }

    public function getProfilePicture()
    {
        $user = Auth::user();
        if ($user) {
            // Retrieve the profile image path from the database
            $profileImagePath = $user->profile_image;
    
            // Pass the profile image path to the view
            return view('userprofile.index', compact('profileImagePath', 'user')); // Pass the entire $user model
        }
    
        return redirect()->route('login')->with('error', 'User not authenticated');
    }
    

    public function updateProfile(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);

        // Get the authenticated user
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id )->first();

        // Update the user's profile information
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->bio = $request->input('bio');
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    public function showProfile($id)
    {
        // Fetch the user by ID
        $profileUser = User::findOrFail($id);
    
        // Retrieve their favourite games (if any)
        $favouriteGames = $profileUser->favoriteGamesUser;

        // Retrieve their favourite notes (if any)
        $favouriteNotes = $profileUser->favoriteNotesUser;
    
    
        // Retrieve counts of each activity for the specified user
        $notesCount = $profileUser->notes()->count(); // Assuming User has a 'notes' relationship
        $gamesCount = $profileUser->games()->count(); // Assuming User has a 'games' relationship
    
        // Return the view with all necessary data
        return view('userprofile.index', [
            'profileUser' => $profileUser,
            'favouriteNotes' => $favouriteNotes,
            'favouriteGames' => $favouriteGames,
            'notesCount' => $notesCount,
            'gamesCount' => $gamesCount,
        ]);
    }
    
    
    public function showMyProfile()
    {
        $user = Auth::user();
        $favouriteNotes = $user->favouriteNotes; // Assuming the relationship is set up in the User model
    
        return view('userprofile.index', [
            'profileUser' => $user,
            'favouriteNotes' => $favouriteNotes
        ]);
    }
    
    
}
