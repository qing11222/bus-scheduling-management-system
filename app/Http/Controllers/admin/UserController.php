<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function viewUsers()
    {
        $users = User::all();
        return view('admin.user.view', compact('users'));
    }
    public function viewUsersBeforeDelete()
    {
        $users = User::all();
        return view('admin.user.delete', compact('users'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }
    public function update(Request $request)
    {


        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'matricNumber' => 'nullable|string',
            'phone' => 'nullable|string',
            'faculty' => 'nullable|string',
            'age' => 'nullable|integer|min:0',
            'gender' => 'required|in:Male,Female',
            'course' => 'nullable|string|max:255',
        ]);
        try {
            $user = User::find($request->user_id);
            $user->update([
                'name' => $request->input('name'),
                'matricNumber' => $request->input('matricNumber'),
                'age' => $request->input('age'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'faculty' => $request->input('faculty'),
                'course' => $request->input('course'),
                'gender' => $request->input('gender'),
            ]);

            return redirect()->route('admin.user.view')->with('success', 'User updated successfully');
        } catch (QueryException $e) {
            // Capture the error message from the trigger
            $errorMessage = $e->getMessage();
            // Customize the error message if needed
        if (strpos($errorMessage, 'Email already exists!') !== false) {
            $errorMessage = 'The provided email is already in use.';
        } elseif (strpos($errorMessage, 'Name already exists!') !== false) {
            $errorMessage = 'The provided name is already in use.';
        } elseif (strpos($errorMessage, 'Phone number already exists!') !== false) {
            $errorMessage = 'The provided phone number is already in use.';
        } elseif (strpos($errorMessage, 'Matric Number already exists!') !== false) {
            $errorMessage = 'The provided matric number is already in use.';
        }
            // Return with the error message
            return redirect()->back()->with('error', $errorMessage);
        }
    }
    public function deleteUser($id)
    {
        try {
            // Call your stored procedure or perform the delete operation
            DB::statement('CALL delete_user(?)', [$id]);

            return redirect()->route('admin.user.view')->with('success', 'User deleted successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle the exception for SQL integrity constraint violation
            if ($e->getCode() === '23000') { // SQLSTATE[23000] for integrity constraint violation
                return redirect()->route('admin.user.view')->with('error', 'Cannot delete user. Integrity constraint violation.');
            }

            // Handle other exceptions
            return redirect()->route('admin.user.view')->with('error', 'An error occurred while deleting the user.');
        }
    }
}
