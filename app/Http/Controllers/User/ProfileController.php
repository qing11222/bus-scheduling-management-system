<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile_detail', compact('user'));
    }
    public function driver_profile()
    {
        $user = Auth::user();
        return view('driver.profile', compact('user'));
    }
    public function update(Request $request)
    {

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'matricNumber' => 'required|string|max:50', // Required field
            'faculty' => 'required|string|max:100', // Required field
            'age' => 'required|integer|min:1', // Required field
            'gender' => 'required|in:male,female', // Required field
            'course' => 'required|string|max:100', // Required field
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the currently authenticated user
        $userId = Auth::id(); // Get the authenticated user's ID
        $user = User::findOrFail($userId); // Find user by ID or fail


        // Update user information
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->matricNumber = $request->input('matricNumber');
        $user->faculty = $request->input('faculty');
        $user->age = $request->input('age');
        $user->gender = $request->input('gender');
        $user->course = $request->input('course');

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if it exists
            if ($user->profile_photo_path) {
                Storage::delete($user->profile_photo_path);
            }

            // Store new photo
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $path;
        }

        // Save the updated user
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
